<?php

namespace Html\Modifier;

use Html\Element\Datagrid;
use Html\Element\Pagination;
use Html\Element\Table;
use Html\Modifier\ThemeTemplate\Bootstrap4;

class TemplateModifier
{
    public static function modify(string $fqcn, $item)
    {
        switch (true) {
            case $fqcn === Table::class;
                return Bootstrap4::table($item);
            case $fqcn === Datagrid::class;
                return Bootstrap4::datagrid($item);
            case $fqcn === Pagination::class;
                return Bootstrap4::pagination($item);
        }
    }
}