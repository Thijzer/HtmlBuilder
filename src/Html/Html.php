<?php

namespace Html;

/**
 * @method Html href(mixed $attribute)
 * @method Html class(mixed $attribute)
 * @method Html id(mixed $attribute)
 * @method Html aria__label(mixed $attribute)
 * @method Html type(mixed $attribute)
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

    public static function elem(string $elem)
    {
        return new Html('<'.$elem.' *></'.$elem.'>', $elem);
    }

    public static function solidus(string $elem)
    {
        return new Html('<'.$elem.' * />', $elem);
    }

    /**@return Html */
    public function _attr(string $method, $args)
    {
        if ($method === 'type' && count($args) > 1) {
            return $this;
        }
        $this->args[$method] = $args;

        return $this;
    }

    /**@return Html */
    public function __call(string $method, $args)
    {
        return $this->_attr($method, $args);
    }

    /**@return Html */
    public function _add(...$elems)
    {
        foreach ($elems as  $elem) {
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
        $elem = $this->build;

        // arg builder of current
        foreach ($this->args as $name => $arg) {
            $arg = implode(' ', $arg);
            $elem = str_replace('*', "$name=\"$arg\" *", $elem);
        }

        return str_replace(' *>', '>'. implode('',$this->children), $elem);
    }

    public function __toString()
    {
        return $this->render();
    }

//    public function options($name)
//    {
//        if (is_array($name)) {
//            $name = implode(' ', $name);
//        }
//        $this->elem = str_replace('*', "$name *", $this->elem);
//
//        return $this;
//    }
}
