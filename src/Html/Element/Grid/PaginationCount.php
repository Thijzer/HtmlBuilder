<?php


namespace Html\Element\Grid;


use Html\Element\BuildTrait;
use Html\Functions\PaginationInterface;
use Html\Html;

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
