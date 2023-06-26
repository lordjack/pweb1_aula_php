<?php

class BD
{
    private $host = "localhost";
    private $dbname = "db_aula";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "";
    private $db_charset = "utf8";


    public function conn()
    {
        $conn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";

        return new PDO(
            $conn,
            $this->usuario,
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->db_charset]
        );
    }

    public function inserir($nome_tabela, $dados)
    {
        unset($dados['id']); //remove elemento do vetor
        $conn = $this->conn();
        $sql = "INSERT INTO $nome_tabela (";
        $flag = 0;
        $arrayDados = [];
        //concatena os campos do SQL Inserir
        foreach ($dados as $campo => $valor) {
            $sql .= $flag == 0 ? " $campo " : ", $campo ";
            $flag = 1;
        }
        $sql .= ") VALUES (";
        $flag = 0;
        //concatena os valores do SQL Inserir
        foreach ($dados as $campo => $valor) {
            $sql .= $flag == 0 ? " ? " : ",? ";
            $flag = 1;
            $arrayDados[] = $valor;
        }
        $sql .= "); ";

        $st = $conn->prepare($sql);
        $st->execute($arrayDados);

    }

    public function atualizar($nome_tabela, $dados)
    {
        $id = $dados['id'];
        $conn = $this->conn();
        $sql = "UPDATE $nome_tabela SET ";
        $flag = 0;
        $arrayDados = [];
        foreach ($dados as $campo => $valor) {
            $sql .= $flag == 0 ? " $campo=? " : ", $campo=? ";

            $flag = 1;
            $arrayDados[] = $valor;
        }

        $sql .= " WHERE id = $id ";

        $st = $conn->prepare($sql);
        $st->execute($arrayDados);
    }

    public function select($nome_tabela)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela;";
        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function buscar($nome_tabela, $id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela WHERE id=?;";
        $st = $conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    public function deletar($nome_tabela, $id)
    {
        $conn = $this->conn();
        $sql = "DELETE FROM $nome_tabela WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function pesquisar($nome_tabela, $dados)
    {
        //var_dump($dados);
        //exit;
        $campo = $dados['campo'];
        $valor = $dados['valor'];

        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela WHERE $campo LIKE ?;";
        $st = $conn->prepare($sql);
        //pesquisa o campo com % para usar o like do SQL 
        $st->execute(["%" . $valor . "%"]);

        //retorna um vetor de objetos do tipo classe
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function login($nome_tabela, $dados)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela WHERE login=? ;";
        $st = $conn->prepare($sql);
        $st->execute([$dados['login']]);

        $result = $st->fetchObject();

        if (password_verify($dados['senha'], $result->senha)) {
            return $result;
        } else {
            return throw new Exception(" O login ou senha esta errado. Por favor tente novamente.");
        }
    }
}