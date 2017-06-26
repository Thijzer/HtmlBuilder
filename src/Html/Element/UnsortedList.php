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

        foreach ($this->items as $key => $item) {
            $cloneLi = clone $li;

            // functions
            if (isset($this->functions[$key])) {
                $cloneLi = call_user_func($this->functions[$key], $cloneLi);
            }

            $ul->_add($cloneLi->_add($item));
        }

        return $ul;
    }
}
