<?php

namespace Html\Modifier;

interface MatcherInterface
{
    public function getMatches(array $suspects): array;
}