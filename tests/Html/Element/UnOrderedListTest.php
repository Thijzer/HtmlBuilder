<?php

namespace Tests\HtmlBuilder\Element;

use HtmlBuilder\Element\UnOrderedList;
use HtmlBuilder\Html;

/** @covers UnOrderedList */
class UnOrderedListTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_sorted_list()
    {
        $unOrderedList = new UnOrderedList();

        $anchor = Html::elem('a')->href('#');

        for ($i = 1; $i <= 2; $i++) {
            $anchorClone = clone $anchor;
            $unOrderedList->addItem($anchorClone->_add($i));
        }

        $this->assertSame(
            (string) $unOrderedList,
            '<ul><li><a href="#">1</a></li><li><a href="#">2</a></li></ul>'
        );
    }
}
