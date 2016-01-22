<?php

namespace Html;

class Html
{
    /**
     * standard html rule set
     * @var array
     */
    protected $standard = array('input' => "<input *>", 'elem'  => "<%elem% *></%elem%>");

    /**
     * Default arrays
     * @var array
     */
    protected $elem = array();

    /**
     * start element holder
     * @var array
     */
    protected $start = array();

    /**
     * collector of args
     * @var array
     */
    protected $args = array();

    /**
     * singleton element
     *
     * @param  string $elem
     *
     * @return self html
     */
    public static function elem($elem)
    {
        if (is_string($elem)) {
            $instance = new Html();
            $instance->start = ($elem == 'input') ?
                $instance->standard['input'] :
                str_replace('%elem%', $elem, $instance->standard['elem']);
            return $instance;
        }
    }

    /**
     * magic method that will render arguments
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     *
     * @return self html
     */
    public function __call($method, $args)
    {
        if ($method == 'type' && count($args) > 1) {
            return $this;
        }
        $method = str_replace('__', '-', $method);
        $this->args[$method] = $args;
        return $this;
    }

    /**
     * builds or renders the collected arguments
     *
     * @param  string $val
     * @return string result
     */
    public function end($val = '')
    {
        $this->elem = $this->start;
        foreach ($this->args as $name => $arg) {
            $arg = implode(' ', $arg);
            $this->elem = str_replace('*', "$name=\"$arg\" *", $this->elem);
        }
        return str_replace(' *>', '>' . $val, $this->elem);
    }

    /**
     * options description]
     *
     * @param  [type] $name [description]
     *
     * @return [type]       [description]
     */
    public function options($name)
    {
        if (is_array($name)) {
            $name = implode(' ', $name);
        }
        $this->elem = str_replace('*', "$name *", $this->elem);
        return $this;
    }
}
