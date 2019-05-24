<?php 
include "conecta_banco.php";
include "header.php";

session_start();
if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>" ;
  die() ;
} else {

  $op_sala = $_POST["opcao_sala"];
  $op_reserva = $_POST["opcao_reserva"];
  $dt_reserva = $_POST["data_reserva"];
  $desc = $_POST["desc"];
  $data_nula = "0000-00-00";
  $data_atual = date("Y-m-d");

  if(empty($op_sala) || empty($op_reserva) || empty($dt_reserva)) {
    header("location: reserva.php?msg=campo_vazio");
    exit;
  }

  $query = "SELECT * FROM reservas WHERE sala_id = $op_sala";

  $query = $mysqli->query($query);

  while($dados=mysqli_fetch_object($query)) {
    $datas_reservas[]  = $dados->dt_reserva;
    $opcoes_reservas[] = $dados->opcao_reserva;
    $ids_salas[]       = $dados->sala_id;
  }

  $tamanho = sizeof($datas_reservas);


  for ($i=0; $i < $tamanho; $i++) { 
    if ($dt_reserva < $data_atual) {
      header("location:reserva.php?msg=data_invalida");
      exit;
    } elseif ($dt_reserva === $data_nula) {
      header("location:reserva.php?msg=data_nula");
      exit;
    } elseif (($op_reserva === $opcoes_reservas[$i]) && ($dt_reserva === $datas_reservas[$i])) {
      header("location:reserva.php?msg=opcao_existente");
      exit;
    } else {
      $sql = "INSERT INTO reservas(dt_reserva, opcao_reserva, descricao, sala_id) VALUES ('$dt_reserva', '$op_reserva', '$desc', '$op_sala' )";
      $query = $mysqli->query($sql);
    }
  }

?>


  <header class="header"> 
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Incluir tarefas</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="title_excluir">Inclusão realizada com sucesso</h2>
      </div>
    </div>
  </section>

  <div class="d-flex justify-content-center">
    <button onclick="location.href='consultageral.php'" class="btn mr-2">Consultar</button>
    <button onclick="location.href='index.html'" class="btn">Página inicial</button>
  </div>

  </body>
</html>

<?php
}
?>




