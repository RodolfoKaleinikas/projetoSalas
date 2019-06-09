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

  $sql = "DELETE pessoas, usuarios FROM pessoas INNER JOIN usuarios ON usuarios.pessoa_id = pessoas.pessoa_id  WHERE pessoas.pessoa_id='$pessoa_id'";

  $query_pessoas = $mysqli->query($sql);

?>


  <header class="header"> 
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Exclusão de usuários</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="title_excluir">Usuário excluído com sucesso</h2>
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




