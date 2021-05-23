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
use OpenApi\Annotations as OA;

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
     *
     * @OA\Get(
     *     path="/api/customers",
     *     tags={"Customers"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Response(response=200, ref="#/components/responses/customerCollection"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
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


    /**
     * @Get(
     *     path = "/api/customers/{id}",
     *     name = "api_customers_show",
     *     requirements={"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"details"}
     * )
     *
     * @OA\Get(
     *     path="/api/customers/{id}",
     *     tags={"Customers"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(response=200, ref="#/components/responses/customerResource"),
     *     @OA\Response(response=404, ref="#/components/responses/notFound"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @param Customer $customer
     */
    public function show(Customer $customer)
    {
        if($this->getUser() === $customer->getUser())
        {
            return $customer;
        }
        return new Response('Customer not found', 404);

    }

    /**
     * @Post(
     *     path = "/api/customers",
     *     name = "api_customers_store",
     * )
     * @View(
     *     statusCode = 201,
     *     serializerGroups = {"details"}
     * )
     *
     * @OA\Post(
     *     path="/api/customers",
     *     tags={"Customers"},
     *     security={{"BearerAuth"={}}},
     *     @OA\RequestBody(ref="#/components/requestBodies/storeCustomer"),
     *     @OA\Response(response=201, ref="#/components/responses/customerResource"),
     *     @OA\Response(response=400, ref="#/components/responses/badRequest"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @ParamConverter("customer", converter="fos_rest.request_body")
     * @param Customer $customer
     * @param EntityManagerInterface $manager
     * @param ConstraintViolationList $violations
     * @return \FOS\RestBundle\View\View
     * @throws ResourceValidationException
     */
    public function store(Customer $customer, EntityManagerInterface $manager, ConstraintViolationList $violations)
    {
        if(count($violations)){
            $exception = new ResourceValidationException(400);
            $exception->setMessage($violations);
            //$exception = new HttpException(404, "C'est cassé");
            throw $exception;
        } else {
            $customer->setUser($this->getUser());

            $manager->persist($customer);
            $manager->flush();

            return $this->view($customer, Response::HTTP_CREATED,
                ['Location' => $this->generateUrl('api_customers_show',
                    ['id' => $customer->getId(), \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL])
                ]
            );
        }

    }

    /**
     * @Delete(
     *     path = "/api/customers/{id}",
     *     name = "api_customers_delete",
     *     requirements={"id"="\d+"}
     * )
     * @View(
     *     statusCode = 204,
     *     serializerGroups = {}
     * )
     *
     * @OA\Delete (
     *     path="/api/customers/{id}",
     *     tags={"Customers"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(response=204, ref="#/components/responses/delete"),
     *     @OA\Response(response=404, ref="#/components/responses/notFound"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @param Customer $customer
     * @param EntityManagerInterface $manager
     */
    public function delete(Customer $customer, EntityManagerInterface $manager)
    {
        if($this->getUser() === $customer->getUser())
        {
            $manager->remove($customer);
            $manager->flush();
        } else {
            return new HttpException(404, "Customer not found");
        }

    }

    /**
     * @View(
     *     StatusCode = 200,
     *     serializerGroups = {"details"}
     * )
     * @Put(
     *     path = "/api/customers/{id}",
     *     name = "api_customers_update",
     *     requirements = {"id"="\d+"}
     * )
     *
     * @OA\Put(
     *     path="/api/customers/{id}",
     *     tags={"Customers"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/storeCustomer"),
     *     @OA\Response(response=201, ref="#/components/responses/customerResource"),
     *     @OA\Response(response=400, ref="#/components/responses/badRequest"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @ParamConverter("newCustomer", converter="fos_rest.request_body")
     * @param Customer $customer
     * @param Customer $newCustomer
     * @param ConstraintViolationList $violations
     */
    public function update(Customer $customer, Customer $newCustomer, ConstraintViolationList $violations)
    {

        if($this->getUser() === $customer->getUser())
        {
            if(count($violations)){
                return $this->view($violations, Response::HTTP_BAD_REQUEST);
            }

            $customer->setFirstname($newCustomer->getFirstname());
            $customer->setLastname($newCustomer->getLastname());
            $customer->setEmail($newCustomer->getEmail());

            $this->getDoctrine()->getManager()->flush();

            return $customer;
        } else {
            return new HttpException(404, "Customer not found");
        }

    }

}
