<?php

namespace HtmlBuilder\Modifier\ThemeTemplate;

use HtmlBuilder\Html;

class Tabler
{
    public static function datagrid(Html $datagrid)
    {
        $datagrid->id('datagrid');
        $datagrid->children()[0]->class('table-responsive');

        return $datagrid;
    }

    public static function pagination(Html $pagination)
    {
        $pagination->children()[0]->class('pagination dataTables_paginate justify-content-end');
        return $pagination;
    }

    public static function table(Html $table)
    {
        $table->children()[0]->class('thead-default');
        $table->class('table card-table table-vcenter text-nowrap datatable dataTable no-footer');

        return $table;
    }
}
