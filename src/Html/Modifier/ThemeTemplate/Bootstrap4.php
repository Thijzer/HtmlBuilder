<?php

namespace Html\Modifier\ThemeTemplate;

use Html\Html;

class Bootstrap4
{
    public static function datagrid(Html $datagrid)
    {
        $datagrid->id('datagrid');

        return $datagrid;
    }

    public static function pagination(Html $pagination)
    {
        $pagination->children()[0]->class('pagination');

        return $pagination;
    }

    public static function table(Html $table)
    {
        $table->children()[0]->class('thead-default');
        $table->class('table table-striped table-sm');

        return $table;
    }
}
