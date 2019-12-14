<?php

namespace HtmlBuilder\Functions;

use HtmlBuilder\Element\Navigation;

interface NavigationFactoryInterface
{
    public function createItem(string $name) : Navigation;
}
