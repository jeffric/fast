<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Modificar Info Usuario", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Modificación"); ?>
		<div role="main" class="ui-content">

			<p align="center"><strong>MODIFICACIÓN INFORMACION USUARIO</strong><br />
			<div class="ui-body ui-body-a ui-corner-all">

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtNombre" >Nombre(s) de usuario:</label>
						<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtApellido" >Apellido(s) de usuario:</label>
						<input type="text" name="txtApellido" id="txtApellido" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtCorreo">Correo de usuario/Usuario:</label>
						<input disabled="true" type="text" name="txtCorreo" id="txtCorreo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>	
													
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtPassword">Password Nuevo:</label>
						<input  type="password" name="txtPassword" id="txtPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtConfPassword">Confirmar Password Nuevo:</label>
						<input type="password" name="txtConfPassword" id="txtConfPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>		
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtPassActual"> Password Actual:</label>
						<input type="password" name="txtPassActual" id="txtPassActual" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>										
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<button id="botonGuardar" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Guardar Cambios</button>
					</div>					
									

			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		<?php echo $c_funciones->getFooterNivel2(); ?>					
</div>

<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
			<center><img src="../img/admiracion.png" style="width:30%; height:30%; margin-top:1px;" />
			<br>
            <a href="../Modificar/modificarMiInfo.php" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageExito" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeExito" align="center"></p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="../Modificar/modificarMiInfo.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

</body>
	<script type="text/javascript">
	$(function(){

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "obtenerInfoUsuario", AjxPUser: <?php echo $idUsuario?>},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                  	 var recoge=msg.split(",");

                    	$('#txtNombre').val(recoge[1]);
						$('#txtApellido').val(recoge[2]);
						$('#txtCorreo').val(recoge[3]);
						
						  

                  }              


                });			

		$("#botonGuardar").click(function(){
			Validar();
		});

		function Validar(){
				if($('#txtNombre').val().trim() == ""){

						$("#mensaje").text("Debes ingresar el nombre de usuario");
						$.mobile.changePage('#pageWarning', 'pop', true, true);
						return false;					
				}
				if($('#txtApellido').val().trim() == ""){

						$("#mensaje").text("Debes ingresar el apellido de usuario");
						$.mobile.changePage('#pageWarning', 'pop', true, true);
						return false;					
				}				
				else if($('#txtPassword').val().trim() != $('#txtConfPassword').val().trim()){

						$("#mensaje").text("Los Password No coinciden");
						$.mobile.changePage('#pageWarning', 'pop', true, true);
						return false;					
				}
				else if($('#txtPassActual').val().trim() == ""){

						$("#mensaje").text("Debes ingresar tu Password Actual para demostrar tu autenticidad");
						$.mobile.changePage('#pageWarning', 'pop', true, true);
						return false;						
				}	
				else{
						//va a insertar
		                      $.ajax({
			                        type: "POST",
			                        url: "../funcionesAjax.php",
			                        data: {nombreMetodo: "modificarMiInfo", AjxNombre: $('#txtNombre').val(), AjxApellido:$('#txtApellido').val() , AjxCorreo: $('#txtCorreo').val(), AjxPassword:$('#txtPassword').val(), AjxUsuario:<?php echo $idUsuario?>, AjxPassActual:$('#txtPassActual').val().trim()},
			                        contentType: "application/x-www-form-urlencoded",
			                        beforeSend: function(){
			                        $('#loader_gif').fadeIn("slow");

			                        },
			                        dataType: "html",
			                        success: function(msg){
			                          $("#loader_gif").fadeOut("slow");         
									  $("#mensajeExito").text(msg);
									  $.mobile.changePage('#pageExito', 'pop', true, true);
									  return false;			                                                            

			                        }              
		                      });
				}									
		}

	});

	</script>
	</html>