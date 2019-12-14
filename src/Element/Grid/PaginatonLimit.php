<?php

namespace HtmlBuilder\Element\Grid;

use HtmlBuilder\Element\BuildTrait;
use HtmlBuilder\Element\Form\Label;
use HtmlBuilder\Element\Form\Select;
use HtmlBuilder\Html;

class PaginatonLimit
{
    use BuildTrait;

    private $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function build(): Html
    {
        return Html::elem('div')
            ->class('dataTables_length')
            ->id('DataTables_Table_0_length')
            ->_add(
                Label::for('entries', 'Show ', Select::options($this->options), ' entries')
            )
        ;
    }
}
