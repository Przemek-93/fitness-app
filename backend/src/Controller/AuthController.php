<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * @Route("/v1")
 */
class AuthController extends ApiController
{
    /**
     * @Route("/login")
     */
    public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $JWTManager): Response
    {
        return new JsonResponse(['token' => $JWTManager->create($user)]);
    }
}
