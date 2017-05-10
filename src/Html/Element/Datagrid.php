<?php

namespace Html\Element;

use Html\Html;

class Datagrid
{
    use BuildTrait;

    private $table;

    public function __construct(array $data = [])
    {
        $this->table = new Table($data);
    }

    public function getTable()
    {
        return $this->table;
    }

    public function build()
    {
        $div = Html::elem('div');
        $pagination = new Pagination();


        for ($i = 1; $i <= 5; $i++) {
            $pagination->addLink('#', $i);
        }

        return $div->_add($this->table)->_add($pagination);
    }
}
