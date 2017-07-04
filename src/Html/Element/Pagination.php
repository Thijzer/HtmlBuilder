<?php

namespace Html\Element;

use Html\Functions\PaginationInterface;
use Html\Html;

class Pagination
{
    use CollectionTrait;
    use BuildTrait;

    private $paging;
    private $pageCount;

    public function __construct(PaginationInterface $paging, int $pageCount = 5)
    {
        $this->paging = $paging;
        $this->pageCount = $pageCount;
    }

    private function allowComplexPagination() : bool
    {
        return $this->pageCount > $this->paging->getNbPages();
    }

    public function build()
    {
        $nav = Html::elem('nav');
        $anchor = Html::elem('a');
        $span = Html::elem('span');
        $page = '?page=';

        $list = new UnsortedList();

        if ($this->allowComplexPagination() && $this->paging->getCurrentPage() > 2) {
            $buttonFirst = clone $anchor;
            $spanA = clone $span;
            $buttonFirst->href($page.'1')->aria__label('First')->_add($spanA->_add('&laquo;&laquo;'));
            $list->addItem($buttonFirst);
        }
        if ($this->paging->getCurrentPage() > 1) {
            $buttonPrevious = clone $anchor;
            $spanB = clone $span;
            $buttonPrevious->href($page.$this->paging->getPreviousPage())->aria__label('Previous')->_add($spanB->_add('&laquo;'));
            $list->addItem($buttonPrevious);
        }

        $current = (int) $this->paging->getCurrentPage();
        $max = (int) $this->paging->getNbPages();
        $pCount = (int) $max < $this->pageCount ? $max : $this->pageCount;
        $balance = (int) round(($pCount -1) / 2);
        $lowest = (int) $current - $balance;
        $highest = (int) $current + $balance;

        while ($highest < $pCount) {
            $lowest++;
            $highest++;
        }
        while ($lowest > $max - $pCount + 1) {
            $lowest--;
            $highest--;
        }
        while ($lowest <= $highest) {
            $i = $lowest;
            $anchorClone = clone $anchor;
            $isActive = $i === $current;
            $list->addItem($anchorClone->href($isActive ?'#':$page.$i)->_add($i), $isActive ? function (Html $li) {
                return $li->class('active');
            }: null);
            $lowest++;
        }

        if ($this->paging->getNbPages() > $current) {
            $buttonNext = clone $anchor;
            $spanC = clone $span;
            $buttonNext->href($page.$current)->aria__label('Next')->_add($spanC->_add('&raquo;'));
            $list->addItem($buttonNext);
        }
        if ($this->allowComplexPagination() && $this->paging->getNbPages()-1 > $current) {
            $buttonLast = clone $anchor;
            $spanD = clone $span;
            $buttonLast->href($page.$max)->aria__label('Last')->_add($spanD->_add('&raquo;&raquo;'));
            $list->addItem($buttonLast);
        }

        return $nav->_add($list->build()->class('pagination'));
    }
}
