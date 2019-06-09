<?php 
require "conecta_banco.php";
include "header.php";

session_start();

$id = $_GET["id"];

$sql = "SELECT * FROM pessoas, usuarios WHERE pessoas.pessoa_id = '$id' AND usuarios.pessoa_id = '$id'";

$query = $mysqli->query($sql);


if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>";
  die();
} else {

  while($dados=mysqli_fetch_object($query)) {
    $pessoa_id = $dados->pessoa_id;
    $login = $dados->login_user;
    $senha = $dados->senha;
    $acesso = $dados->acesso;
    $nome = $dados->nome;
    $sobrenome = $dados->sobrenome;
    $telefone = $dados->telefone;
    $departamento = $dados->departamento;
  }

?>



<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="title">Editar usuário</h1>
      </div>
    </div>
  </div>
</header>

<section class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center flex-column align-items-center">
      <form name="form" id="formulario" action="verificaAlteraUsuario.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">
        <input type="hidden" name="pessoa_id" value="<?php echo $pessoa_id; ?>">

        <label for="nome_usuario">Nome</label>
        <input type="text" value="<?php echo $nome; ?>" name="nome_usuario" id="nome_usuario">

        <label for="sobrenome_usuario">Sobrenome</label>
        <input type="text" value="<?php echo $sobrenome; ?>" name="sobrenome_usuario" id="sobrenome_usuario">

        <label for="email_usuario">Email</label>
        <input type="email" value="<?php echo $login; ?>" name="email_usuario" id="email_usuario">

        <label for="senha_usuario">Senha</label>
        <input type="password" value="<?php echo $senha; ?>" name="senha_usuario" id="senha_usuario">

        <label for="fone_usuario">Telefone</label>
        <input type="number" value="<?php echo $telefone; ?>" name="fone_usuario" id="fone_usuario">

        <label for="departamento_usuario">Departamento</label>
        <input type="text" value="<?php echo $departamento; ?>" name="departamento_usuario" id="departamento_usuario">

        <label for="tipo_usuario">Tipo de usuário</label>
        <select id="tipo_usuario" name="tipo_usuario">
          <option <?php echo $acesso == 1 ? "selected" : ""; ?> value="1">Administrador</option>
          <option <?php echo $acesso == 2 ? "selected" : ""; ?> value="2">Funcionário</option>
        </select>

        <input type="submit" value="Editar">
        <input type="button" value="Página inicial" onclick="location.href='home-admin.php'" class="btn">

      </form>

      <?php 
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          if (strpos($fullUrl, "msg=campo_vazio") == true) {
            echo "<p class='msg_aviso'>Você não preencheu todos os campos!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=email_existente") == true) {
            echo "<p class='msg_aviso'>O email informado já está sendo usado por outro usuário!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=email_existente") == true) {
            echo "<p class='msg_aviso'>O email informado já está sendo usado por outro usuário!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=senha_existente") == true) {
            echo "<p class='msg_aviso'>A senha informada já está sendo usada por outro usuário!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=nenhuma_modificacao") == true) {
            echo "<p class='msg_aviso'>Você não fez nenhuma modificação!</p>";
            exit;
          }
        ?>
    </div>
  </div>
</section>

<?php
}
?>