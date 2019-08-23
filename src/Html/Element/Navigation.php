<?php

namespace Html\Element;

use Html\Functions\NavigationInterface;
use Html\Html;
use Html\Modifier\ModifierMatcher;

class Navigation implements NavigationInterface
{
    use BuildTrait;

    private $url;
    private $matcher;
    private $collection;
    private $navigationItems;

    public function __construct(string $name = null, array $navigationItems)
    {
        $this->collection = new NavigationItemCollection();
        $this->navigationItems = $navigationItems;
    }

    public function setModifierMatcher(ModifierMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function addNavigationItem(NavigationItem $item): Navigation
    {
        $this->collection->addNavigationItem($item);

        return $this;
    }

    public function build()
    {
        $nav = Html::elem('nav')->class('nav nav-tabs border-0 flex-column flex-lg-row');

        $navLink = Html::elem('a')->class('nav-link');
        $navItemLi = Html::elem('li')->class('nav-item');

        $dropdown = Html::elem('div')->class('dropdown-menu dropdown-menu-arrow');
        $dropdownItem = Html::elem('a')->class('dropdown-item ');

        $listItems = new UnOrderedList();
        foreach ($items ?? $this->navigationItems as $navigationItem) {
            $cloneNavLink = clone $navLink;

            if (count($navigationItem['items']) > 0) {
                $cloneDropdown = clone $dropdown;
                foreach ($navigationItem['items'] as $item) {
                    $cloneDropdownItem = clone $dropdownItem;
                    $cloneDropdownItem->href($item['options']['route'])->_add($item['options']['label']);
                    $cloneDropdown->_add($cloneDropdownItem);
                }

                $cloneNavLink
                    ->class('nav-link', 'dropdown')
                    ->href('javascript:void(0)')
                    ->_attr('data-toggle', ['dropdown'])
                    ->_add($navigationItem['options']['label'] ?? null)
                    ->_add($cloneDropdown)
                ;
            } else {
                $cloneNavLink
                    ->href($navigationItem['options']['route'] ?? null)
                    ->_add($navigationItem['options']['label'] ?? null)
                ;
            }

            $listItems->addItem($cloneNavLink);
        }

        return $listItems->build(null, $navItemLi)->class('nav nav-tabs border-0 flex-column flex-lg-row');
    }
}
