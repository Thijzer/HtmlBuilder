<?php

namespace Html\Element;

use Html\Html;

/**
 * @method FormElement onclick(mixed $attribute)
 */
trait ArgumentTrait
{
    private $args = [];

    public function setArgs(Html $html)
    {
        foreach ($this->args as $method => $arg) {
            $html->_attr($method, $arg);
        }
    }

    public function __call(string $method, $args)
    {
        $this->args[$method] = $args;

        return $this;
    }
}