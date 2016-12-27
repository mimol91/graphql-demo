<?php

namespace AppBundle\GraphQL\Resolver;

use AppBundle\Entity\Product;
use AppBundle\Repository\ProductRepository;
use JMS\Serializer\Serializer;
use Overblog\GraphQLBundle\Definition\Argument;

class ProductResolver
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var Serializer */
    private $serializer;

    public function __construct(ProductRepository $productRepository, Serializer $serializer)
    {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
    }


    public function resolveProduct(Argument $args)
    {
        $product = $this->productRepository->find($args['id']);
        if (!$product instanceof Product) {
            return;
        }

        return $this->serializer->toArray($product);
    }

    public function resolveProducts()
    {
        $products = $this->productRepository->findAll();
        
        return $this->serializer->toArray($products);
    }
}
