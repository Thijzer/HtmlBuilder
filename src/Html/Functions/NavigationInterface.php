<?php

namespace Html\Functions;

use Html\Element\Navigation;

interface NavigationInterface
{
    public function addChild(string $name, string $route, array $options = []) : Navigation;
}
