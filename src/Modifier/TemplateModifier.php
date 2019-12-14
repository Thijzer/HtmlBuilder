<?php

namespace HtmlBuilder\Modifier;

use HtmlBuilder\Element\Datagrid;
use HtmlBuilder\Element\Pagination;
use HtmlBuilder\Element\Table;
use HtmlBuilder\Modifier\ThemeTemplate\Tabler;

class TemplateModifier
{
    public static function modify(string $fqcn, $item)
    {
        switch (true) {
            case $fqcn === Table::class;
                return Tabler::table($item);
            case $fqcn === Datagrid::class;
                return Tabler::datagrid($item);
            case $fqcn === Pagination::class;
                return Tabler::pagination($item);
        }
    }
}