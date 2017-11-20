<?php

namespace Html\Element;

use Html\Functions\NavigationInterface;
use Html\Html;
use Html\Modifier\ModifierMatcher;

class Navigation implements NavigationInterface
{
    use BuildTrait;

    private $url;
    private $name;
    private $matcher;
    private $collection;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->collection = new NavigationItemCollection();
    }

    public function setModifierMatcher(ModifierMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addChild(string $name, string $route, array $options = null) : Navigation
    {
        $item = new NavigationItem($name, $route);
        $this->collection->addNavigationItem($item);

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
        $nav->_add($button->_add($span));

        $isActive = false;

        $listItems = new UnOrderedList();
        foreach ($this->collection->getNavigationItems() as $navigationItem) {
            $cloneNavItem = clone $navItem;
            $route = $this->matcher ? $this->matcher->getMatches($navigationItem->toArray()) : $navigationItem->toArray();
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

        return $nav->_add($div->_add($listItems));
    }
}
