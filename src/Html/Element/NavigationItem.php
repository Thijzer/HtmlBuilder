<?php

namespace Html\Element;

/**
 * Class NavigationItem
 * @package Html\Element
 *
 * Helper class to contstruct navigationItems
 */

class NavigationItem
{
    private $name;
    private $route;
    private $parent;

    public function __construct(string $name, string $route, NavigationItem $parent = null)
    {
        $this->name = $name;
        $this->route = $route;
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function hasParent()
    {
        return $this->parent !== null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'route' => $this->route
        ];
    }
}