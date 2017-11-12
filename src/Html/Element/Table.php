<?php

namespace Html\Element;

use Html\Html;

class Table
{
    private $i;
    private $modifiers = [];
    private $rows = [];
    private $column = [];

    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    public function setData(array $data)
    {
        foreach ($data as $rowData) {
            $this->addRow((array) $rowData);
        }
    }

    private function addRow(array $rowData)
    {
        $this->rows[] = $rowData;
    }

    public function addColumn(string $ColName, $function = null)
    {
        $this->column[] = $ColName;

        if ($function) {
            $this->modifiers[$ColName] = $function;
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
            $thCopy = clone $th;
            $thList .= $thCopy->_add($ColName);
        }

        // body
        $trList = null;
        foreach ($this->rows as $row) {
            $trCopy = clone $tr;
            $tdList = null;
            foreach ($this->column as $ColName) {
                $rowName = $row[$ColName] ?? '';

                // functions
                if (isset($this->modifiers[$ColName])) {
                    $rowName = call_user_func($this->modifiers[$ColName], $row, $ColName);
                }

                // table data
                $tdCopy = clone $td;
                $tdList .= $tdCopy->_add($rowName);
            }
            $trList .= $trCopy->_add($tdList);
        }

        // structure_close
        $table = Html::elem('table');
        $tHead = Html::elem('thead');
        $tBody = Html::elem('tbody');

        return $table
            ->class('table table-bordered table-hover')
            ->_add(
                $tHead->class('thead-default')->_add($thList).
                $tBody->_add($trList)
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
}
