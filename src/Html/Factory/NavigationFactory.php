<?php

namespace Html\Factory;

use Html\Element\Navigation;
use Html\Functions\NavigationFactoryInterface;

// easy to configure
class NavigationFactory implements NavigationFactoryInterface
{
    public function createItem(string $name) : Navigation
    {
         $navigation = new Navigation($name);

         // extends things from factory

         return $navigation;
    }
}