<?php

namespace Tests\Html\Element;

use Html\Element\Pagination;
use Html\Element\Table;
use Html\Functions\PaginationInterface;

/** @covers Table */
class PaginationTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_pagination()
    {
        /** @var PaginationInterface $pagination */
        $paginationAdapter = $this->prophesize(PaginationInterface::class);
        $paginationAdapter->getCurrentPageResults()->willReturn($this->createData());
        $paginationAdapter->haveToPaginate()->willReturn(true);
        $paginationAdapter->getCurrentPage()->willReturn(1);
        $paginationAdapter->getNbPages()->willReturn(5);

        $pagination = new Pagination($paginationAdapter->reveal());

        $this->assertSame(
            (string) $pagination,
            '<nav><ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="?page=2">2</a></li><li><a href="?page=3">3</a></li><li><a href="?page=4">4</a></li><li><a href="?page=5">5</a></li><li><a href="?page=1" aria__label="Next"><span>&raquo;</span></a></li></ul></nav>'
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
