<?php
include "../model/BD.class.php";

class LoginController
{

    private $model;
    private $table = "usuario";

    public function __construct()
    {
        $this->model = new BD();
    }

    public function salvar($dados)
    {
        try {

            if (!preg_match("/^[a-zA-Z-' ]*$/", $dados['nome'])) {
                throw new Exception(" Somente letras e espaços em branco são permitidos. ");
            }

            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception(" Formato de e-mail inválido. ");
            }

            if ($dados['senha'] === $dados['c_senha']) {

                $dados['senha'] = password_hash($dados['senha'], PASSWORD_BCRYPT);

                //var_dump($dados);
                //exit;
                $this->model->inserir($this->table, $dados);

                $_SESSION["msg"] =  "Registro realizado com sucesso!";
                $_SESSION["url"] = "login.php";
            } else {
                throw new Exception(" As senhas devem se coincidirem!");
            }
        } catch (Exception $e) {
            $_SESSION["dados"] = $dados;
            $_SESSION["msg"] = $e->getMessage();
            $_SESSION["url"] = "RegistrarUsuarioForm.php";
        }
    }
    public function logar($dados)
    {
        try {

            $usuario = $this->model->login($this->table, $dados);

            if ($usuario) {
                $_SESSION["nome"] = $usuario->nome;
                $_SESSION["url"] = "base/main.php";
            } else {
                throw new Exception("O login ou senha esta errado. Por favor, tente novamente. <br>");
            }
            $_SESSION["login"] = $dados['login'];
        } catch (Exception $e) {
            $_SESSION["msg"] =  $e->getMessage();
            $_SESSION["url"] = "login.php";
        }
    }
}
