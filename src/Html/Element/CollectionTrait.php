<?php

namespace Html\Element;

trait CollectionTrait
{
    private $items = [];
    private $functions = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $item) {
            $this->addItem($item);
        }
    }

    public function addItem($item, callable $callable = null)
    {
        $this->items[] = $item;

        if ($callable) {
            $this->functions[count($this->items)-1] = $callable;
        }
    }
}