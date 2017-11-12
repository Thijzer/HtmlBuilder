<?php

namespace Html\Element;

use Html\Functions\NavigationInterface;
use Html\Html;

class Navigation implements NavigationInterface
{
    private $url;
    private $routes = [];
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addChild(string $name, array $route = null) : Navigation
    {
        $route['name'] = $name;
        $this->routes[$name] =  $route;

        return $this;
    }

    public function build()
    {
        $nav = Html::elem('nav')->class('navbar navbar-expand-md navbar-dark bg-dark fixed-top');
        $span = Html::elem('navbar-toggler-icon');
        $div = Html::elem('collapse navbar-collapse')->id('navbarsExampleDefault');
        $navItem = Html::elem('a')->class('nav-link');

        $button = Html::elem('nav')
            ->class('navbar-toggler')
            ->type('button')
            ->data__toggle('collapse')
            ->data__target('#navbarsExampleDefault')
            ->aria__controls('navbarsExampleDefault')
        ;

        $isActive = false;

        $listItems = new UnOrderedList();
        foreach ($this->routes as $route) {
            $cloneNavItem = clone $navItem;
            $listItems->addItem($cloneNavItem->href($route['uri']), $isActive ? function (Html $li) {
                return $li->class('active');
            }: null);
            $cloneNavItem->_add($route['name']);
        }

        $listItems->build()->class('navbar-nav mr-auto');

        // brand elem
        if ($this->url) {
            $nav->_add(
                Html::elem('a')
                    ->class('navbar-brand')
                    ->href($this->url)
                    ->_add('title')

            );
        }

        return $nav->_add($button->_add($span))->_add($div->_add($listItems));
    }
}
