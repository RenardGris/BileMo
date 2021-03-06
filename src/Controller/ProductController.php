<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use OpenApi\Annotations as OA;

class ProductController extends AbstractController
{

    /**
     * @Get(
     *     path = "/api/products",
     *     name = "api_products_index"
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"global"}
     * )
     *
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Response(response=200, ref="#/components/responses/productCollection"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Paginator $paginator
     * @param SerializerInterface $serializer
     * @return array
     */
    public function index(EntityManagerInterface $manager, Request $request, Paginator $paginator, SerializerInterface $serializer)
    {
        $data = $paginator->paginate(
            $manager->getRepository(Product::class),
            $request->attributes->get('_route'),
            $request->query->get('page', 1),
        );

        $serializedData = $serializer->serialize(
            $data,
            'json',
            SerializationContext::create()
                ->setGroups(["Default", "items" => ["global", "items" => ["global"]] ]));

        return $paginator->getPaginatedResponse($serializedData);
    }

    /**
     * @Get(
     *     path = "/api/products/{id}",
     *     name = "api_products_show",
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"details"}
     * )
     *
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     security={{"BearerAuth"={}}},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(response=200, ref="#/components/responses/productResource"),
     *     @OA\Response(response=404, ref="#/components/responses/notFound"),
     *     @OA\Response(response=401, ref="#/components/responses/invalidToken"),
     * )
     *
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }
}
