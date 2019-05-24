<?php

	include "conecta_banco.php";
	include "header.php";

	$comando = "select * from reservas, salas where salas.id = reservas.sala_id";

	$query = $mysqli->query($comando);

	// var_dump($query);

	session_start();
	if (is_Null(@$_SESSION["login"])) {

		echo "Você deve fazer o Login<br><br>";
		echo "<a href=login.php>Página de Login</a>" ;
		die() ;
	} else {

?>

<nav class="menu">
	<ul class="menu_lista">
		<li class="menu_lista_item"><a href="reserva.php">Reservar</a></li>
		<li class="menu_lista_item"><a href="#">Sair</a></li>
	</ul>
</nav>

<section class="container">
	<div class="row">
		<div class="col-12 d-flex flex-column justify-content-center align-items-center">
			<table class="tabela_consulta">
				<tr>
					<th>Id</th> 
					<th>Data da Reserva</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>

			<?php 

				while($dados=mysqli_fetch_object($query)) {
					$id = $dados->id;
					echo "<tr><td>" . $dados->id . "</td>";
					echo "<td>" . $dados->dt_reserva . "</td>";
					echo "<td>" . $dados->nome . "</td>";
					echo "<td>" . $dados->descricao . "</td>";
					echo "<td><a class='editar' href='editar.php?id=$id'>Editar</a></td>";
					echo "<td><a class='excluir' href='excluir.php?id=$id'>Excluir</a></td></tr>";
				}

				$query->free();

				echo "</table>";
			?>

			<div class="d-flex justify-content-center btns_consulta">
				<button onclick="location.href='index.html'" class="btn_consulta" href="index.html">Página inicial</button>
				<!-- <button onclick="location.href='editar.php?id='.$id" class="btn_consulta" href="index.html">Editar</button> -->
				<!-- <button onclick="location.href='excluir.php?id='.$id" class="btn_consulta btn_consulta_excluir" href="index.html">Excluir</button> -->
			</div>
		</div>
	</div>
</section>



<?php

}

include "footer.php";

?>