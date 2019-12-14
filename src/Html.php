<?php

namespace HtmlBuilder;

/**
 * @method Html href(mixed $attribute)
 * @method Html class(mixed $attribute)
 * @method Html id(mixed $attribute)
 * @method Html aria__label(mixed $attribute)
 * @method Html type(mixed $attribute)
 * @method Html for(mixed $attribute)
 * @method Html value(mixed $attribute)
 */
class Html
{
    private $tag;
    private $build;
    private $children = [];
    private $args = [];

    public function __construct($build, $tag = null)
    {
        $this->build = $build;
        $this->tag = $tag;
    }

    public static function elem(string $elem): self
    {
        return new Html('<'.$elem.' *></'.$elem.'>', $elem);
    }

    public static function solidus(string $elem): self
    {
        return new Html('<'.$elem.' */>', $elem);
    }

    public function _attr(string $method, $args): self
    {
        $this->args[$method] = $args;

        return $this;
    }

    public function __call(string $method, $args): self
    {
        return $this->_attr($method, $args);
    }

    /**@return Html */
    public function _add(...$elems): self
    {
        foreach ($elems as $elem) {
            $this->children[] = $elem;
        }

        return $this;
    }

    public function children(): array
    {
        return $this->children;
    }

    private function render(): string
    {
        try {
            $elem = $this->build;

            // arg builder of current
            foreach (array_filter($this->args) as $name => $arg) {
                $arg = implode(' ', $arg);
                $elem = str_replace('*', "$name=\"$arg\" *", $elem);
            }

            return str_replace([' *>', ' */>'], '>'. implode('', $this->children), $elem);
        } catch (\Exception $e) {

            dump([
                $this->tag,
                current($this->args),
                current($this->children),
                $elem
            ]);

            throw $e;
        }
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
