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
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Paginator $paginator
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function index(EntityManagerInterface $manager, Request $request, Paginator $paginator, SerializerInterface $serializer)
    {
        $data = $paginator->paginate(
            $manager->getRepository(Product::class),
            $request->attributes->get('_route'),
            $request->query->get('page', 1),
        );
        return new Response(
            $serializer->serialize(
                $data,
                'json',
                SerializationContext::create()->setGroups(["Default", "items" => ["global"]])
            )
        );
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
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }
}
