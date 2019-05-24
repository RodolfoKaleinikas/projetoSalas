<?php 
include "conecta_banco.php";
include "header.php";

$id = $_GET["id"];

$comando = "select * from reservas, salas where salas.id = reservas.sala_id";

$query = $mysqli->query($comando);

while($dados=mysqli_fetch_object($query)) {
  $nomeSala = $dados->nome;
  $data = $dados->dt_reserva;
  $descricao = $dados->descricao;
}

$query->free();


?>

<header class="header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Editar tarefas</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center flex-column align-items-center">
        <form name="form" id="formulario" action="gravaEdicao.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">
          <input type="hidden" name="txtid" value="<?php echo $id; ?>">
          <label for="txtNomeSala">Escolha a sala</label>
          <select name="sala">
            <?php 
              foreach ($variable as $key => $value) {
                # code...
              }
              <option value="volvo">Volvo XC90</option>
            ?>
          
          </select>
          <input name="txtNomeSala" id="txtNomeSala" type="text" value="<?php echo $tarefa; ?>">
          <label for="txtdata">Data</label>
          <input name="txtdata" id="txtdata" type="date" value="<?php echo $data_entrega; ?>">
          <input type="submit" value="Gravar">
          <input type="button" value="Consultar" onclick="location.href='consultageral.php'" class="btn">
          <input type="button" value="Página inicial" onclick="location.href='index.html'" class="btn">
        </form>
      </div>
    </div>
  </section>

  <?php 
    include "footer.php";
  ?>
