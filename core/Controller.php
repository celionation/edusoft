<?php

namespace core;

class Controller
{
    public string $layout = 'default';
    public string $action = '';

    public function __construct()
    {
        $this->onConstruct();
    }

    /**
     * onConstruct Function
     *
     *This function is used to add additional method to the constructor
     *
     * @return void
     */
    public function onConstruct()
    {
    }

    /**
     * Get the value of layout
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * Set the value of layout
     *
     * @param $layout
     * @return  self
     */
    public function setLayout($layout): Controller
    {
        $this->layout = $layout;

        return $this;
    }
}