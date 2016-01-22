<?php

namespace Html;

/**
 * Simple Table Builder
 */
class Table
{
    /**
     * list of used function modifiers.
     *
     * @var array
     */
    private $function;

    /**
     * rowCount.
     *
     * @var [type]
     */
    private $i;

    /**
     * rowData.
     *
     * @var rows
     */
    private $rows;

    /**
     * columnData.
     *
     * @var rows
     */
    private $column;

    public function __construct()
    {
        $this->i = null;
    }

    public function setData($data)
    {
        foreach ($data as $value) {
            $this->addRow($value);
        }
    }

    /**
     * adding a row.
     */
    private function addRow($row)
    {
        $this->rows[] = $row;
    }

    /**
     * adding a row.
     */
    public function add($th, $function = null)
    {
        $this->column[] = $th;

        if (null !== $function) {
            $this->function[$th] = $function;
        }

        return $this;
    }

    /**
     * render the table.
     *
     * @return
     */
    public function render()
    {
        $tr = Html::elem('tr');
        $th = Html::elem('th');
        $td = Html::elem('td');

        // head
        $thList = null;
        foreach ($this->column as $ColName) {
            $thcopy = $th;
            $thList .= $thcopy->end($ColName);
        }

        // body
        $trList = null;
        foreach ($this->rows as $row) {
            $trcopy = $tr;
            $tdList = null;
            foreach ($this->column as $ColName) {
                $rowName = isset($row[$ColName]) ? $row[$ColName] : '';

                // functions
                if (isset($this->function[$ColName])) {
                    $rowName = $this->{$this->function[$ColName]}($rowName);
                }

                // table data
                $tdcopy = $td;
                $tdList .= $tdcopy->end($rowName);
            }
            $trList .= $trcopy->end($tdList);
        }

        // structure
        $table = Html::elem('table');
        $thead = Html::elem('thead');
        $tbody = Html::elem('tbody');

        return $table
            ->class('table table-bordered table-hover')
            ->end(
                $thead->class('thead-default')->end($thList).
                $tbody->end($trList)
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
        return html::elem('a')->href($value)->end($value);
    }
}
