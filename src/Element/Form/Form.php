<?php

namespace HtmlBuilder\Element\Form;

use HtmlBuilder\Html;

class Form
{
    use BuildTrait;

    const GET = 'get';
    const POST = 'post';

    private $method;
    private $formElements = [];

    public function __construct(string $method)
    {
        $this->method = $method;
    }

    public function addFormElement(FormElement $formElement) {
        $this->formElements[] = $formElement;
    }

    public function addFormElements(array $formElements)
    {
        foreach ($formElements as $formElement) {
            $this->addFormElement($formElement);
        }
    }

    public function build()
    {
        $form = Html::elem('form');

        foreach ($this->formElements as $formElement) {
            $form->_add($formElement);
        }

        return $form->method($this->method)->data__action__form(true);
    }
}