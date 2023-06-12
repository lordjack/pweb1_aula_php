<?php
include "../Util.php";

session_start();
verificarLogin();

//var_dump($_SESSION);
//exit;
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
    Olá <?php echo $_SESSION['nome'] ?>, seja bem vindo! <a href="login.php?sair=1"> Sair </a>

    <br>
    <a href="ContatoList.php"> Contato </a>
</body>

</html>