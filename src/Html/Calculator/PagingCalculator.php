<?php

namespace Html\Calculator;

use Html\Functions\PaginationInterface;

class PagingCalculator
{
    public static function calculate(PaginationInterface $paging, $userPageLimit): array
    {
        $current = $paging->getCurrentPage();
        $max = $paging->getNbPages();
        $userPageLimit = $max < $userPageLimit ? $max : $userPageLimit;

        // set primary values
        $balance = (int) round(($userPageLimit -1) / 2);
        $lowest = ($current - $balance) > 0 ? $current - $balance : 1;
        $highest = ($current + $balance) > $max ? $max : $current + $balance;

        // increase highest page when it's at the start
        while ($highest < $userPageLimit) {
            $highest++;
        }

        // reduce lowest page when it hasn't reached the end
        while ($lowest > $highest - $userPageLimit +1) {
            $lowest--;
        }

        $pagingItems = [];
        $loop = $lowest;
        while ($loop <= $highest) {
            $isActive = $loop === $current;
            $pagingItems[] = [
                'index' => $loop,
                'isActive' => $isActive,
            ];
            $loop++;
        }

        $pager =  [
            'current' => $current,
            'lowest' => $lowest,
            'higest' => $highest,
            'balance' => $balance,
            'max' => $max,
            'userPageLimit' => $userPageLimit,
            'items' => $pagingItems,
        ];

        return $pager;
    }
}