<?php 
include "conecta_banco.php";
include "header.php";

session_start();
if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>" ;
  die();
} else {

  $nome_usuario = $_POST["nome_usuario"];
  $sobrenome_usuario = $_POST["sobrenome_usuario"];
  $email_usuario = $_POST["email_usuario"];
  $senha_usuario = $_POST["senha_usuario"];
  $fone_usuario = $_POST["fone_usuario"];
  $departamento_usuario = $_POST["departamento_usuario"];
  $tipo_usuario = $_POST["tipo_usuario"];

  if(empty($nome_usuario) || empty($sobrenome_usuario) || empty($email_usuario) || empty($tipo_usuario)) {
    header("location: cadastra-usuario.php?msg=campo_vazio");
    exit;
  }

  $sql = "SELECT * FROM pessoas order by id";
  $query = $mysqli->query($sql);

  $sql2 = "SELECT * FROM usuarios order by id";
  $query2 = $mysqli->query($sql2);

  while($dados=mysqli_fetch_object($query)) {
    $emails[]  = $dados->email;
  }

  while($dados2=mysqli_fetch_object($query2)) {
    $senhas[] = $dados2->senha;
  }

  foreach ($emails as $valor) {
    if ($email_usuario === $valor) {
      header("location: cadastra-usuario.php?msg=email_existe");
      exit;
    }
  }

  foreach ($senhas as $valor) {
    if ($senha_usuario === $valor) {
      header("location: cadastra-usuario.php?msg=senha_existe");
      exit;
    }
  }


  $insert_pessoas = "INSERT INTO pessoas(nome, sobrenome, email, telefone, departamento) VALUES ('$nome_usuario', '$sobrenome_usuario', '$email_usuario', '$fone_usuario', '$departamento_usuario' )";
  $insert_usuarios = "INSERT INTO usuarios(nome, senha, acesso) VALUES ('$email_usuario', '$senha_usuario', '$tipo_usuario')";

  $query1 = $mysqli->query($insert_pessoas);
  $query2 = $mysqli->query($insert_usuarios);

?>


  <header class="header"> 
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Cadastro de usuários</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="title_excluir">Usuário cadastrado com sucesso</h2>
      </div>
    </div>
  </section>

  <div class="d-flex justify-content-center">
    <button onclick="location.href='home-admin.php'" class="btn">Página inicial</button>
  </div>

  </body>
</html>

<?php
}
?>




