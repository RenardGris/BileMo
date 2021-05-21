<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Exception\ResourceValidationException;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Hateoas\UrlGenerator\UrlGeneratorInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;

class CustomerController extends AbstractFOSRestController
{
    /**
     * @Get(
     *     path = "/api/customers",
     *     name = "api_customers_index"
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"global"}
     * )
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Paginator $paginator
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function index(EntityManagerInterface $manager, Request $request, Paginator $paginator, SerializerInterface $serializer)
    {
        $data = $paginator->paginate(
            $manager->getRepository(Customer::class),
            $request->attributes->get('_route'),
            $request->query->get('page', 1),
            ["User" => $this->getUser()->getId()]
        );

        return new Response(
            $serializer->serialize(
                $data,
                'json',
                SerializationContext::create()
                    ->setGroups(["Default", "items" => ["global", "user" => ["fromCustomer"]] ]))
        );
    }

    public function index()
    {

    }

    public function show()
    {

    }

    public function store()
    {

    }

    public function delete()
    {

    }

}
