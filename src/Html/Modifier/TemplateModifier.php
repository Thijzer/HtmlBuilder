<?php

namespace Html\Modifier;

use Html\Element\Datagrid;
use Html\Element\Pagination;
use Html\Element\Table;
use Html\Modifier\ThemeTemplate\Tabler;

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