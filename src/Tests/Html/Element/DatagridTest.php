<?php

namespace Tests\Html\Element;

use Html\Element\Datagrid;

/** @covers Datagrid */
class DatagridTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_table()
    {
        $datagrid = new Datagrid($this->createData());
        $datagrid->getTable()->addColumn('name');
        $datagrid->getTable()->addColumn('order');

        $this->assertSame(
            (string) $datagrid,
            '<div><table class="table table-bordered table-hover"><thead class="thead-default"><th>name</th><th>order</th></thead><tbody><tr><td>nav menu</td><td>0</td></tr><tr><td>sub menu</td><td>1</td></tr><tr><td>admin menu panels</td><td>2</td></tr><tr><td>footer links</td><td>3</td></tr><tr><td>table</td><td>4</td></tr><tr><td>datagrid</td><td>5</td></tr><tr><td>pagination</td><td>6</td></tr></tbody></table><nav><ul><li><a href="#" aria-label="Previous"><span>&laquo;</span></a></li><li><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li><a href="#" aria-label="Next"><span>&raquo;</span></a></li></ul></nav></div>'
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
        foreach ($list as $key =>$listName) {
            $data[] = [
                'name' => $listName,
                'order' => $key,
            ];
        }

        return $data;
    }
}
