<?php

namespace AppBundle\Spec\Product;

use RulerZ\Spec\AbstractSpecification;

class PriceLessThan extends AbstractSpecification
{
    private $price;

    public function __construct($price)
    {
        $this->price = (int) $price;
    }

    public function getRule()
    {
        return 'price < :priceLt';
    }

    public function getParameters()
    {
        return [
            'priceLt' => $this->price
        ];
    }
}
