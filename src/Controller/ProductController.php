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
    public function index()
    {

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
