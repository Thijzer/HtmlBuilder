<?php

namespace HtmlBuilder\Element;

use Doctrine\Common\Collections\ArrayCollection;

class NavigationItemCollection
{
    private $navigationItems = [];

    public function __construct()
    {
    }

    public function addNavigationItem(NavigationItem $item)
    {
        $this->navigationItems[] = $item;
    }

    /**
     * @return NavigationItem[] || array
     */
    public function getNavigationItems()
    {
        return $this->navigationItems;
    }
}