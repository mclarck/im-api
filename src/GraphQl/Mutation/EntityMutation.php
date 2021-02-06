<?php


namespace App\GraphQl\Mutation;


use ApiPlatform\Core\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\Entity;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class EntityMutation implements MutationResolverInterface
{

    private UserPasswordEncoderInterface $pw;


    public function __construct(UserPasswordEncoderInterface $pw)
    {
        $this->pw = $pw;
    }

    /**
     * @param Entity|null $item
     * @param array $context
     * @return Entity|null
     */
    public function __invoke($item, array $context)
    {
        $context["pw"] = $this->pw;
        // $item->beforeSave($context);
        return $item;
    }
}