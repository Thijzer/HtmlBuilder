<?php

namespace Tests\HtmlBuilder\Element;

use HtmlBuilder\Element\Table;

/** @covers Table */
class TableTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_table()
    {
        $data = [
            [
                'a' => '1',
                'b' => '2',
            ],
            [
                'a' => '3',
                'b' => '4',
            ]
        ];
        $table = new Table($data);

        $table
            ->addColumn('a')
            ->addColumn('b')
        ;

        self::assertSame(
            (string) $table,
            '<table class="table table-bordered table-hover"><thead class="thead-default"><th>a</th><th>b</th></thead><tbody><tr><td>1</td><td>2</td></tr><tr><td>3</td><td>4</td></tr></tbody></table>'
        );
    }
}
