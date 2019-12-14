<?php

namespace HtmlBuilder\Element;

trait BuildTrait
{
    public function __toString()
    {
        return $this->render();
    }

    public function render()
    {
        return (string) $this->build();
    }
}