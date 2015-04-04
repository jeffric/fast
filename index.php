<?php 

include_once "funciones.php";
$c_funciones = new Funciones();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.js"></script>
	<!-- libreria para alertas -->
	<script src="js/sweet-alert.js"></script>
	<link rel="stylesheet" href="css/sweet-alert.css">		

</head>

<body>
	<div data-role="page">
		<div data-role="header">
				<h1>FAST App - Login</h1>
				<div style="position: absolute; right:0; top: 0;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
				</div>
		</div>

		<div style="text-align: center; padding-top: 10px;">
				<img src="img/logoVM.jpg" alt="image" style=" width:50%;"/>
		</div>

		<div data-role="content">
				<!-- <form action="home.php" method="POST" data-ajax="false"> -->

						<div data-role="fieldcontain">
								<label for="username">Correo:</label>
								<input type="text" name="username" id="username"  />
						</div>	

						<div data-role="fieldcontain">
								<label for="password">Password:</label>
								<input type="password" name="password" id="password" />
						</div>	

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="slcTipoUsuarios" >Tipo de usuario</label>
								<select name="slcTipoUsuarios" id="slcTipoUsuarios">
<?php 				

								$result = $c_funciones->getTipoUsuarios();					
								while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}				
?>								</select>	

						</div>
						<input type="button"  value="Login" id="btnLogin">
					<!-- --<input type="submit" name="login" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" value="Login" /> -->
				<!-- </form> -->	
		</div><!-- /content -->

		<div data-role="footer" data-position="fixed">
			<h4>
				Visión Mundial Guatemala, <?php echo date("Y"); ?> <img src="img/logo-fit.png" style="width:76px; height:25px; padding-left:10px;"/>
			</h4>
		</div><!-- /footer -->

</div><!-- /page -->

    <div id="pageError" data-role="dialog" data-theme="b">
        <header data-role="header">
            <h1>Error</h1>
        </header>
        <article data-role="content">
            <p>Usuario, contraseña o tipo de usuario no validos</p>
            <a href="#" data-role="button" data-rel="back">Aceptar</a>
        </article>
    </div>	

<script type="text/javascript">


    $("#btnLogin").click(function(){

        var usu = $("#username").val();
        var pass = $("#password").val();
        var tipo = $("#slcTipoUsuarios").val();
        $.post("funcionesAjax.php",{ nombreMetodo:"Auth", usu : usu, pass : pass, tipo: tipo},
        	function(respuesta){
        	
            if (respuesta == true) {

            	window.location.href = 'home.php'; 
            }
            else{
                $.mobile.changePage('#pageError', 'pop', true, true);
            }
        });
  	
    });


</script>

</body>
</html>