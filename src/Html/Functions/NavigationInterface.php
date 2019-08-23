<?php

namespace Html\Functions;

use Html\Element\Navigation;
use Html\Element\NavigationItem;

interface NavigationInterface
{
    public function addNavigationItem(NavigationItem $item): Navigation;
}
