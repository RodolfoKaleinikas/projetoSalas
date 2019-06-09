<?php 
include "conecta_banco.php";
include "header.php";

session_start();
if (is_Null(@$_SESSION["login"])) {
  
  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>" ;
  die();
} else {
  
  $pessoa_id = $_POST["pessoa_id"];
  $nome_usuario = $_POST["nome_usuario"];
  $sobrenome_usuario = $_POST["sobrenome_usuario"];
  $email_usuario = $_POST["email_usuario"];
  $senha_usuario = $_POST["senha_usuario"];
  $fone_usuario = $_POST["fone_usuario"];
  $departamento_usuario = $_POST["departamento_usuario"];
  $tipo_usuario = $_POST["tipo_usuario"];
  $emails_existentes = 0;
  $senhas_existentes = 0;
  $senha = array();
  
  
  if(empty($nome_usuario) || empty($sobrenome_usuario) || empty($email_usuario) || empty($senha_usuario)) {
    header("location: reserva.php?msg=campo_vazio");
    exit;
  }
  
  $sql_usuarios = "SELECT * FROM usuarios";
  
  $query = $mysqli->query($sql_usuarios);
  
  while($dados=mysqli_fetch_object($query)) {
    $id_pessoa[]     = $dados->pessoa_id;
    $login_user[]    = $dados->login_user;
    $senha[]         = $dados->senha;
  }
  
  $tamanho = sizeof($login_user);
  
  for ($i=0; $i < $tamanho; $i++) {     
    if ($email_usuario === $login_user[$i]) {
      if ($pessoa_id != $id_pessoa[$i]) {
        $emails_existentes += 1;
      }
    }
    if ($senha_usuario === $senha[$i]) {
      if ($pessoa_id != $id_pessoa[$i]) {
        $senhas_existentes += 1;
      }    
    } 
    
  }
  
  if($emails_existentes > 0) {
    header("location:editar_usuario.php?msg=email_existente&id=$pessoa_id");
    exit;
  } elseif ($senhas_existentes > 0) {
    header("location:editar_usuario.php?msg=senha_existente&id=$pessoa_id");
    exit;
  } else {
    $update_pessoas = "UPDATE pessoas SET nome='$nome_usuario', sobrenome='$sobrenome_usuario', email='$email_usuario', telefone='$fone_usuario', departamento='$departamento_usuario' WHERE pessoa_id='$pessoa_id'";
    $update_usuarios = "UPDATE usuarios SET login_user='$email_usuario', senha='$senha_usuario', acesso='$tipo_usuario' WHERE pessoa_id='$pessoa_id'";
    $query_pessoas = $mysqli->query($update_pessoas);
    $query_usuarios = $mysqli->query($update_usuarios);
  }
  
  
  ?>
  
  
    <header class="header"> 
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="title">Edição de usuários</h1>
          </div>
        </div>
      </div>
    </header>
    
    <section class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="title_excluir">Usuário editado com sucesso</h2>
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




