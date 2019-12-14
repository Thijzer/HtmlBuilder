<?php

namespace HtmlBuilder\Element\Form;

use HtmlBuilder\Element\BuildTrait;
use HtmlBuilder\Element\CollectionTrait;
use HtmlBuilder\Html;

class Select
{
    public static function options(array $items): Html
    {
        $select = Html::elem('select')->_attr('aria-controls', ['DataTables_Table_0'])->name('DataTables_Table_0_length');

        foreach ($items as $item) {
            $select->_add(
                Html::elem('option')->_attr('value', [$item['value']])->_add($item['label'])
            );
        }

        return $select;
    }
}
