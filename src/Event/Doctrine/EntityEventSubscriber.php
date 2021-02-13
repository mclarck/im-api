<?php


namespace App\Event\Doctrine;

use App\Interfaces\IFile;
use App\Interfaces\IMedia;
use App\Interfaces\ITransaction;
use App\Interfaces\IUser;
use App\Service\Http\Request;
use App\Service\Media\MediaInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use function method_exists;

/**
 * Class EntityEventSubscriber
 * @package App\Event\Doctrine
 */
class EntityEventSubscriber implements EventSubscriber, LoggerAwareInterface
{

    protected $pw;
    protected $req;
    protected $params;
    protected $logger;
    protected $mailer;
    protected $em;


    public function __construct(
        UserPasswordEncoderInterface $pw,
        ParameterBagInterface $params,
        RequestStack $req,
        MailerInterface $mailer,
        EntityManagerInterface $em
    ) {
        $this->pw = $pw;
        $this->req = $req;
        $this->params = $params;
        $this->mailer = $mailer;
        $this->em = $em;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function mailNewOrder($entity)
    {

        $email = (new TemplatedEmail())
            ->from(new Address('noreply@inmarketify.ml', 'InMarketify'))
            ->to('contact.mclarck@gmail.com')
            ->priority(Email::PRIORITY_HIGH)
            ->htmlTemplate('emails/neworder.html.twig')
            ->context([
                "entity" => $entity,
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo'
            ]);
        try {
            $this->mailer->send($email);
        } catch (\Throwable $th) {
            $this->logger->warning($th->getMessage());
        }
    }

    public function saveFile($entity)
    {
        if ($entity instanceof IFile) {
            if ($entity->getContent()) {
                if (\preg_match("#^data:image#", $entity->getMime())) {
                    $name = Uuid::uuid4();
                    $fileName = $name->toString() . "." . $entity->getExt();
                    $upload_dir = $this->params->get('upload_dir');
                    $company =  Request::getHeader('IM-COMPANY') ?? '';
                    $filePath = "$upload_dir/medias/$company";
                    if (!\file_exists($filePath)) {
                        \mkdir($filePath, 0777, true);
                    }
                    $content = \base64_decode($entity->getContent());
                    $entity->setName($fileName);
                    $entity->setUri($this->req->getCurrentRequest()->getHttpHost());
                    $entity->setType(\get_class($entity));
                    $path = "uploads/medias/" . Request::getHeader('IM-COMPANY') ?? "";
                    $entity->setPath($path);
                    $entity->setContent('');
                    try {
                        \file_put_contents($filePath . "/" . $fileName, $content);
                        $this->logger->info('file: ' . $fileName . ' has just created');
                    } catch (Exception $e) {
                        $this->logger->critical('file: ' . $fileName . ' cannot be created');
                        $this->logger->critical('error: ' . $e->getMessage());
                    }
                }
            }
        }
    }

    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::postPersist,
            Events::postRemove,
            Events::preUpdate,
            Events::postUpdate
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        $entity->setCreated(new \DateTime());
        $entity->setModified(new \DateTime());

        if (method_exists($entity, 'setStatus')) {
            $entity->setStatus('active');
        }

        if (
            $entity instanceof IUser &&
            $entity instanceof UserInterface
        ) {
            $plain = $entity->getPassword();
            if ($plain) {
                $entity->setPassword($this->pw->encodePassword($entity, $plain));
                $apikey = \md5("@im-api-key-{$plain}");
                $entity->setApiKey($apikey);
            }
        }

        if ($entity instanceof IMedia) {
            if ($entity->getFile()) {
                $file = $entity->getFile();
                $file->setType(\get_class($entity));
            }
        }

        if ($entity instanceof IFile) {
            $this->saveFile($entity);
        }

        if ($entity instanceof ITransaction) {
            $this->mailNewOrder($entity);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $entity->setModified(new \DateTime());
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof MediaInterface) {
            try {
                $filePath = $this->params->get('upload_dir') . "/medias/" . Request::getHeader('IM-COMPANY') ?? '';
                $filePath = $filePath . DIRECTORY_SEPARATOR . $entity->getName();
                \unlink($filePath);
                $this->logger->debug('file: ' . $filePath . ' has just removed');
            } catch (\Exception $e) {
                $this->logger->warning('file: ' . $filePath . " couldn't be removed");
            }
        }
    }
}
