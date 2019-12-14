<?php

namespace HtmlBuilder\Element;

use HtmlBuilder\Calculator\PagingCalculator;
use HtmlBuilder\Functions\PaginationInterface;
use HtmlBuilder\Html;
use HtmlBuilder\Modifier\TemplateModifier;

class Pagination
{
    use CollectionTrait;
    use BuildTrait;

    const PAGE = '?page=';

    private $labels = [
        'links' => [
            'first' => '&laquo;&laquo;',
            'previous' => '&laquo;',
            'next' => '&raquo;',
            'last' => '&raquo;&raquo;',
        ]
    ];

    private $paging;
    private $pageCount;

    public function __construct(PaginationInterface $paging, int $pageCount = 5, array $labels = [])
    {
        $this->paging = $paging;
        $this->pageCount = $pageCount;
        $this->labels = array_merge($this->labels, $labels);
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
                ->_add($spanA->_add($this->labels['links']['first']))
            ;
            $list->addItem($buttonFirst);
        }
        if ($this->paging->getCurrentPage() > 1) {
            $buttonPrevious = clone $anchor;
            $spanB = clone $span;
            $buttonPrevious
                ->href(static::PAGE.$this->paging->getPreviousPage())
                ->aria__label('Previous')
                ->_add($spanB->_add($this->labels['links']['previous']))
            ;
            $list->addItem($buttonPrevious);
        }

        $pager = PagingCalculator::calculate($this->paging, $this->pageCount);
        $current = $pager['current'];

        foreach ($pager['items'] as $item) {
            $i = $item['index'];
            $isActive = $item['isActive'];
            $anchorClone = clone $anchor;
            $list->addItem($anchorClone->href($isActive ?'#':static::PAGE.$i)->_add($i), $isActive ? function (Html $li) {
                return $li->class('page-item active');
            }: null);
        }

        if ($this->paging->getNbPages() > $current) {
            $buttonNext = clone $anchor;
            $spanC = clone $span;
            $buttonNext
                ->href(static::PAGE.(1+$current))
                ->aria__label('Next')
                ->_add($spanC->_add($this->labels['links']['next']))
            ;
            $list->addItem($buttonNext);
        }
        if ($this->allowComplexPagination() && $this->paging->getNbPages()-1 > $current) {
            $buttonLast = clone $anchor;
            $spanD = clone $span;
            $buttonLast
                ->href(static::PAGE.$pager['max'])
                ->aria__label('Last')
                ->_add($spanD->_add($this->labels['links']['last']))
            ;
            $list->addItem($buttonLast);
        }

        $li = Html::elem('li')->class('page-item');

        $nav->_add($list->build(null, $li));

        return TemplateModifier::modify(Pagination::class, $nav);
    }
}
