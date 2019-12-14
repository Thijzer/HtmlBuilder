<?php

namespace HtmlBuilder\Element;

use App\Domain\CommonDomain\Arrayable;
use HtmlBuilder\Html;

class Icon
{
    public static function createFromModifier(Arrayable $modifier)
    {
        $modifier = $modifier->toArray();

        return Html::elem('a')->href($modifier['url'])->_add(
            Html::elem('i')->class('fe fe-'.$modifier['label'])
        );
    }
}

/*

<a class="icon" href="javascript:void(0)">
    <i class="fe fe-edit"></i>
</a>

 */