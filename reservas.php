<?php

	include "conecta_banco.php";
	include "header.php";

	$comando = "select * from reservas, salas where salas.id = reservas.sala_id";

	$query = $mysqli->query($comando);

	session_start();
	if (is_Null(@$_SESSION["login"])) {

		echo "Você deve fazer o Login<br><br>";
		echo "<a href=login.php>Página de Login</a>" ;
		die() ;
	} else {

		$usuario  = $_SESSION["login"];
		$acesso  = $_SESSION["acesso"];
		$pessoa_id  = $_SESSION["pessoa_id"];

		$comando2 = "SELECT * FROM pessoas where pessoas.email = '$usuario'";
		$query2   = $mysqli->query($comando2);

?>

<nav class="menu">
	<p>Seja bem vindo, 
	<?php  
		while($dados2=mysqli_fetch_object($query2)) {
			echo "<span>" . $dados2->nome . "</span>";
		}
	?>
	</p>

	<ul class="menu_lista">
		<li class="menu_lista_item"><a href="reservas.php">Reservas</a></li>
		<li class="menu_lista_item"><a href="usuarios.php">Usuários</a></li>
		<li class="menu_lista_item"><a href="logout.php">Sair</a></li>
	</ul>
</nav>

<section class="container section_form">
	<div class="row">
		<div class="col-12 d-flex flex-column justify-content-center align-items-center">
			<table class="tabela_consulta">
				<tr>
					<th>id reserva</th>
					<th>Data da Reserva</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>

			<?php 

				while($dados=mysqli_fetch_object($query)) {
					$id = $dados->id_reserva;
					echo "<td>" . $dados->id_reserva . "</td>";
					echo "<td>" . $dados->dt_reserva . "</td>";
					echo "<td>" . $dados->nome . "</td>";
					if ($dados->opcao_reserva === "op1") {
						echo "<td>8hs - 10hs</td>";
					} elseif ($dados->opcao_reserva === "op2") {
						echo "<td>10hs - 12hs</td>";
					} elseif ($dados->opcao_reserva === "op3") {
						echo "<td>14hs - 16hs</td>";
					}
					echo "<td><a class='editar' href='editar.php?id=$id'>Editar</a></td>";
					echo "<td><a class='excluir' href='excluir.php?id=$id'>Excluir</a></td></tr>";
				}

				$query->free();

				echo "</table>";
			?>

			<div class="d-flex justify-content-center btns_consulta">
			</div>
		</div>
	</div>
</section>



<?php

}

include "footer.php";

?>