<?php

namespace HtmlBuilder\Element;

use HtmlBuilder\Html;

class Badge
{
    private static $classOptions = [
        'warning' => 'badge badge-warning',
        'success' => 'badge badge-success',
        'danger' => 'badge badge-danger',
        'muted' => 'text-muted',
        'default' => 'badge badge-default',
    ];

    public static function createFromArray($options, $value): Html
    {
        $span = Html::elem('span')->class(self::$classOptions[$options['style']]);

        if (isset($options['label'])) {
            $span->_add($options['label']);
        } else {
            $span->_add($value);
        }

        return  $span;
    }
}