<?php

namespace App\Controller;

use App\Service\CRUD\RoleCrud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1")
 */
class RoleController extends AbstractController
{
    protected RoleCrud $roleCrud;

    public function __construct(
        RoleCrud $roleCrud
    ) {
        $this->roleCrud = $roleCrud;
    }

    /**
     * @Route("/role", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $response = $this->roleCrud->create(
            $request->getContent(),
            ['role']
        );

        return new Response(
            $response,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/roles", methods={"GET"})
     */
    public function getRoles(): Response
    {
        $response = $this->roleCrud->readAll(['role']);

        return new Response(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/role/{roleId}", methods={"DELETE"})
     */
    public function deleteRole(int $roleId): Response
    {
        $this->roleCrud->delete($roleId);

        return new Response(
            Response::HTTP_OK
        );
    }
}
