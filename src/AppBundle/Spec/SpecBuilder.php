<?php

namespace AppBundle\Spec;

use Overblog\GraphQLBundle\Definition\Argument;

class SpecBuilder
{
    /** @var array */
    private $specs = [];

    /** @var Argument */
    private $args;

    public function __construct(Argument $args)
    {
        $this->args = $args;
    }

    /**
     * @param string $specClass
     * @param string $keyName
     * @return $this
     */
    public function add($specClass, $keyName)
    {
        if ($this->args->offsetExists($keyName)) {
            $this->specs[] = new $specClass($this->args->offsetGet($keyName));
        }

        return $this;
    }

    public function build()
    {
        return $this->specs;
    }
}
