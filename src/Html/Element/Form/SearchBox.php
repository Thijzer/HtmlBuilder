<?php

namespace Html\Element\Form;

use Html\Element\BuildTrait;
use Html\Html;

class SearchBox
{
    use BuildTrait;

    public static function label(string $label): Html
    {
        return Html::elem('div')
            ->id('DataTables_Table_0_filter')
            ->class('dataTables_filter')
            ->_add(
                Label::for('search', $label)
                    ->_add(Input::type('search')->_attr('aria-controls', ['DataTables_Table_0']))
            )
        ;
    }
}