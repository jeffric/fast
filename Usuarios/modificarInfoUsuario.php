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
<?php echo $c_funciones->getHeaderNivel2("Modificar Infor Usuario", 
	'<style>
	  .panel-content {
	    padding: 1em;
	  }
  </style>'); 
 ?>
<body>
<div data-role="page" id="page">
	<?php $c_funciones->getHeaderPageNivel2("FAST Modificación"); ?>
		<div role="main" class="ui-content">

			<p align="center"><strong>MODIFICACIÓN INFORMACION USUARIO</strong><br />
			<div class="ui-body ui-body-a ui-corner-all">
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="lstUsuario" >Usuario</label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elegir un usuario</option>
							<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaUsuarios($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaUsuarios2($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}						
							}
							?>
						</select>
					</div>

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtNombre" >Nombre(s) de usuario</label>
						<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtApellido" >Apellido(s) de usuario</label>
						<input type="text" name="txtApellido" id="txtApellido" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="slcTipoUsuarios" >Tipo de usuario</label>			
						<select name="tipoUsuarios" id="slcTipoUsuarios" disabled="true">
<?php 		
							if($strTipoUsuario==1){		
							$result = $c_funciones->getTipoUsuarios();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '">' . $row[1] . '</option>';
							}
							}		
							else{
							$result = $c_funciones->getTipoUsuarios2();
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '">' . $row[1] . '</option>';
							}							
							}			
?>							
						</select>	
					</div>													
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtPassword">Nuevo Password</label>
						<input  type="password" name="txtPassword" id="txtPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtConfPassword">Confirmar Nuevo password</label>
						<input type="password" name="txtConfPassword" id="txtConfPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
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
			<center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageExito" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeExito" align="center"></p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" /></center>
            <a href="../Usuarios/modificarInfoUsuario.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
           </article>
</div>

</body>
	<script type="text/javascript">
	$(function(){
		
		$("#lstUsuario").change(function(){
			CargarInfo();
		});

		function CargarInfo(){

			strUsr = $("#lstUsuario option:selected").val();
			if(strUsr == -2){

				$("#mensaje").text("Debes elegir un usuario válido");

				$.mobile.changePage('#pageWarning', 'pop', true, true);
				$("#txtNombre").val("");
				$("#txtApellido").val("");
				$("#txtPassword").val("");
				return false;				


			}
			else{
	                $.ajax({
		                  type: "POST",
		                  url: "../funcionesAjax.php",
		                  data: {nombreMetodo: "obtenerInfoUsuario", AjxPUser: strUsr},
		                  contentType: "application/x-www-form-urlencoded",
		                  beforeSend: function(){

		                  },
		                  dataType: "html",
		                  success: function(msg){
		                  	 var recoge=msg.split(",");

		                    	$('#txtNombre').val(recoge[1]);
								$('#txtApellido').val(recoge[2]);
								$("#slcTipoUsuarios").val(recoge[5]);
								$('#slcTipoUsuarios').selectmenu('refresh');
		                  }              
	                });				
			}

		}

		$("#botonGuardar").click(function(){
			Validar();
		});

		function Validar(){
			strUsr = $("#lstUsuario option:selected").val();
			nombre = $("#txtNombre").val();
			apellido = $("#txtApellido").val().trim();
			pass = $("#txtPassword").val().trim();
			if(strUsr == -2){

				$("#mensaje").text("Debes elegir un usuario valido");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;				


			}			
			if($('#txtNombre').val().trim()  == ""){
				
				$("#mensaje").text("Debes ingresar el nombre de usuario");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;
			}
			else if($('#txtApellido').val().trim() == ""){

				$("#mensaje").text("Debes ingresar el apellido de usuario");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;				
			}	
			else if($('#txtPassword').val().trim() == ""){

				$("#mensaje").text("Debes ingresar password de usuario");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;						
			}			
			else if($('#txtConfPassword').val().trim() == ""){

				$("#mensaje").text("Debes ingresar la confirmacion de password de usuario");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;					
			}	
			else if($('#txtPassword').val().trim() != $('#txtConfPassword').val().trim()){

				$("#mensaje").text("Los Password No coinciden");
				$.mobile.changePage('#pageWarning', 'pop', true, true);
				return false;					
			}
			else{


				//va a insertar
                      $.ajax({
	                        type: "POST",
	                        url: "../funcionesAjax.php",
	                        data: {nombreMetodo: "modificarInfoUsuario", AjxNombre: nombre, AjxApellido: apellido, AjxPassword: pass, AjxUsuario: strUsr},
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