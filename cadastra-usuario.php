<?php 
require "conecta_banco.php";
include "header.php";

$sql = "select * from salas order by id";

$query = $mysqli->query($sql);

session_start();
if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>";
  die() ;
} else {


?>



<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="title">Cadastrar usuário</h1>
      </div>
    </div>
  </div>
</header>

<section class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center flex-column align-items-center">
      <form name="form" id="formulario" action="verificaUsuario.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">

        <label for="nome_usuario">Insira o nome</label>
        <input type="text" name="nome_usuario" id="nome_usuario">

        <label for="sobrenome_usuario">Insira o sobrenome</label>
        <input type="text" name="sobrenome_usuario" id="sobrenome_usuario">

        <label for="email_usuario">Insira o email</label>
        <input type="email" name="email_usuario" id="email_usuario">

        <label for="senha_usuario">Insira a senha</label>
        <input type="password" name="senha_usuario" id="senha_usuario">

        <label for="fone_usuario">Insira o telefone</label>
        <input type="number" name="fone_usuario" id="fone_usuario">

        <label for="departamento_usuario">Insira o departamento</label>
        <input type="text" name="departamento_usuario" id="departamento_usuario">

        <label for="tipo_usuario">Insira o tipo de usuário</label>
        <select id="tipo_usuario" name="tipo_usuario">
          <option value="1">Administrador</option>
          <option value="2">Funcionário</option>
        </select>

        <input type="submit" value="Cadastrar">
        <input type="button" value="Página inicial" onclick="location.href='home-admin.php'" class="btn">

      </form>

      <?php 
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          if (strpos($fullUrl, "msg=campo_vazio") == true) {
            echo "<p class='msg_aviso'>Você não preencheu todos os campos!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=email_existe") == true) {
            echo "<p class='msg_aviso'>O e-mail informado já existe</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=senha_existe") == true) {
            echo "<p class='msg_aviso'>Esta senha já está sendo usada. Insira outra senha</p>";
            exit;
          }
        ?>

    </div>
  </div>
</section>

<?php
}
?>