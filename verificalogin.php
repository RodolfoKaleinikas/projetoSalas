
<?php 

include "conecta_banco.php";
include "header.php";

$email = $_POST["txtemail"];
$senha = $_POST["txtsenha"];

if(empty($email) || empty($senha)) {
	header("location: login.php?msg=campo_vazio");
	exit;
}


$executa = " select * from usuarios where nome='$email' and senha='$senha'";

$query = $mysqli->query($executa);


while ($dados=mysqli_fetch_object($query)) {

	$nome = $dados->nome;
	$acesso = $dados->acesso;
	$pessoa_id = $dados->pessoa_id;
}
$query->free();

if (!empty($nome)) {
	if ($acesso == 1) {
		session_start();
		$_SESSION[ "login" ] = $nome;
		$_SESSION[ "acesso" ] = $acesso;
		$_SESSION[ "pessoa_id" ] = $pessoa_id;
		header('location: home-admin.php');

	} elseif ($acesso == 2) {
		session_start();
		$_SESSION["login"] = $nome;
		$_SESSION[ "acesso" ] = $acesso;
		$_SESSION[ "pessoa_id" ] = $pessoa_id;
		header('location: home-funcionario.php');
		}
	} else {
		header("location:login.php?msg=user_invalido");
	}


?>

