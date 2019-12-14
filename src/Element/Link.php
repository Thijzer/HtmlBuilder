<?php

namespace HtmlBuilder\Element;

use App\Domain\CommonDomain\Arrayable;
use HtmlBuilder\Html;

class Link
{
    public static function createFromModifier(Arrayable $modifier)
    {
        $modifier = $modifier->toArray();

        return Html::elem('a')->href($modifier['url'])->_add($modifier['label']);
    }
}

/*

<a class="icon" href="javascript:void(0)">
    <i class="fe fe-edit"></i>
</a>

 */