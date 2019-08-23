<?php

namespace Html\Element;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class NavigationItem
{
    use CollectionTrait;

    private $name;
    private $route;
    private $label;

    public function __construct(string $name, string $label, string $route)
    {
        $this->name = $name;
        $this->label = $label;
        $this->route = $route;
    }

    public function addNavigationItem(NavigationItem $item)
    {
        $this->addItem($item);
    }

    public function hasNavigationItems(): bool
    {
        return count($this->getItems()) > 0;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'route' => $this->route,
            'items' => $this->items,
        ];
    }
}