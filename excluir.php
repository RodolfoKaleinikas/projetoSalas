<?php 
require "conecta_banco.php";
include "header.php";

session_start();

$id = $_GET["id"];

$sql = "select * from salas order by id";

$sql2 = "select * from reservas where '$id' = reservas.id_reserva";

$query = $mysqli->query($sql);
$query2 = $mysqli->query($sql2);



if (is_Null(@$_SESSION["login"])) {

  echo "Você deve fazer o Login<br><br>";
  echo "<a href=login.php>Página de Login</a>";
  die();
} else {

  while($dados2=mysqli_fetch_object($query2)) {
    $sala_id = $dados2->sala_id;
    $descricao = $dados2->descricao;
    $op_reserva = $dados2->opcao_reserva;
    $dt_reserva = $dados2->dt_reserva;
  }

  $data_reserva = date('Y-m-d', strtotime($dt_reserva));

?>



<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="title">Excluir reserva</h1>
      </div>
    </div>
  </div>
</header>

<section class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center flex-column align-items-center">
      <form name="form" id="formulario" action="confirmaExcluir.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">
        <input type="hidden" name="id_reserva" value="<?php echo $id; ?>">



        <label for="op_sala">Escolha a sala</label>
        <select id="op_sala" name="opcao_sala" disabled>

          <?php
            while($dados=mysqli_fetch_object($query)) {
              $id = $dados->id;
          
          ?>
          
          <option <?php echo $id == $sala_id ? "selected" : ""; ?> value="<?php echo $id ?>"><?php echo $dados->nome ?></option>

          <?php 
          }
          ?>

        </select>

        <label for="data_reserva">Escolha a data</label>
        <input type="date" value="<?php echo $data_reserva; ?>" name="data_reserva" id="data_reserva" readonly>

        <label for="op_reserva">Escolha uma opção de horário</label>
        <select id="op_reserva" name="opcao_reserva" disabled>
          <option <?php echo $op_reserva == "op1" ? "selected" : ""; ?> value="op1">8hs - 10hs</option>
          <option <?php echo $op_reserva == "op2" ? "selected" : ""; ?> value="op2">10hs - 12hs</option>
          <option <?php echo $op_reserva == "op3" ? "selected" : ""; ?> value="op3">14hs - 16hs</option>
        </select>

        <label for="descricao">Breve descrição sobre a reserva</label>
        <textarea name="desc" cols="6" rows="6" readonly>
        <?php echo $descricao; ?>
        </textarea>

        <input type="submit" value="Excluir">
        <input type="button" value="Página inicial" onclick="location.href='home-admin.php'" class="btn">

      </form>

      <?php 
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          if (strpos($fullUrl, "msg=campo_vazio") == true) {
            echo "<p class='msg_aviso'>Você não preencheu todos os campos!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=data_existe") == true) {
            echo "<p class='msg_aviso'>Já existe uma reserva desta sala para o mesma data. Escolha uma outra data!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=data_invalida") == true) {
            echo "<p class='msg_aviso'>A data é inválida. Digite uma data do dia de hoje ou superior!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=data_nula") == true) {
            echo "<p class='msg_aviso'>Por favor, escolha uma data!</p>";
            exit;
          }
          elseif (strpos($fullUrl, "msg=opcao_existente") == true) {
            echo "<p class='msg_aviso'>Este horário já está reservado para esta data nesta sala. Escolha outro horário!</p>";
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