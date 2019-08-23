<?php

namespace Html\Element\Form;

use Html\Html;

class Input implements FormElement
{
    const BUTTON = 'button';
    const CHECKBOX = 'checkbox';
    const COLOR = 'color';
    const DATE = 'date';
    const DATETIME_LOCAL = 'datetime-local';
    const EMAIL = 'email';
    const FILE = 'file';
    const HIDDEN = 'hidden';
    const IMAGE = 'image';
    const NUMBER = 'number';
    const PASSWORD = 'password';
    const RADIO = 'radio';
    const RANGE = 'range';
    const RESET = 'reset';
    const SEARCH = 'search';
    const SUBMIT = 'submit';
    const TEL = 'tel';
    const TEXT = 'text';
    const TIME = 'time';
    const URL = 'url';
    const WEEK = 'week';

    private $name;
    private $value;
    private $type;

    public static function type(string $type, $value = null) : Html
    {
        return Html::solidus('input')->type($type)->value($value);
    }
}
