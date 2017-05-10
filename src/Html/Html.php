<?php

namespace Html;

/**
 * @method Html href(mixed $attribute)
 * @method Html class(mixed $attribute)
 */
class Html
{
    private $build;
    private $children = [];
    private $args = [];

    public function __construct($build)
    {
        $this->build = $build;
    }

    public static function elem(string $elem)
    {
        return new Html('<'.$elem.' *></'.$elem.'>');
    }

    public static function solidus(string $elem)
    {
        return new Html('<'.$elem.' * />');
    }

    public function __call(string $method, $args)
    {
        if ($method === 'type' && count($args) > 1) {
            return $this;
        }
        $this->args[str_replace('__', '-', $method)] = $args;

        return $this;
    }

    public function _add($elem)
    {
        $this->children[] = $elem;

        return $this;
    }

    private function render() : string
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
