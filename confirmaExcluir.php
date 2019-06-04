<?php 
include "conecta_banco.php";
include "header.php";

session_start();
if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>" ;
  die();
} else {

  $id_reserva = $_POST["id_reserva"];

  $sql = "DELETE from reservas WHERE id_reserva='$id_reserva'";

  $query = $mysqli->query($sql);

?>


  <header class="header"> 
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Exclusão de reservas</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="title_excluir">Reserva excluída com sucesso</h2>
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




