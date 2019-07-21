<?php

namespace Html\Element;

use Html\Html;
use Html\Functions\PaginationInterface;
use Html\Modifier\TemplateModifier;

class Datagrid
{
    use BuildTrait;

    private $paging;
    private $table;

    public function __construct(PaginationInterface $paging)
    {
        $this->paging = $paging;
        $this->table = new Table();
    }

    public function getTable()
    {
        return $this->table;
    }

    public function createLink(string $url, string $name)
    {
        return Html::elem('a')->href($url)->_add($name);
    }

    public function createButton(string $url, string $name, string $label = null)
    {
        $span = Html::elem('span');
        return $this->createButton($url, $name)->_add($span->class('badge '.$label));
    }

    public function build()
    {
        $this->table->setData($this->paging->getCurrentPageResults());

        $datagrid = Html::elem('div')
            ->_add($this->table)
            ->_add($this->getPagination())
        ;

        return TemplateModifier::modify(Datagrid::class, $datagrid);
    }

    private function getPagination()
    {
        if ($this->paging->haveToPaginate()) {
            return new Pagination($this->paging);
        }
    }
}
