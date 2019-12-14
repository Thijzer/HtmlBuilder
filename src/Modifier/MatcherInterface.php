<?php

namespace HtmlBuilder\Modifier;

interface MatcherInterface
{
    public function getMatches(array $suspects): array;
}