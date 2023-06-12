<?php
include "../model/BD.class.php";
include "./base/header.php";

$conn = new BD();
session_start();

if (!empty($_POST)) {
    try {

        $usuario = $conn->login($_POST);

        if ($usuario) {
            $_SESSION["nome"] = $usuario->nome;
            $_SESSION["login"] = $_POST['login'];

            $url = "base/main.php";
        }
    } catch (Exception $e) {
        $login = $_POST['login'];
        $msg = " O login ou senha esta errado. Por favor, tente novamente. ";
        $url = "login.php?login=$login&erro=$msg";
    }
    header("location: $url");
} elseif (!empty($_GET['sair'])) {
    session_destroy();
    //var_dump($_SESSION);
}
?>
<h3>Sistema Academico</h3>
<form action="login.php" method="post">
    <p style="color:red"><?php echo (!empty($_GET["erro"]) ? $_GET["erro"] : "") ?></p>
    <label>Login</label>
    <input type="text" name="login" value="<?php echo (!empty($_GET['login']) ? $_GET['login'] : "") ?>" placeholder="exemplo@login.com" /><br>
    <label>Senha</label>
    <input type="password" name="senha" /><br>
    <button type="submit">Logar</button>
    <button><a href="RegistrarUsuarioForm.php">Registrar</a></button>
</form>
<?php include "./base/rodape.php"; ?>