<?php

namespace Html\Element;

use Html\Html;

class Breadcrumb
{
    use BuildTrait;

    private $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function build(): Html
    {
        $nav = Html::elem('nav')->aria__label("breadcrumb");

        $orderedList = new OrderedList();

        $anchor = Html::elem('a');

        foreach ($this->elements as $element) {
            $anchorClone = clone $anchor;
            if ($element == end($this->elements)) {
                $orderedList->addItem($element['label'], function (Html $list) {
                    return $list->class('breadcrumb-item');
                });
                break;
            }
            $orderedList->addItem($anchorClone->href($element['route'])->_add($element['label']), function (Html $list) {
                return $list->class('breadcrumb-item');
            });
        }

        return $nav->_add($orderedList->build()->class('breadcrumb'));
    }
}

/**
 *
 * <nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol>
</nav>
 *
 *
 */