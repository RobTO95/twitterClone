<?php


namespace App\Models;

use MF\Model\Model;

class Usuario extends Model
{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    // salvar usuario
    public function salvar()
    {
        $query = "insert into usuarios(nome, email, senha)values(:nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha')); //md5 -> hash 32 caracteres
        $stmt->execute();
        return $this;
    }
    // validar se um cadastro pode ser feito
    public function validarCadastro()
    {
        $valido = true;
        $nome = $this->__get('nome');
        $email = $this->__get('email');
        $senha = $this->__get('senha');

        if (strlen($nome) < 3) {
            $valido = false;
        }
        if (strlen($email) < 3) {
            $valido = false;
        }
        if (strlen($senha) < 3) {
            $valido = false;
        }


        return $valido;
    }

    // Recuperar um usuário por email
    public function getUsuariaPorEmail()
    {
        $query = 'select nome, email from usuarios where email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
