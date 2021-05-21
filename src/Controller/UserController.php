<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class UserController extends AbstractController
{

    /**
     * Provides new token with basic authentication
     *
     * @Route("/api/login", name="api_login")
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
     * @param EntityManagerInterface $manager
     * @return string
     */
    public function show(EntityManagerInterface $manager)
    {
        return $this->getUser();
    }
}
