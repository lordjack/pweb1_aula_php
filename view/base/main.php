<?php
include "header.php";
include "menu.php";
include "../../Util.php";

session_start();
verificarLogin();

//var_dump($_SESSION);
//exit;
?>
Olá <?php echo $_SESSION['nome'] ?>, seja bem vindo! <a href="../login.php?sair=1"> Sair </a>

<br>
<a href="../ContatoList.php"> Contato </a>
<?php include "rodape.php"; ?>