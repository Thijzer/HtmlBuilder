<?php

namespace HtmlBuilder\Modifier;


use HtmlBuilder\Functions\ModifierInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RouteModifier implements ModifierInterface
{
    private $generator;
    private $targetName;

    private $destinationName;

    public function __construct(UrlGeneratorInterface $generator, string $targetName, string $destinationName)
    {

        $this->generator = $generator;
        $this->targetName = $targetName;
        $this->destinationName = $destinationName;
    }

    public function modify(string $route, array $options = []) :string
    {
        return $this->generator->generate($route);
    }

    public function getTargetName(): string
    {
        return $this->targetName;
    }

    public function getDestinationName() : string
    {
        return $this->destinationName;
    }
}