<?php

namespace Html\Functions;

interface ModifierInterface
{
    public function modify(string $name, array $options = []) : string;
    public function getTargetName(): string;
    public function getDestinationName() : string;
}
