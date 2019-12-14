<?php

namespace Tests\HtmlBuilder\Element;

use HtmlBuilder\Element\OrderedList;
use HtmlBuilder\Html;

/** @covers OrderedList */
class OrderedListTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_sorted_list()
    {
        $sorted = new OrderedList();

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
