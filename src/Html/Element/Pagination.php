<?php

namespace Html\Element;

use Html\Functions\PaginationInterface;
use Html\Html;

class Pagination
{
    use CollectionTrait;
    use BuildTrait;

    const PAGE = '?page=';

    private $paging;
    private $pageCount;

    public function __construct(PaginationInterface $paging, int $pageCount = 5)
    {
        $this->paging = $paging;
        $this->pageCount = $pageCount;
    }

    private function allowComplexPagination() : bool
    {
        return $this->paging->getNbPages() > $this->pageCount;
    }

    public function build()
    {
        $nav = Html::elem('nav');
        $anchor = Html::elem('a')->class('page-link');
        $span = Html::elem('span');

        $list = new UnOrderedList();

        if ($this->allowComplexPagination() && $this->paging->getCurrentPage() > 2) {
            $buttonFirst = clone $anchor;
            $spanA = clone $span;
            $buttonFirst
                ->href(static::PAGE.'1')
                ->aria__label('First')
                ->_add($spanA->_add('&laquo;&laquo;'))
            ;
            $list->addItem($buttonFirst);
        }
        if ($this->paging->getCurrentPage() > 1) {
            $buttonPrevious = clone $anchor;
            $spanB = clone $span;
            $buttonPrevious
                ->href(static::PAGE.$this->paging->getPreviousPage())
                ->aria__label('Previous')
                ->_add($spanB->_add('&laquo;'))
            ;
            $list->addItem($buttonPrevious);
        }

        $current = $this->paging->getCurrentPage();
        $max = $this->paging->getNbPages();
        $pageCount = $max < $this->pageCount ? $max : $this->pageCount;
        $balance = (int) round(($pageCount -1) / 2);
        $lowest = $current - $balance;
        $highest = $current + $balance;

        while ($highest < $pageCount) {
            $lowest++;
            $highest++;
        }
        while ($lowest > $max - $pageCount + 1) {
            $lowest--;
            $highest--;
        }
        while ($lowest <= $highest) {
            $i = $lowest;
            $anchorClone = clone $anchor;
            $isActive = $i === $current;
            $list->addItem($anchorClone->href($isActive ?'#':static::PAGE.$i)->_add($i), $isActive ? function (Html $li) {
                return $li->class('page-item active');
            }: null);
            $lowest++;
        }

        if ($this->paging->getNbPages() > $current) {
            $buttonNext = clone $anchor;
            $spanC = clone $span;
            $buttonNext
                ->href(static::PAGE.$current)
                ->aria__label('Next')
                ->_add($spanC->_add('&raquo;'))
            ;
            $list->addItem($buttonNext);
        }
        if ($this->allowComplexPagination() && $this->paging->getNbPages()-1 > $current) {
            $buttonLast = clone $anchor;
            $spanD = clone $span;
            $buttonLast
                ->href(static::PAGE.$max)
                ->aria__label('Last')
                ->_add($spanD->_add('&raquo;&raquo;'))
            ;
            $list->addItem($buttonLast);
        }

        $li = Html::elem('li')->class('page-item');

        return $nav->_add($list->build(null, $li)->class('pagination'));
    }
}
