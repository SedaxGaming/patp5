<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Login</title>
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
	<h1>Logue-se</h1>
</div>
<!--main-->
<div class="main-w3l">
	<div class="w3layouts-main">
		<form action="<?=HOME_URI?>/Login/login" method="post">
			<input id="email" placeholder="E-MAIL" name="email" type="email" required="" 
      onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}"/>
			<input id="password" name="password" type="password" 
      required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
			<!--<h6><a href="#">Esqueceu sua senha?</a></h6>-->
				<div class="clear"></div>
				<div id="errorlogin"></div>
				<input type="button" onclick="verifyLogin()" value="login" name="login">
		</form>
		<p>Sem uma conta? <a href="/cadastro">Registre-se!</a></p>
		
	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	function verifyLogin() {
		$.ajax({
		 method: "POST",
		 url: "<?=HOME_URI?>/login/login",
		 data: {email: $("#email").val(), password: $("#password").val()},
		 success: function(data){
			let result = JSON.parse(data);
			if (result.status == "error"){
				$("#errorlogin").html("<h4>" + result.message + "</h4>")
			} else if (result.status == "ok"){
				window.location.href = "/dashboard"
			}
		 }
		} )
	}
</script>
</html>