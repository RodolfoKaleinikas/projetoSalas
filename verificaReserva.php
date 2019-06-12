<?php 
include "conecta_banco.php";
include "header.php";

session_start();
if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>" ;
  die();
} else {

  $op_sala = $_POST["opcao_sala"];
  $op_reserva = $_POST["opcao_reserva"];
  $dt_reserva = $_POST["data_reserva"];
  $id_user = $_POST["id_usuario"];
  $desc = $_POST["desc"];
  $data_nula = "0000-00-00";
  $data_atual = date("Y-m-d");
  $reservas_existentes = 0;

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

  if (@$datas_reservas != null) {

    $tamanho = sizeof($datas_reservas);

    for ($i=0; $i < $tamanho; $i++) { 
      if ($dt_reserva < $data_atual) {
        header("location:reserva.php?msg=data_invalida");
        exit;
      } elseif ($dt_reserva === $data_nula) {
        header("location:reserva.php?msg=data_nula");
        exit;
      } 
      
      if ($op_reserva == $opcoes_reservas[$i]) {
        if ($dt_reserva == $datas_reservas[$i]) {
          $reservas_existentes += 1;
        }
      } 

    }

    if($reservas_existentes > 0) {
      header("location:reserva.php?msg=opcao_existente");
      exit;
    } else {
        $sql = "INSERT INTO reservas(dt_reserva, opcao_reserva, descricao, usuario_id, sala_id) VALUES ('$dt_reserva', '$op_reserva', '$desc', '$id_user', '$op_sala' )";
        $sql = $mysqli->query($sql);
    }

    include "reserva_ok.php";



  } else {
    $sql = "INSERT INTO reservas(dt_reserva, opcao_reserva, descricao, usuario_id, sala_id) VALUES ('$dt_reserva', '$op_reserva', '$desc', '$id_user', '$op_sala' )";
    $sql = $mysqli->query($sql);
    include "reserva_ok.php";
  }

}


?>





