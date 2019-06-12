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

  $id_user = $_SESSION[ "id_user" ];


?>



<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="title">Reservar salas</h1>
      </div>
    </div>
  </div>
</header>

<section class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center flex-column align-items-center">
      <form name="form" id="formulario" action="verificaReserva.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">
        <input type="hidden" name="id_usuario" value="<?php echo $id_user; ?>">

        <label for="op_sala">Escolha a sala</label>
        <select id="op_sala" name="opcao_sala">

          <?php
            while($dados=mysqli_fetch_object($query)) {
              $id = $dados->id;
          
          ?>
          
          <option value="<?php echo $id ?>"><?php echo $dados->nome ?></option>

          <?php 
          }
          ?>

        </select>

        <label for="data_reserva">Escolha a sala</label>
        <input type="date" name="data_reserva" id="data_reserva">

        <label for="op_reserva">Escolha uma opção de horário</label>
        <select id="op_reserva" name="opcao_reserva">
          <option value="op1">8hs - 10hs</option>
          <option value="op2">10hs - 12hs</option>
          <option value="op3">14hs - 16hs</option>
        </select>

        <label for="descricao">Breve descrição sobre a reserva</label>
        <textarea name="desc" cols="6" rows="6"></textarea>

        <input type="submit" value="Reservar">
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
        ?>
    </div>
  </div>
</section>

<?php
}
?>