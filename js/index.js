function validaForm() {
  var inputTarefa = document.forms["form"]["txtemail"].value;
  var inputData = document.forms["form"]["txtsenha"].value;
  if(inputTarefa == "") {
    alert("E-mail deve ser preenchido");
    return false;
  } else if(inputData == ""){
    alert("Senha deve ser preenchida");
    return false;
  }
}

