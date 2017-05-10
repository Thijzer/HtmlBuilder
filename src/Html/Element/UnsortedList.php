<?php

namespace Html\Element;

use Html\Html;

class UnsortedList
{
    use CollectionTrait;
    use BuildTrait;

    public function build()
    {
        $ul = Html::elem('ul');
        $li = Html::elem('li');

        foreach ($this->items as $item) {
            $cloneLi = clone $li;
            $ul->_add($cloneLi->_add($item));
        }

        return $ul;
    }
}
