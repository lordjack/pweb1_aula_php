<?php
include "../controller/ContatoController.php";
include "./base/header.php";

verificarLogin();

$contato = new ContatoController();

if (!empty($_GET['id'])) {
    $contato->deletar($_GET['id']);
    $_SESSION["msg"] = "Registro excluido com sucesso!";
    header("location: ContatoList.php");
}

if (!empty($_POST)) {
    $load = $contato->pesquisar($_POST);
} else {
    $load = $contato->carregar();
}

if (!empty($_GET['msg'])) {
    $_SESSION["msg"] = "";
}

?>
<h3>Listagem Contatos</h3>
<p style="color:red"><?php echo (!empty($_SESSION["msg"]) ? $_SESSION["msg"] : "") ?><br></p>
<form action="ContatoList.php" method="post">
    <select name="campo">
        <option value="nome">Nome</option>
        <option value="telefone">Telefone</option>
        <option value="email">Email</option>
    </select>
    <label>Valor</label>
    <input type="text" name="valor" placeholder="Pesquisar" />
    <button type="submit">Buscar</button>
    <a href="ContatoForm.php?msg=0">Cadastrar</a><br><br>
</form>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th></th>
        <th></th>
    </tr>
    <?php
    foreach ($load as $item) {
        echo "<tr>";
        echo "<td>" . $item->nome . "</td>";
        echo "<td>" . $item->telefone . "</td>";
        echo "<td>" . $item->email . "</td>";
        echo "<td><a href='ContatoForm.php?id=$item->id'>Editar</a></td>";
        echo "<td><a onclick='return confirm(\"Deseja Excluir? \")' href='ContatoList.php?id=$item->id'>Deletar</a></td>";
        echo "<tr>";
    }
    ?>
</table>
<?php include "./base/rodape.php"; ?>