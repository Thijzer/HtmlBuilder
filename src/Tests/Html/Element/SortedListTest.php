<?php

namespace Tests\Html\Element;

use Html\Element\SortedList;
use Html\Html;

/** @covers SortedList */
class SortedListTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_sorted_list()
    {
        $sorted = new SortedList();

        $anchor = Html::elem('a')->href('#');

        for ($i = 1; $i <= 2; $i++) {
            $anchorClone = clone $anchor;
            $sorted->addItem($anchorClone->_add($i));
        }

        $this->assertSame(
            (string) $sorted,
            '<ol><li><a href="#">1</a></li><li><a href="#">2</a></li></ol>'
        );
    }
}
