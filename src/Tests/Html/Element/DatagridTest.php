<?php

namespace Tests\Html\Element;

use Html\Element\Datagrid;
use Html\Functions\PaginationInterface;

/** @covers Datagrid */
class DatagridTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_data_grid()
    {
        /** @var PaginationInterface $pagination */
        $pagination = $this->prophesize(PaginationInterface::class);
        $pagination->getCurrentPageResults()->willReturn($this->createData());
        $pagination->haveToPaginate()->willReturn(false);

        $datagrid = new Datagrid($pagination->reveal());
        $datagrid->getTable()->addColumn('name');
        $datagrid->getTable()->addColumn('order');

        $this->assertSame(
            (string) $datagrid,
            '<div id="datagrid"><table class="table table-bordered table-hover"><thead class="thead-default"><th>name</th><th>order</th></thead><tbody><tr><td>nav menu</td><td>0</td></tr><tr><td>sub menu</td><td>1</td></tr><tr><td>admin menu panels</td><td>2</td></tr><tr><td>footer links</td><td>3</td></tr><tr><td>table</td><td>4</td></tr><tr><td>datagrid</td><td>5</td></tr><tr><td>pagination</td><td>6</td></tr></tbody></table></div>'
        );
    }

    public function createData()
    {
        $list = [
            'nav menu',
            'sub menu',
            'admin menu panels',
            'footer links',
            'table',
            'datagrid',
            'pagination'
        ];

        $data = [];
        foreach ($list as $key => $listName) {
            $data[] = [
                'name' => $listName,
                'order' => $key,
            ];
        }

        return $data;
    }
}
