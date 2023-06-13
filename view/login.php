<?php
include "../BD.class.php";

$conn = new BD();
session_start();

if (!empty($_POST)) {
    try {
        $usuario = $conn->login($_POST);

        if ($usuario) {
            $_SESSION["login"] = $_POST['login'];

            $url = "main.php";
        }
    } catch (Exception $e) {
        $login = $_POST['login'];
        $msg = "O login ou senha esta errado.Por favor, tente novamente.";
        $url = "login.php?login=$login&erro=" .  $msg;
    }
    header("location: $url");
} elseif (!empty($_GET['sair'])) {
}
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
    <h3>Sistema Academico</h3>
    <form action="login.php" method="post">
        <p style="color:red"><?php echo (!empty($_GET["erro"]) ? $_GET["erro"] : "") ?></p>
        <label>Login</label>
        <input type="text" name="login" value="<?php echo (!empty($_GET['login']) ? $_GET['login'] : "") ?>" /><br>
        <label>Senha</label>
        <input type="password" name="senha" /><br>
        <button type="submit">Logar</button>
    </form>
</body>

</html>