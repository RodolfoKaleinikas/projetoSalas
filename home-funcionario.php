<?php

	session_start();
	if ( is_Null ( @$_SESSION ["login"] )) {

		echo "Você deve fazer o Login<br><br>";
		echo "<a href=login.php>Página de Login</a>" ;
		die() ;
	} else {
		echo "Home funcionario";
		
		$usuario  = $_SESSION["login"];
		$acesso  = $_SESSION["acesso"];
		$pessoa_id  = $_SESSION["pessoa_id"];

		echo $usuario . "<br>";
		echo $acesso . "<br>";
		echo $pessoa_id . "<br>";
	}

?>