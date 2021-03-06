<?php

/**
 * @covers \HtmlBuilder\Html
 */
class HtmlTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_html_object()
    {
        $a = HtmlBuilder\Html::elem('a');
        $b = HtmlBuilder\Html::elem('b')->href('my-link');
        $c = HtmlBuilder\Html::elem('c')->href('my-link');
        $c->class('new');

        self::assertSame(
            (string) $a,
            '<a></a>'
        );

        self::assertSame(
            (string) $b,
            '<b href="my-link"></b>'
        );

        self::assertSame(
            (string) $c,
            '<c href="my-link" class="new"></c>'
        );

        $ab = clone $a;
        self::assertSame(
            (string) $ab->_add($b),
            '<a><b href="my-link"></b></a>'
        );

        $abc = clone $a;
        self::assertSame(
            (string) $abc->_add($b->_add($c)),
            '<a><b href="my-link"><c href="my-link" class="new"></c></b></a>'
        );
    }

    /** @test */
    public function it_should_make_a_paragraph()
    {
        $p = HtmlBuilder\Html::elem('p');
        $span = HtmlBuilder\Html::elem('span')->_add('highlighted test');

        $p->_add('some text')->_add($span)->_add('some more test');

        $this->assertSame(
            (string) $p,
            '<p>some text<span>highlighted test</span>some more test</p>'
        );
    }
}
