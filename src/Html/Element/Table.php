<?php

namespace Html\Element;

use Html\Html;

class Table
{
    private $function;

    private $i = null;
    private $rows = [];
    private $column = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $rowData) {
            $this->addRow($rowData);
        }
    }

    private function addRow(array $rowData)
    {
        $this->rows[] = $rowData;
    }

    public function addColumn(string $th, $function = null)
    {
        $this->column[] = $th;

        if (null !== $function) {
            $this->function[$th] = $function;
        }

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function render() : string
    {
        $tr = Html::elem('tr');
        $th = Html::elem('th');
        $td = Html::elem('td');

        // head
        $thList = null;
        foreach ($this->column as $ColName) {
            $thcopy = clone $th;
            $thList .= $thcopy->_add($ColName);
        }

        // body
        $trList = null;
        foreach ($this->rows as $row) {
            $trCopy = clone $tr;
            $tdList = null;
            foreach ($this->column as $ColName) {
                $rowName = isset($row[$ColName]) ? $row[$ColName] : '';

                // functions
                if (isset($this->function[$ColName])) {
                    $rowName = $this->{$this->function[$ColName]}($rowName);
                }

                // table data
                $tdCopy = clone $td;
                $tdList .= $tdCopy->_add($rowName);
            }
            $trList .= $trCopy->_add($tdList);
        }

        // structure_close
        $table = Html::elem('table');
        $thead = Html::elem('thead');
        $tbody = Html::elem('tbody');

        return $table
            ->class('table table-bordered table-hover')
            ->_add(
                $thead->class('thead-default')->_add($thList).
                $tbody->_add($trList)
            );
    }

    // list of modifiers

    public function rowcount()
    {
        return ++$this->i;
    }

    public function boolean($value)
    {
        return ((int) $value === 1) ? 'true' : 'false';
    }

    public function arrayCount($value)
    {
        return count($value);
    }

    public function link($value)
    {
        return Html::elem('a')->href($value)->_add($value);
    }
}
