<?php

namespace App\Controllers;

// Framework
use MF\Controller\Action;
use MF\Model\Container;

// Models
use App\Models\Produto;
use App\Models\Info;


class IndexController extends Action
{
    public function index()
    {

        // Instaciar o modelo
        $produto = Container::getModel('Produto');

        $produtos = $produto->getProdutos();
        $this->view->dados = $produtos;

        $this->render('index', 'layout1');
    }
    public function sobreNos()
    {
        // Instaciar o modelo
        $info = Container::getModel('Info');

        $infos = $info->getInfo();
        $this->view->dados = $infos;


        $this->render('sobreNos', 'layout1');
    }
};
