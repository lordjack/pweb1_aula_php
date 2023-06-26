<?php
include_once '../controller/ContatoController.php';
include "base/header.php";
//session_start();
Util::verificarLogin();

$contato = new ContatoController();

if (!empty($_POST)) {

  if (empty($_POST['id'])) {

    $contato->salvar($_POST);
  } else {
    $contato->atualizar($_POST);
  }

  header("location: " . $_SESSION['url']);

}
if (!empty($_GET['id'])) {
  $data = $contato->buscar($_GET['id']);
  //var_dump($data);
}
//passa o valor para a variavem mensagem e limpa da sessão:
/*
if(!empty($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
    //var_dump($msg );
} else {
    $msg = "";
}
*/
?>

<form action="ContatoForm.php" method="post">
  <h3>Formulário Contato</h3>
    <p style="color:red;">
        <?php echo (!empty($_SESSION["msg"]) ? $_SESSION["msg"] : "") ?>
    </p>
  <input type="hidden" name="id" value="<?php echo (!empty($data->id) ? $data->id : "") ?>" />
  <label for="">Nome</label>
  <input type="text" name="nome" value="<?php echo (!empty($data->nome) ? $data->nome : "") ?>"><br>

  <label for="">Email</label>
  <input type="text" name="email" value="<?php echo (!empty($data->email) ? $data->email : "") ?>"><br>

  <label for="">Telefone</label>
  <input type="text" name="telefone" value="<?php echo (!empty($data->telefone) ? $data->telefone : "") ?>"><br>

  <button type="submit">
    <?php echo (empty($_GET['id']) ? "Salvar" : "Atualizar") ?>
  </button><br>
  <a href="ContatoList.php">Voltar</a><br><br>
</form>
<?php
include "base/rodape.php";