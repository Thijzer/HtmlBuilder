<?php

namespace Html\Element;

use Html\Html;

class   Pagination
{
    use CollectionTrait;
    use BuildTrait;

    public function addLink($url, $index)
    {
        $this->items[$index] = $url;
    }

    public function build()
    {
        $nav = Html::elem('nav');
        $anchor = Html::elem('a');
        $spanA = Html::elem('span');
        $buttonA = clone $anchor;
        $buttonB = clone $anchor;
        $spanB = clone $spanA;

        $buttonA->href('#')->aria__label('Previous')->_add($spanA->_add('&laquo;'));
        $buttonB->href('#')->aria__label('Next')->_add($spanB->_add('&raquo;'));

        $list = new UnsortedList();
        $list->addItem($buttonA);
        foreach ($this->items as $index => $url) {
            $anchorClone = clone $anchor;
            $list->addItem($anchorClone->href($url)->_add($index));
        }
        $list->addItem($buttonB);

        return $nav->_add($list);
    }
}
