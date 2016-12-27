<?php

namespace AppBundle\Spec\Product;

use RulerZ\Spec\AbstractSpecification;

class PriceGreaterThan extends AbstractSpecification
{
    private $price;

    public function __construct($price)
    {
        $this->price = (int) $price;
    }

    public function getRule()
    {
        return 'price > :priceGt';
    }

    public function getParameters()
    {
        return [
            'priceGt' => $this->price
        ];
    }
}
