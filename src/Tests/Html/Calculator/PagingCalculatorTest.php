<?php

namespace Tests\Html\Element;

use Html\Calculator\PagingCalculator;
use Html\Functions\PaginationInterface;

class PagingCalculatorTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_calculate_with_low_results_first_page()
    {
        $pager = $this->calculate(1, 2, 5);

        $expected = [
            'current'=> 1,
            'lowest'=> 1,
            'higest'=> 2,
            'balance'=> 1,
            'max'=> 2,
            'userPageLimit'=> 2,
            'items'=> [
                [
                    'index'=> 1,
                    'isActive'=> true,
                ],
                [
                    'index'=> 2,
                    'isActive'=> false
                ],
            ],
        ];

        $this->assertSame($expected, $pager);
    }

    /** @test */
    public function it_should_calculate_with_low_results_last_page()
    {
        $pager = $this->calculate(2, 2, 5);

        $expected = [
            'current'=> 2,
            'lowest'=> 1,
            'higest'=> 2,
            'balance'=> 1,
            'max'=> 2,
            'userPageLimit'=> 2,
            'items'=> [
                [
                    'index'=> 1,
                    'isActive'=> false,
                ],
                [
                    'index'=> 2,
                    'isActive'=> true
                ],
            ],
        ];

        $this->assertSame($expected, $pager);
    }

    /** @test */
    public function it_should_calculate_with_high_results_first_page()
    {
        $pager = $this->calculate(1, 20, 5);

        $expected = [
            'current'=> 1,
            'lowest'=> 1,
            'higest'=> 5,
            'balance'=> 2,
            'max'=> 20,
            'userPageLimit'=> 5,
            'items'=> [
                [
                    'index'=> 1,
                    'isActive'=> true,
                ],
                [
                    'index'=> 2,
                    'isActive'=> false
                ],
                [
                    'index'=> 3,
                    'isActive'=> false
                ],
                [
                    'index'=> 4,
                    'isActive'=> false
                ],
                [
                    'index'=> 5,
                    'isActive'=> false
                ],
            ],
        ];

        $this->assertSame($expected, $pager);
    }

    /** @test */
    public function it_should_calculate_with_high_results_middle_page()
    {
        $pager = $this->calculate(10, 20, 5);

        $expected = [
            'current'=> 10,
            'lowest'=> 8,
            'higest'=> 12,
            'balance'=> 2,
            'max'=> 20,
            'userPageLimit'=> 5,
            'items'=> [
                [
                    'index'=> 8,
                    'isActive'=> false,
                ],
                [
                    'index'=> 9,
                    'isActive'=> false
                ],
                [
                    'index'=> 10,
                    'isActive'=> true
                ],
                [
                    'index'=> 11,
                    'isActive'=> false
                ],
                [
                    'index'=> 12,
                    'isActive'=> false
                ],
            ],
        ];

        $this->assertSame($expected, $pager);
    }

    /** @test */
    public function it_should_calculate_with_high_results_highest_page()
    {
        $pager = $this->calculate(20, 20, 5);

        $expected = [
            'current'=> 20,
            'lowest'=> 16,
            'higest'=> 20,
            'balance'=> 2,
            'max'=> 20,
            'userPageLimit'=> 5,
            'items'=> [
                [
                    'index'=> 16,
                    'isActive'=> false,
                ],
                [
                    'index'=> 17,
                    'isActive'=> false
                ],
                [
                    'index'=> 18,
                    'isActive'=> false
                ],
                [
                    'index'=> 19,
                    'isActive'=> false
                ],
                [
                    'index'=> 20,
                    'isActive'=> true
                ],
            ],
        ];

        $this->assertSame($expected, $pager);
    }

    private function calculate(int $current, int $max, int $pageCount)
    {
        $pagingApdater = $this->prophesize(PaginationInterface::class);

        $pagingApdater->getCurrentPage()->willReturn($current)->shouldBeCalled();
        $pagingApdater->getNbPages()->willReturn($max)->shouldBeCalled();

        return PagingCalculator::calculate($pagingApdater->reveal(), $pageCount);
    }
}
