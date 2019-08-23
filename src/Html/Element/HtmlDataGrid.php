<?php

namespace Html\Element;

use App\Bundle\CoreBundle\DataGrid\DataGridBuilderInterface;
use App\Bundle\CoreBundle\DataGrid\DataGridOptions;
use Html\Functions\PaginationInterface;

class HtmlDataGrid
{
    private $dataGridBuilder;
    private $paging;

    public function __construct(PaginationInterface $paging, DataGridBuilderInterface $dataGridBuilder)
    {
        $this->paging = $paging;
        $this->dataGridBuilder = $dataGridBuilder;
    }

    public function create(): string
    {
        $datagrid = new Datagrid($this->paging);
        $datagridTable = $datagrid->getTable();

        foreach ($this->dataGridBuilder->getFilters() as $filter) {

        }

        foreach ($this->dataGridBuilder->getColumns() as $column) {
            $datagridTable->addColumn(
                $column['name'],
                $this->dataGridBuilder->trans($column['label']),
                $column['columnModifiers'],
                $column['rowModifiers']
            );
        }

        foreach ($this->dataGridBuilder->getActions() as $action) {
            $datagridTable->addColumn(
                $action['type'],
                $this->dataGridBuilder->trans($action['label']),
                [],
                $action['rowModifiers']
            );
        }

        return $datagrid;
    }

    public function __toString(): string
    {
        return $this->create();
    }
}