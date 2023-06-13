<?php
include "../model/BD.class.php";

class ContatoController
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

            $this->model->inserir($this->table, $dados);

            $_SESSION["url"] = 'ContatoList.php';
            $_SESSION["msg"] = "Registro salvo com sucesso!";
        } catch (Exception $e) {
            $_SESSION["dados"] = $dados;
            $_SESSION["url"] = 'ContatoForm.php';
            $_SESSION["msg"] = $e->getMessage();
        }
    }

    public function atualizar($dados)
    {
        try {

            if (!preg_match("/^[a-zA-Z-' ]*$/", $dados['nome'])) {
                throw new Exception(" Somente letras e espaços em branco são permitidos no nome. ");
            }

            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception(" Formato de e-mail inválido. ");
            }

            $this->model->atualizar($this->table, $dados);

            $_SESSION["url"] = 'ContatoList.php';
            $_SESSION["msg"] = "Registro atualizado com sucesso!";
        } catch (Exception $e) {
            $_SESSION["url"] = 'ContatoForm.php?id=' . $dados['id'];
            $_SESSION["msg"] = $e->getMessage();
        }
    }

    public function carregar()
    {

        return $this->model->select($this->table);
    }

    public function pesquisar($dados)
    {
        return $this->model->pesquisar($this->table, $dados);
    }
    public function deletar($id)
    {

        return $this->model->deletar($this->table, $id);
    }

    public function buscar($id)
    {
        return $this->model->buscar($this->table, $id);
    }
}
