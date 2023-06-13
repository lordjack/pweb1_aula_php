<?php
include "../controller/LoginController.php";
include "./base/header.php";

session_start();
$login = new LoginController();

if (!empty($_POST)) {

    $login->logar($_POST);

    header("location: " . $_SESSION["url"]);
} elseif (!empty($_GET['sair'])) {
    session_destroy();
}
?>
<h3>Sistema Academico</h3>
<form action="login.php" method="post">
    <p style="color:red"><?php echo (!empty($_SESSION["msg"]) ? $_SESSION["msg"] : "") ?><br></p>
    <label>Login</label>
    <input type="text" name="login" value="<?php echo (!empty($_GET['login']) ? $_GET['login'] : "") ?>" placeholder="exemplo@login.com" /><br>
    <label>Senha</label>
    <input type="password" name="senha" /><br>
    <button type="submit">Logar</button>
    <button><a href="RegistrarUsuarioForm.php">Registrar</a></button>
</form>
<?php include "./base/rodape.php"; ?>