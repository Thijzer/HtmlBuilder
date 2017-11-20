<?php

namespace Tests\Html\Element;

use Html\Element\Navigation;
use Html\Functions\PaginationInterface;
use Html\Modifier\MatcherInterface;

/** @covers Navigation */
class NavigationTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_make_a_basic_navigation()
    {
        /** @var PaginationInterface $pagination */
        $modifier = $this->prophesize(MatcherInterface::class);
        $modifier->getMatches()->willReturn([]);

        $navigation = new Navigation('test');
        $navigation->setModifierMatcher($modifier->reveal());

        $navigation->build();
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
