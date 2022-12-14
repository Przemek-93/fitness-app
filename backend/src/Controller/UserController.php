<?php

namespace App\Controller;

use App\Service\CRUD\UserCrud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1")
 */
class UserController extends AbstractController
{
    protected UserCrud $userCrud;

    public function __construct(
        UserCrud $userCrud
    ) {
        $this->userCrud = $userCrud;
    }

    /**
     * @Route("/user", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $response = $this->userCrud->create(
            $request->getContent(),
            ['user']
        );

        return new Response(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/user", methods={"GET"})
     */
    public function getLogged(): Response
    {
        $response = $this->userCrud->getLogged(
            $this->getUser(),
            ['user', 'user-role']
        );

        return new Response(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/user/{userId}", methods={"DELETE"})
     */
    public function deleteUser(int $userId): Response
    {
        $this->userCrud->delete($userId);

        return new Response(
            Response::HTTP_OK
        );
    }
}
