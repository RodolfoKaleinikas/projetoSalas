<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/index.js"></script>
  <title>Cadastro de tarefas</title>
</head>
<body>

  
  
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title">Login</h1>
        </div>
      </div>
    </div>
  </header>
  
  <section class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center flex-column align-items-center">

        <form name="form" onsubmit="return validaForm()" action="verificalogin.php" method="POST" class="col-12 d-flex justify-content-center flex-column form_cadastro_tarefa">
          <label for="txtemail">Email</label>
          <input name="txtemail" id="txtemail" type="text">
          <label for="txtsenha">Senha</label>
          <input name="txtsenha" id="txtsenha" type="password">
          <input type="submit" value="Logar">
          <input value="Esqueci a senha" type="button" onclick="location.href='esqueciSenha.php'" class="btn">
        </form>
        <?php 
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          if (strpos($fullUrl, "msg=campo_vazio") == true) {
            echo "<p class='msg_aviso'>Você não preencheu todos os campos!</p>";
            exit();
          }
          elseif (strpos($fullUrl, "msg=user_invalido") == true) {
            echo "<p class='msg_aviso'>Usuário ou senha inválidos!</p>";
            exit();
          }
        ?>
      </div>
    </div>
  </section>



  
  
  
</body>
</html>