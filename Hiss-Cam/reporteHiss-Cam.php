
<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Reporte HISS-CAM", 
	'  <style>
	.panel-content {
		padding: 1em;
	}
</style>'); ?>
<body>
	<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Reporte HISS-CAM"); ?>
		<div role="main" class="ui-content">
			

			<?php 
			//comentario
			if(isset($_GET["idRepo"])){
				try {
					$idReporteHiss = $_GET["idRepo"];
					$strHtmlReporte = '';
					$result = $c_funciones->getHtmlReporteHISSCAM($idReporteHiss);
					while($row = mysqli_fetch_array($result, MYSQL_NUM)){
						if(is_null($row[0])){
							$strHtmlReporte = '<center><h1>No se ha encontrado el reporte solicitado</h1></center>';
						}else{
							$strHtmlReporte = $row[0];
						}						
						break;
					}
					if($strHtmlReporte == ''){
						echo '<center><h1>No se ha encontrado el reporte solicitado</h1></center>';	
					}else{
						echo $strHtmlReporte;
					}					
				} catch (Exception $e) {
					echo '<center><h1>No se ha encontrado el reporte solicitado</h1></center>';	
				}
			}else{
				echo '<center><h1>No se ha encontrado el reporte solicitado</h1></center>';
			}
			?>
			<div role="main" class="ui-content">
				<?php  
				echo '<input type="hidden" id="hdRep" value="' . $_GET["idRepo"] . '" />';
				?>
				<div data-role="fieldcontain">
					<label for="txtDescripcion">Lista de correos (correos separados por comas):</label>
					<textarea cols="40" rows="8" name="txtCorreos" id="txtCorreos" placeholder="Ej: cordonez@vm.com, jp@vm.com, jfuentes@gmail.com, lbarrios@gmail.com..."></textarea>
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<center><a id="btnCorreo" data-theme="a" href="#" name="btnEvaluar" class="ui-btn-hidden" aria-disabled="false">Enviar por correo</a></center>
				</div>
			</div>
			<script type="text/javascript">
				$("#btnCorreo").click(function(){
					var correos = $("#txtCorreos").val();
					var idRep = $("#hdRep").val();
					var estilo = $("style").text();
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
						dd='0'+dd
					} 

					if(mm<10) {
						mm='0'+mm
					} 

					today = dd+'/'+mm+'/'+yyyy;					
					$.ajax({
						type: "POST",
						url: "../funcionesAjax.php",
						data: {                   
							nombreMetodo: "sendGMail",
							mails: correos,							
							AjxIDReporte : <?php echo $idReporteHiss; ?>,
							AjxTipoReporte: 4,
							Asunto: "Visión Mundial - Reporte Hiss-Cam"
						},
						beforeSend: function () {
					//$("#modalCargando").modal("show");                       
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					alert(datos);
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide"); 
					alert(error);
				}
			});
				});
			</script>

			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
			<?php echo $c_funciones->getFooterNivel2(); ?>	
		</div>

	</body>
	</html>