<?php

namespace HtmlBuilder\Modifier;

use HtmlBuilder\Functions\ModifierInterface;

class ModifierMatcher implements MatcherInterface
{
    private $modifiers = [];

    public function addMatch(ModifierInterface $modifier)
    {
        $this->modifiers[$modifier->getTargetName()] = $modifier;
    }

    /**
     * @param string $name
     * @return bool|ModifierInterface
     */
    public function getMatch(string $name)
    {
        return $this->modifiers[$name] ?? false;
    }

    public function hasMatch(string $name): bool
    {
        return isset($this->modifiers[$name]);
    }

    public function getMatches(array $suspects): array
    {
        $result = [];
        foreach ($suspects as $suspect) {
            if ($this->hasMatch($suspect)) {
                $match = $this->getMatch($suspect);
                $result[$match->getDestinationName()] = $match->modify($suspect);
            }
        }

        return $result;
    }
}