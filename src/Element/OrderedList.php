<?php

namespace HtmlBuilder\Element;

use HtmlBuilder\Html;

class OrderedList
{
    use CollectionTrait;
    use BuildTrait;

    public function build()
    {
        $ol = Html::elem('ol');
        $li = Html::elem('li');

        foreach ($this->items as $key => $item) {
            $cloneLi = clone $li;

            // functions
            if (isset($this->functions[$key])) {
                $cloneLi = call_user_func($this->functions[$key], $cloneLi);
            }

            $ol->_add($cloneLi->_add($item));
        }

        return $ol;
    }
}
