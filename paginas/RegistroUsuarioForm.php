<?php
include '../BD.class.php';
$conn = new BD();

if (!empty($_POST)) {
    try {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nome'])) {
            throw new Exception(" Somente letras e espaços em branco são permitidos. ");
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception(" Formato de e-mail inválido. ");
        }

        if ($_POST['senha'] === $_POST['c_senha']) {
            //encripta senha
            $_POST['senha'] = password_hash(
                $_POST['senha'],
                PASSWORD_BCRYPT
            );

            $conn->inserir($_POST);
            header("location: Login.php");
        } else {
            throw new Exception(" As senhas devem se coincidirem. ");
        }
    } catch (Exception $e) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $login = $_POST['login'];
        header("location: RegistroUsuarioForm.php?&nome=$nome&email=$email&telefone=$telefone&login=$login&erro=" . $e->getMessage());
    }
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
    <form action="RegistroUsuarioForm.php" method="post">
        <h3>Formulário Registro Usuário</h3>
        <?php echo (!empty($_GET["erro"]) ? $_GET["erro"] : "") ?><br>

        <label for="">Nome</label>
        <input type="text" name="nome" value="<?php echo (!empty($_GET['nome']) ? $_GET['nome'] : "") ?>"><br>

        <label for="">Email</label>
        <input type="text" name="email" value="<?php echo (!empty($_GET['email']) ? $_GET['email'] : "") ?>"><br>

        <label for="">Telefone</label>
        <input type="text" name="telefone" value="<?php echo (!empty($_GET['telefone']) ? $_GET['telefone'] : "") ?>"><br>

        <label for="">Login</label>
        <input type="text" name="login" value="<?php echo (!empty($_GET['login']) ? $_GET['login'] : "") ?>"><br>

        <label for="">Senha</label>
        <input type="password" name="senha"><br>

        <label for="">Confirmar Senha</label>
        <input type="password" name="c_senha"><br>

        <button type="submit">Cadastrar</button><br>
        <a href="login.php">Voltar</a><br><br>
    </form>
</body>

</html>