<?php

namespace App\Controller;

use App\Service\CRUD\TrainingActivityCrud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1")
 */
class TrainingActivityController extends AbstractController
{
    protected TrainingActivityCrud $activityCrud;

    public function __construct(TrainingActivityCrud $activityCrud)
    {
        $this->activityCrud = $activityCrud;
    }

    /**
     * @Route("/training/activity", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $response = $this->activityCrud->createActivity(
            $this->getUser(),
            $request->getContent(),
            ['trainingActivity']
        );

        return new Response(
            $response,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/training/activity", methods={"PATCH"})
     */
    public function update(Request $request): Response
    {
        $response = $this->activityCrud->update(
            $request->getContent(),
            ['trainingActivity']
        );

        return new Response(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/training/activity", methods={"GET"})
     */
    public function getAllByUser(): Response
    {
        $response = $this->activityCrud->readAllByUser(
            $this->getUser(),
            ['trainingActivity']
        );

        return new Response(
            $response,
            Response::HTTP_FOUND
        );
    }

    /**
     * @Route("/training/activity/{activityId}", methods={"DELETE"})
     */
    public function delete(int $activityId): Response
    {
        $this->activityCrud->delete($activityId);

        return new Response(
            Response::HTTP_OK
        );
    }
}
