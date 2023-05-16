<?php
    include "../BD.class.php";

    $conn = new BD();
    $load = $conn->select();

    if(!empty($_GET['id'])){
        $conn->deletar($_GET['id']);
        header("location: ContatoList.php");
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
    <a href="ContatoForm.php">Cadastrar</a><br><br>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th></th>
        <th></th>
    </tr>
    <?php
        foreach($load as $item){
            echo "<tr>";
                echo "<td>".$item->nome."</td>";
                echo "<td>".$item->telefone."</td>";
                echo "<td>".$item->email."</td>";
                 echo "<td><a href='ContatoForm.php?id=$item->id'>Editar</a></td>";
                echo "<td><a onclick='return confirm(\"Deseja Excluir? \")' href='ContatoList.php?id=$item->id'>Deletar</a></td>";
            echo "<tr>";
        }
    ?>
</table>
</body>
</html>