<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Cadastro</title>
<!-- Meta tag Keywords -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- css files -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all">
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900iSlabo+27px&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<body>
<!--header-->
<div class="agileheader">
	<h1>Novo usuario:</h1>
</div>
<!--main-->
<div class="main-w3l">
<div class="w3layouts-main">
		<form action="<?=HOME_URI?>/Cadastro/Cadastrar" method="post">
			<input id='email' placeholder="E-MAIL" name="email" type="email" required="true"/>
			<input id='password' placeholder="Senha" name="password" type="password" required="true"/>
	  		<input id='nome' placeholder="Seu nome" name="Nome" type="text" required="false" />
			<input id='cpf'  placeholder="CPF" name="CPF" type="text" required="false"
			 maxlength="11">
			<input id='cnpj' placeholder="CNPJ" name="CNPJ" type="number" required="false"
			maxlength="14"/>
			<input id='endereco' placeholder="endereco" name="endereco" type="text" required="false"
			maxlength="100"/>

			<!--<h6><a href="#">Esqueceu sua senha?</a></h6>-->
				<div class="clear"></div>
				<div id="errorlogin"></div>
				<input type="button" onclick="verifyCad()" value="Cadastrar" name="login">
		</form>
		<p>já possui uma conta? <a href="/login">Logue-se!</a></p>
</div>
</div>
<!--//main-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/imask"></script>
<script>
	//verifica cadastro
	function verifyCad() {
		$.ajax({
		 method: "POST",
		 url: "<?=HOME_URI?>/cadastro/cadastrar",
		 data: {email: $("#email").val(),
			senha: $("#password").val(),
			nome: $("#nome").val(),
			cpf: $("#cpf").val(),
			cnpj: $("#cnpj").val(),
			endereco: $("#endereco").val()
			},
		 success: function(data){
			let result = JSON.parse(data);
			if (result.status == "error"){
				$("#errorlogin").html("<h4>" + result.message + "</h4>")
			}
		 }
		} )
	}

	//mascara cpf
	var cpf = document.querySelector("#cpf");
	cpf.addEventListener("blur", function(){
   	if(cpf.value) cpf.value = cpf.value.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");});

	//mascara cnpj
	var numberMask = IMask(
  document.getElementById('cnpj'),
  {
    mask: Number,
    min: 0,
    max: 1111111111111,
    thousandsSeparator: ' '
  });
</script>
</body>
</html>