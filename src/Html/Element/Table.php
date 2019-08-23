<?php

namespace Html\Element;

use App\Bundle\CoreBundle\DataGrid\RowModifier\IconRowModifier;
use App\Bundle\CoreBundle\DataGrid\RowModifier\LinkRowModifier;
use App\Domain\CommonDomain\Arrayable;
use Html\Html;
use Html\Modifier\TemplateModifier;

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

    public function addColumn(string $ColName, string $label, array $columnModifiers = [], array $rowModifiers = [])
    {
        $this->column[$ColName] = $label;

        foreach ($columnModifiers as $modifier) {
            $this->modifiers[$ColName]['column'][] = $modifier;
        }

        foreach ($rowModifiers as $modifier) {
            $this->modifiers[$ColName]['row'][] = $modifier;
        }

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function render() : string
    {
        $tr = Html::elem('tr')->role('row');
        $th = Html::elem('th');
        $td = Html::elem('td');

        // head
        $thList = null;
        $trHead = clone $tr;
        foreach ($this->column as $ColName) {
            $thCopy = clone $th;
            $thList .= $thCopy
                //->class('sorting')
                ->_attr('aria-controls', ['DataTables_Table_0'])
                ->_attr('aria-label', ['Invoice Subject: activate to sort column ascending'])
                ->_add($ColName)
            ;
        }
        $trHead->_add($thList);

        // body
        $trList = null;
        foreach ($this->rows as $row) {
            $trCopy = clone $tr;
            $tdList = null;
            foreach (array_keys($this->column) as $ColName) {
                $rowName = $row[$ColName] ?? '';

                // row functions
                if (isset($this->modifiers[$ColName]['row'])) {
                    foreach ($this->modifiers[$ColName]['row'] as $modifier) {
                        if ($modifier instanceof Arrayable) {
                            $modifier = $modifier->toArray();
                            $rowName = Badge::createFromArray($modifier['options'][$rowName] ?? $modifier, $rowName);
                            continue;
                        }
                        if (is_callable($modifier)) {
                            $rowName = call_user_func($modifier, $rowName, $row);
                            if ($rowName instanceof IconRowModifier) {
                                $rowName = Icon::createFromModifier($rowName);
                            } elseif ($rowName instanceof LinkRowModifier) {
                                $rowName = Link::createFromModifier($rowName);
                            }
                        }
                    }
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

        $table->_add($tHead->_add($trHead), $tBody->_add($trList));

        return TemplateModifier::modify(Table::class, $table);
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
