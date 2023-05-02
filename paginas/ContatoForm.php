<?php
 include '../BD.class.php';
 $conn = new BD();

 if(!empty($_POST)){
    try {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nome'])) {  
            throw new Exception(" Somente letras e espaços em branco são permitidos. ");
        }
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception(" Formato de e-mail inválido. ");
        }
        $conn->inserir($_POST);
        header("location: ContatoList.php");

    } catch (Exception $e){
        echo $e->getMessage();
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
    <form action="ContatoForm.php" method="post">
        <h3>Formulário Contato</h3>
        <label for="">Nome</label>
        <input type="text" name="nome" id=""><br>

        <label for="">Email</label>
        <input type="text" name="email" id=""><br>

        <label for="">Telefone</label>
        <input type="text" name="telefone" id=""><br>

        <input type="submit" value="Enviar"><br>
        <a href="ContatoList.php">Voltar</a><br><br>
    </form>
</body>
</html>