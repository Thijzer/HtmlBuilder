<?php

namespace Html\Factory;

use Html\Element\Navigation;
use Html\Functions\NavigationFactoryInterface;
use Html\Modifier\ModifierMatcher;

// easy to configure
class NavigationFactory implements NavigationFactoryInterface
{
    private $matcher;

    public function __construct(ModifierMatcher $matcher)
    {

        $this->matcher = $matcher;
    }
    public function createItem(string $name) : Navigation
    {
         $navigation = new Navigation($name);

         $navigation->setModifierMatcher($this->matcher);

         // extends things from factory

         return $navigation;
    }
}