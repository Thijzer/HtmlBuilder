<?php

namespace HtmlBuilder\Element;

use HtmlBuilder\Element\Form\SearchBox;
use HtmlBuilder\Element\Grid\PaginationCount;
use HtmlBuilder\Element\Grid\PaginatonLimit;
use HtmlBuilder\Html;
use HtmlBuilder\Functions\PaginationInterface;
use HtmlBuilder\Modifier\TemplateModifier;

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

    /**
     * <a class="icon" href="javascript:void(0)">
    <i class="fe fe-edit"></i>
    </a>
     */
    public function createIcon(string $url, string $name, string $label = null)
    {
        $span = Html::elem('i')->class('fe fe-'.$label);

        return $this->createLink($url, '')->_add($span)->class('icon');
    }

    public function createButton(string $url, string $name, string $label = null)
    {
        $span = Html::elem('span')->class('badge '.$label);

        return $this->createLink($url, $name)->_add($span)->class('btn btn-secondary btn-sm');
    }

    public function build()
    {
        $this->table->setData($this->paging->getCurrentPageResults());

        $options = [
            [
                'value' => '10',
                'label' => '10',
            ],
            [
                'value' => '25',
                'label' => '25',
            ],
            [
                'value' => '50',
                'label' => '50',
            ],
        ];

        $tableDiv = Html::elem('div');

        $datagrid = Html::elem('div')
          //  ->_add(SearchBox::label('Search: '))
            ->_add($tableDiv->_add($this->table))
        ;

        if ($this->paging->canPaginate()) {
            $datagrid
                ->_add(new PaginationCount($this->paging))
                //->_add(new PaginatonLimit($options))
                ->_add(new Pagination($this->paging))
            ;
        }

        return TemplateModifier::modify(Datagrid::class, $datagrid);
    }
}
