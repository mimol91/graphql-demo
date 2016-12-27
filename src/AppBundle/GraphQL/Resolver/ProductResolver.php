<?php

namespace AppBundle\GraphQL\Resolver;

use AppBundle\Entity\Product;
use AppBundle\Repository\ProductRepository;
use AppBundle\Spec\Product\PriceGreaterThan;
use AppBundle\Spec\Product\PriceLessThan;
use AppBundle\Spec\SpecBuilder;
use JMS\Serializer\Serializer;
use Overblog\GraphQLBundle\Definition\Argument;
use RulerZ\RulerZ;
use RulerZ\Spec\AndX;

class ProductResolver extends AbstractResolver
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(Serializer $serializer, RulerZ $rulerZ, ProductRepository $productRepository)
    {
        parent::__construct($serializer, $rulerZ);

        $this->productRepository = $productRepository;
    }

    public function resolveProduct(Argument $args)
    {
        $product = $this->productRepository->find($args['id']);
        if (!$product instanceof Product) {
            return;
        }

        return $this->serializer->toArray($product);
    }

    public function resolveProducts(Argument $args)
    {
        $specificationBuilder = new SpecBuilder($args);
        $specificationBuilder
            ->add(PriceLessThan::class, 'priceLessThan')
            ->add(PriceGreaterThan::class, 'priceGreaterThan');

        $products = $this->rulerZ->filterSpec(
            $this->productRepository->createQueryBuilder('p'),
            new AndX($specificationBuilder->build())
        );

        return $this->serializer->toArray(iterator_to_array($products));
    }
}
