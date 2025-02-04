<?php

namespace App\Controllers;

// Framework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index()
    {
        $this->render('index', 'layout');
    }
    public function inscreverse()
    {
        $this->render('inscreverse', 'layout');
    }
};
