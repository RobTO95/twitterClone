<?php

namespace App\Controllers;

// Framework

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index()
    {
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
        $this->render('index', 'layout');
    }
    public function inscreverse()
    {
        $this->view->usuario = [
            'nome' => '',
            'email' => '',
            'senha' => '',
        ];
        $this->view->erroCadastro = false;
        $this->render('inscreverse', 'layout');
    }

    public function registrar()
    {
        // receber os dados do formulário
        $dados = $_POST;

        // Instanciando usuario
        $usuario = Container::getModel('Usuario');
        $usuario->__set('nome', $dados['nome']);
        $usuario->__set('email', $dados['email']);
        $usuario->__set('senha', md5($dados['senha']));

        // Validação de cadastro
        if ($usuario->validarCadastro() && count($usuario->getUsuariaPorEmail()) == 0) {
            // Salvar dados no banco
            $usuario->salvar();
            $this->render('cadastro', 'layout');
        } else {
            // Erro
            $this->view->usuario = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
            ];

            $this->view->erroCadastro = true;
            $this->render('inscreverse', 'layout');
        }
    }
};
