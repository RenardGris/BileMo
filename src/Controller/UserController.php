<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use OpenApi\Annotations as OA;

class UserController extends AbstractController
{

    /**
     * Provides new token with basic authentication
     *
     * @Route("/api/login", name="api_login")
     *
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"User"},
     *     @OA\RequestBody(ref="#/components/requestBodies/loginUser"),
     *     @OA\Response(response=200, ref="#/components/responses/loggedUser"),
     *     @OA\Response(response=400, ref="#/components/responses/badRequest"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidCredential"),
     * )
     */
    public function login()
    {

    }

    /**
     * Show details for the current logged user
     *
     *
     * @Get(
     *     path = "/api/users",
     *     name = "api_user_show"
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"global","details"}
     * )
     *
     *
     * @OA\Get(
     *     path="/api/users",
     *     tags={"User"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Response(response=200, ref="#/components/responses/loggedUser"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @param EntityManagerInterface $manager
     * @return string
     */
    public function show(EntityManagerInterface $manager)
    {
        return $this->getUser();
    }
}
