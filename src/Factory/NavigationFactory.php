<?php

namespace HtmlBuilder\Factory;

use HtmlBuilder\Element\Navigation;
use HtmlBuilder\Functions\NavigationFactoryInterface;
use HtmlBuilder\Modifier\ModifierMatcher;

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