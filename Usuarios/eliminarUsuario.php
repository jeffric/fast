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
<?php echo $c_funciones->getHeaderNivel2("Eliminación de usuarios", 
	'<style>
	  .panel-content {
	    padding: 1em;
	  }
    </style>'); ?>
<body>
<div data-role="page" id="page">
	<?php $c_funciones->getHeaderPageNivel2("FAST Eliminación"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>ELIMINACIÓN DE USUARIO</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">
						<label for="lstUsuario" >Usuario</label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elegir un usuario</option>
<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaUsuarios($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaUsuarios2($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '" >' . $row[1] . '</option>';
								}						
							}
?>						
						</select>	
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<button id="botonEliminar" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Eliminar Usuario</button>
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

<div id="pagePregunta" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajePregunta" align="center">Este Usuario será eliminado, toda información relacionada a el, tambien será eliminada del sistema.</p>
			<center>
			<img src="../img/interrogacion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="botonConfirmar" data-rel="back">Confirmar</a>
            <a href="#" data-role="button" id="botonCancelar" data-rel="back">Cancelar</a>
            </center>
           </article>
</div>

<div id="pageEliminado" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeEliminado" align="center">El usuario fue eliminado exitosamente</p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>				
            <a href="../Usuarios/eliminarUsuario.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageCancelado" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeExito" align="center">La acción ha sido Cancelada</p>
			<center>
			<img src="../img/error.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="../Usuarios/eliminarUsuario.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

</body>
<script>
       $(document).ready(function(){

            $('#botonEliminar').click(function(){

            	strUsr = $("#lstUsuario option:selected").val();
				if(strUsr==-2){

					$("#mensaje").text("Debes elegir un usuario válido");
					$.mobile.changePage('#pageWarning', 'pop', true, true);
					return false;	

				}
				else{

						$.mobile.changePage('#pagePregunta', 'pop', true, true);						
	            }

       	  });
			
			$("#botonConfirmar").click(function(){
					$.ajax({

							type: "POST",
							url: "../funcionesAjax.php",
							data: {nombreMetodo: "eliminarUsuario", AjxPUser:$("#lstUsuario option:selected").val() },
							contentType: "application/x-www-form-urlencoded",
							beforeSend: function(){
		
		                   },
		                    dataType: "html",
		                    success: function(msg){     
							$.mobile.changePage('#pageEliminado', 'pop', true, true);
							return false;		                             
	                       } 									
		
		     		});							
			});

			$("#botonCancelar").click(function(){
								
				$.mobile.changePage('#pageCancelado', 'pop', true, true);
				return false;
			});


     });
     </script>
	</html>