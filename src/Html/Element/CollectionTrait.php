<?php

namespace Html\Element;

trait CollectionTrait
{
    private $items = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $item) {
            $this->addItem($item);
        }
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }
}