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

?>
<!DOCTYPE html>
<?php echo $c_funciones->getHeaderNivel2("Creación de usuarios", 
	'<style>
	  	.panel-content {
	    	padding: 1em;
	  	}
 	</style>'); 
?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Usuarios"); ?>
		<div role="main" class="ui-content">
					<p align="center"><strong>CREACIÓN DE USUARIOS</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="txtNombre" >Nombre(s) de usuario</label>
								<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
							</div>

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="txtApellido" >Apellido(s) de usuario</label>
								<input type="text" name="txtApellido" id="txtApellido" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
							</div>

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="txtCorreo" title="Este será el campo con el que se ingresará en el login de la aplicación.">Correo de usuario</label>
								<input type="text" name="txtCorreo" id="txtCorreo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
							</div>					

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="lstPais" >País del usuario</label>
								<select name="lstPais" id="lstPais">
<?php 	
									if($strTipoUsuario==1){			
											$result = $c_funciones->getListaPaises();					
											while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
												echo'
													<option value="'. $row[0] . '">' . $row[1] . '</option>';
											}
									}
									else{
											$idUsuario = $c_funciones->getIdUsuario($strUsuario);
											$result = $c_funciones->getListaPaisesAsignados($idUsuario);
											while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
													echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
											}							
									}
?>
							
							</select>	
							</div>

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="slcTipoUsuarios" >Tipo de usuario</label>
								<select name="tipoUsuarios" id="slcTipoUsuarios">
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
								<label for="txtPassword">Password</label>
								<input type="password" name="txtPassword" id="txtPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
							</div>

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<label for="txtConfPassword">Confirmar password</label>
								<input type="password" name="txtConfPassword" id="txtConfPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
							</div>

							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<p id="respuesta"></p>
							</div>

							<button id="btnCrearUsuario"  name="submit" value="submit-value"  aria-disabled="false">Agregar usuario</button>
	

				</div>								
			
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
			<?php echo $c_funciones->getFooterNivel2(); ?>					
</div>
<div id="pageMensaje" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Error</h1>
            <article data-role="content">
            <p id="mensaje"></p>
			<center><img src="../img/error.png" style="width:55%; height:55%; margin-top:1px;" />   
			<br>        
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center> 
           </article>
</div>	
<div id="pageExito" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeExito"></p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="../Usuarios/index.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

				
<script type="text/javascript">

	$(function(){
		//clic para crear usuarios
		$("#btnCrearUsuario").click(function(){
			CUsr();
		});
	});


	function CUsr(){
			var strNmUsr;
			var strApllUsr;
			var strCorrUsr;
			var strPssUsr;
			var strCnfPssUsr;
			var strTpoUsr;
			var strPais;

			strNmUsr = $("#txtNombre").val();
			strApllUsr = $("#txtApellido").val();
			strCorrUsr = $("#txtCorreo").val();
			strPssUsr = $("#txtPassword").val();
			strCnfPssUsr = $("#txtConfPassword").val();
			strTpoUsr = $("#slcTipoUsuarios option:selected").val();
			strPais = $("#lstPais option:selected").val();

			if(strNmUsr == ""){
				
				$("#mensaje").text("No debe dejar el campo nombre vacío.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;
			}

			if(strApllUsr == ""){

				$("#mensaje").text("No debe dejar el campo apellido vacío.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;
			}

			if(strCorrUsr == ""){

				$("#mensaje").text("No debe dejar el campo correo vacío.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;				
			}

			if(strPssUsr == ""){

				$("#mensaje").text("No debe dejar el campo password vacío.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;					
			}

			if(strCnfPssUsr == ""){

				$("#mensaje").text("No debe dejar la confirmación de password vacío.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;					
			}

			if(strPssUsr != strCnfPssUsr){

				$("#mensaje").text("Los passwords no coinciden.");
				$.mobile.changePage('#pageMensaje', 'pop', true, true);
				return false;					

			}


		$.ajax({
					type: "POST",
					url: "../funcionesAjax.php",
					data: {
							nombreMetodo: "CUsr",
							AjxPNombre: strNmUsr,
							AjxPApellido: strApllUsr,
							AjxPCorreo: strCorrUsr,
							AjxPPassword: strPssUsr,
							AjxPTipoUser: strTpoUsr,
							AjxPPais: strPais
					},
					beforeSend: function () {

							$("#respuesta").text("Creando usuario...");
					},
					success: function (datos) {

							$("#respuesta").text("");					
							$("#mensajeExito").text(datos);
							$.mobile.changePage('#pageExito', 'pop', true, true);

					},
					error: function (objeto, error, objeto2) {
							
							alert(error);
					}
			});
	}
</script>

</body>
</html>