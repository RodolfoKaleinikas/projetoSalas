
<?php 

include "conecta_banco.php";
include "header.php";

session_start();
$_SESSION = array();
session_destroy();
header('location: login.php');


?>

