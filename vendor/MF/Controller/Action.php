<?php

namespace MF\Controller;

abstract class Action
{
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    protected function render($view, $layout = 'layout')
    {
        $this->view->page = $view;
        if (file_exists("../App/Views/" . $layout . ".phtml")) {
            require_once "../App/Views/" . $layout . ".phtml";
        } else {
            $this->content();
        }
    }

    protected function content()
    {
        $currentClass = get_class($this);
        $currentClass = str_replace('App\\Controllers\\', '', $currentClass);
        $currentClass = str_replace('Controller', '', $currentClass);
        $currentClass = strtolower($currentClass);

        require_once '../App/Views/' . $currentClass . '/' . $this->view->page . '.phtml';
    }
}
