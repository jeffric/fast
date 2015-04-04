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
<?php echo $c_funciones->getHeaderNivel2("Asignación de usuarios", 
	'<style>
	  .panel-content {
	    padding: 1em;
	  }
  </style>'); 
?>
<body>
<div data-role="page" id="page">
	<?php $c_funciones->getHeaderPageNivel2("FAST Asignación"); ?>
		<div div role="main" class="ui-content">
				<p align="center"><strong>ASIGNACIÓN USUARIO-PAIS</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtusuario" >Usuario</label>
							<select name="lstUsuario" id="lstUsuario">
								<option value="-2">Elegir un usuario</option>
<?php 	
								if($strTipoUsuario==1){			
										$result = $c_funciones->getListaUsuariosNoSuper($idUsuario);					
										while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
												echo'
												<option value="'. $row[0] . '">' . $row[1] . '</option>';
											
										}
								}
								else{
										$result = $c_funciones->getListaUsuarios2($idUsuario);					
										while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
												echo'
												<option value="'. $row[0] . '">' . $row[1] . '</option>';
										}						
									}
?>
						
							</select>
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
													echo'
													<option value="'. $row[0] . '">' . $row[1] . '</option>';
											}							
									}
?>
						
								</select>	
						</div>

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<p id="respuesta"></p>
						</div>					
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<button id="btnAsignarUsuario" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Asignar usuario</button>
						</div>					
				</div>						
	</div>
	<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
	<?php echo $c_funciones->getFooterNivel2(); ?>		

</div>	

<div id="pageMensaje" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
			<center><img src="../img/mensaje.png" style="width:55%; height:55%; margin-top:1px;" /> 
			<br>           
            <a href="../Usuarios/asignarUsuarioP.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center">Debes elegir un usuario válido</p>
			<center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>
<script type="text/javascript">
	$(function(){

		$("#btnAsignarUsuario").click(function(){
			asignarUsuarioP();
		});

	});


	function asignarUsuarioP(){
		var strUsr;
		var strPais;

		strUsr = $("#lstUsuario option:selected").val();
		strPais = $("#lstPais option:selected").val();
		if(strUsr==-2){

			$.mobile.changePage('#pageWarning', 'pop', true, true);
			return false;	

		}
		else{
				$.ajax({
					type: "POST",
					url: "../funcionesAjax.php",
					data: {
							nombreMetodo: "asignarUsuarioP",
							AjxPUser: strUsr,
							AjxPPais: strPais
						  },
					beforeSend: function () {		

							$("#respuesta").text("Asignando usuario...");
							},
					success: function (datos) {

							$("#respuesta").text("");
							$("#mensaje").text(datos);		
							$.mobile.changePage('#pageMensaje', 'pop', true, true);
							return false;									

							},
					error: function (objeto, error, objeto2) {
							
							alert(error);
						}
					});
		}
	}
</script>		
</body>
</html>