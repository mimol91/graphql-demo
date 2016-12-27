<?php

namespace AppBundle\GraphQL\Resolver;

use JMS\Serializer\Serializer;
use RulerZ\RulerZ;

abstract class AbstractResolver
{
    /** @var Serializer */
    protected $serializer;

    /** @var RulerZ */
    protected $rulerZ;

    public function __construct(Serializer $serializer, RulerZ $rulerZ)
    {
        $this->serializer = $serializer;
        $this->rulerZ = $rulerZ;
    }
}
