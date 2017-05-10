<?php

namespace Html\Element;

use Html\Html;

class SortedList
{
    use CollectionTrait;
    use BuildTrait;

    public function build()
    {
        $ul = Html::elem('ol');
        $li = Html::elem('li');

        foreach ($this->items as $item) {
            $cloneLi = clone $li;
            $ul->_add($cloneLi->_add($item));
        }

        return $ul;
    }
}
