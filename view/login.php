<?php
include '../controller/LoginController.php';

session_start();
$login = new LoginController();

if (!empty($_POST)) {
    $login->logar($_POST);

    $dados = "";
    header("location: " . $_SESSION['url']);
} else if (!empty($_GET['sair'])) {
    session_destroy();
}
$dados = !empty($_SESSION['dados']) ? $_SESSION['dados'] : "";
?>

<h3>Sistema Academico</h3>
<form action="login.php" method="post">
    <p style="color:red;">
        <?php echo (!empty($_SESSION["msg"]) ? $_SESSION["msg"] : "") ?>
    </p>
    <label>Login</label>
    <input type="text" name="login" value="<?php echo (!empty($dados['login']) ? $dados['login'] : "") ?>" /><br>
    <label>Senha</label>
    <input type="password" name="senha" /><br>
    <button type="submit">Logar</button>
    <button><a href="RegistrarUsuarioForm.php">Registrar-se</a></button>
</form>
<?php include "./base/rodape.php" ?>