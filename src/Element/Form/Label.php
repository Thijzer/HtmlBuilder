<?php

namespace HtmlBuilder\Element\Form;

use HtmlBuilder\Html;

class Label
{
    public static function for(string $for, ...$labels): Html
    {
        return Html::elem('label')
            ->for($for)
            ->_add(...$labels)
        ;
    }
}