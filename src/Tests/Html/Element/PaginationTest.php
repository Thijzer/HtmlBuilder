<?php

namespace Tests\Html\Element;

use Html\Element\Pagination;
use Html\Element\Table;

/** @covers Table */
class PaginationTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_pagination()
    {
        $pagination = new Pagination();

        for ($i = 1; $i <= 5; $i++) {
            $pagination->addLink('#', $i);
        }

        $this->assertSame(
            '<nav><ul><li><a href="#" aria-label="Previous"><span>&laquo;</span></a></li><li><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li><a href="#" aria-label="Next"><span>&raquo;</span></a></li></ul></nav>',
            (string) $pagination
        );
    }
}
