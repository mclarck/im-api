<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityController.
 *
 * @Route("/security")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     *
     * @return JsonResponse
     */
    public function login(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $content = \json_decode($request->getContent());
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class)
            ->findOneBy(['email' => isset($content->email) ? $content->email : null]);
        if ($user) {
            if (isset($content->password)) {
                if ($encoder->isPasswordValid($user, $content->password)) {
                    return $this->json($user);
                }
            }
        }

        return $this->json($user, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("/check")
     *
     * @return JsonResponse
     */
    public function check(Request $request)
    {
        $content = \json_decode($request->getContent());
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class)
            ->findOneBy(['email' => isset($content->email) ? $content->email : null]);
        if ($user) {
            return $this->json($user);
        }

        return $this->json($user, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("/client")
     *
     * @return JsonResponse
     */
    public function client(Request $request)
    {
        $content = \json_decode($request->getContent());
        if (isset($content->username) && !empty($content->username)) {
            $criteria = ['username' => $content->username];
        }
        if (isset($content->email) && !empty($content->email)) {
            $criteria['email'] = $content->email;
        }
        if (isset($content->phone) && !empty($content->phone)) {
            $criteria['phone'] = $content->phone;
        }
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(Client::class)
            ->findOneBy($criteria);

        if ($user) {
            return $this->json($user);
        }
        return $this->json($user, Response::HTTP_UNAUTHORIZED);
    }
}
