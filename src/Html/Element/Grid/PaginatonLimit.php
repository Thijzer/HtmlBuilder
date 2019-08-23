<?php

namespace Html\Element\Grid;

use Html\Element\BuildTrait;
use Html\Element\Form\Label;
use Html\Element\Form\Select;
use Html\Html;

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
