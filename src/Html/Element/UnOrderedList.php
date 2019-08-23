<?php

namespace Html\Element;

use Html\Html;

class UnOrderedList
{
    use CollectionTrait;
    use BuildTrait;

    public function build(Html $ul = null, Html $li = null)
    {
        $ul =  $ul ?? Html::elem('ul');
        $li = $li ?? Html::elem('li');

        foreach ($this->items as $key => $item) {
            $cloneLi = clone $li;

            // functions
            if (isset($this->functions[$key])) {
                $cloneIL = call_user_func($this->functions[$key], $cloneLi);
            }

            $ul->_add($cloneLi->_add($item));
        }

        return $ul;
    }
}
