<?php

namespace HtmlBuilder\Functions;

use HtmlBuilder\Element\Navigation;
use HtmlBuilder\Element\NavigationItem;

interface NavigationInterface
{
    public function addNavigationItem(NavigationItem $item): Navigation;
}
