<?php

namespace HtmlBuilder\Element;

use HtmlBuilder\Html;

class Select implements FormElement
{
    use BuildTrait;
    use ArgumentTrait;

    private $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function build()
    {
        $option = Html::elem('option');
        $select = Html::elem('select');

        if ($this->options) {
            $this->options = array_combine($this->options, $this->options);
        }

        foreach ($this->options as $key => $value) {
            $copy = clone $option;
            $copy->value($key)->add($value);
            // selected
            $select->_add($copy);
        }

        $this->setArgs($select);

        return $select;
    }
}