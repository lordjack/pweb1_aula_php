<?php
include_once "Util.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
session_start();
$login = !empty($_SESSION['nome']) ? $_SESSION['login'] : "";
//$url_projeto = "http://" . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['SCRIPT_NAME'])) . DIRECTORY_SEPARATOR; //pega o host com o diretorio do projeto
$url_projeto = "http://" . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR; //pega o host do projeto
?>
    Olá <b> <?php echo $login  ?> </b>, seja bem vindo!<a href="<?php echo $url_projeto ?>view/login.php?sair=0"> Sair </a><br>

Menu: <a href="<?php echo $url_projeto ?>view/base/main.php"> Início </a><br>