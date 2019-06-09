<?php

	include "conecta_banco.php";
	include "header.php";

	$comando = "SELECT * from usuarios";

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
		<li class="menu_lista_item"><a href="reserva.php">Reservar</a></li>
		<li class="menu_lista_item"><a href="usuarios.php">Usuários</a></li>
		<li class="menu_lista_item"><a href="logout.php">Sair</a></li>
	</ul>
</nav>

<section class="container section_form">
	<div class="row">
		<div class="col-12 d-flex flex-column justify-content-center align-items-center">
			<table class="tabela_consulta">
				<tr>
					<th>Login</th>
					<th>Senha</th>
					<th>Acesso</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>

			<?php 

				while($dados=mysqli_fetch_object($query)) {
					$id = $dados->pessoa_id;
					echo "<td>" . $dados->login_user . "</td>";
          echo "<td>" . $dados->senha . "</td>";
          if ($dados->acesso == 1) {
            echo "<td>Admin</td>";
          } else {
            echo "<td>Funcionário</td>";
          }
					echo "<td><a class='editar' href='editar_usuario.php?id=$id'>Editar</a></td>";
					echo "<td><a class='excluir' href='excluir_usuario.php?id=$id'>Excluir</a></td></tr>";
				}

				$query->free();

				echo "</table>";
			?>

			<div class="d-flex justify-content-center btns_consulta">
				<button onclick="location.href='cadastra-usuario.php'" class="mt-4 btn">Adicionar Usuário +</button>
			</div>
		</div>
	</div>
</section>



<?php

}

include "footer.php";

?>