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

        if(empty($_POST['id'])){
          $conn->inserir($_POST);
        } else {
          $conn->atualizar($_POST);
        }
        header("location: ContatoList.php");

    } catch (Exception $e){
        $id = $_POST['id'];
        header("location: ContatoForm.php?id=$id&erro=".$e->getMessage());
    }
 }
 if(!empty($_GET['id'])){
   $data = $conn->buscar($_GET['id']);
   //var_dump($data);
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
        <?php echo(!empty($_GET["erro"])? $_GET["erro"]:"") ?><br>
        <input type="hidden" name="id" value="<?php echo(!empty($data->id) ? $data->id:"")?>" />
        <label for="">Nome</label>
        <input type="text" name="nome" value="<?php echo(!empty($data->nome) ? $data->nome : "" ) ?>"><br>

        <label for="">Email</label>
        <input type="text" name="email" value="<?php echo(!empty($data->email) ? $data->email : "" ) ?>"><br>

        <label for="">Telefone</label>
        <input type="text" name="telefone" value="<?php echo(!empty($data->telefone) ? $data->telefone : "" ) ?>"><br>

        <button type="submit"><?php echo(empty($_GET['id'])?"Salvar":"Atualizar")?></button><br>
        <a href="ContatoList.php">Voltar</a><br><br>
    </form>
</body>
</html>