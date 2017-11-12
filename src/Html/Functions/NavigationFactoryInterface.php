<?php

namespace Html\Functions;

use Html\Element\Navigation;

interface NavigationFactoryInterface
{
    public function createItem(string $name) : Navigation;
}
