<?php


namespace HtmlBuilder\Element\Grid;


use HtmlBuilder\Element\BuildTrait;
use HtmlBuilder\Functions\PaginationInterface;
use HtmlBuilder\Html;

class PaginationCount
{
    use BuildTrait;
    private $pagination;

    public function __construct(PaginationInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    public function build(): Html
    {
        $page = $this->pagination;
        $label = 'Showing %s to %s of %s entries';

        $label = sprintf($label, $page->getCurrentPage(), $page->getNbPages(), $page->getNbResults());

        return Html::elem('div')->class('dataTables_info')->id('DataTables_Table_0_info')->role('status')->_attr('aria-live', ['polite'])->_add($label);
    }
}
