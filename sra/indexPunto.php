<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}
		
$strTipoUsuario=$_SESSION["TipoUsuario"];
try {
	unset($_SESSION['arrAmenazasSRAActual']);
	unset($_SESSION["idEvalSraActual"]);
	unset($_SESSION["JsonPaso1SRA"]);
} catch (Exception $e) {
	
}
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("SRA - Inicio", 
	'
<style>
  .panel-content {
    padding: 1em;
  }
  </style>
</script>

</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
'); 

?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST SRA"); ?>
		<div role="main" class="ui-content">
			<form action="lstAmenazas.php" method="POST" data-ajax="false">
				<div class="ui-body ui-body-a ui-corner-all">
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="lstPais" >País</label>
						<select name="lstPais" id="lstPais">
							<option value="-2">Elegir un país</option>
							<?php 				
								if($strTipoUsuario==1){	
									$result = $c_funciones->getListaPaises();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}							
								}
								else{
										$result = $c_funciones->getListaPaisesAsignados($idUsuario);
										while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
											echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
										}
								}
																
							?>
						</select>
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="lstPuntoEvaluacion" >Punto de evaluación</label>
						<select name="lstPuntoEvaluacion" id="lstPuntoEvaluacion">						
						</select>
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtFecha" >Fecha</label>
						<input type="date" name="txtFecha" id="txtFecha">					
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtCreador" >Elaborado por</label>
						<input type="text" name="txtCreador" id="txtCreador" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<input type="submit" id="btnCrearEval" data-theme="a" name="btnCrearEval" value="Crear evaluación" class="ui-btn-hidden" aria-disabled="false"/>
				</div>
			</form>			
		</div>
		<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
	<?php echo $c_funciones->getFooterNivel2(); ?>		

	</div>		


	<script type="text/javascript">
	//txtFecha
	$(function(){
		$("#txtFecha").datepicker();
	});

	$("#lstPais").change(function(){
		var idPais = $(this).val();
		if(idPais == "-2"){
			swal("Advertencia", "Debe elegir un país", "warning");
			return false;
		}

		$.ajax({
			type: "POST",
			url: "../funcionesAjax.php",
			data: {
				nombreMetodo: "getPtosEval",
				AjxPPais: idPais
			},
			beforeSend: function () {
					//$("#modalCargando").modal("show");
					$("#respuesta").text("Creando usuario...");
				},
				success: function (datos) {					
					$("#lstPuntoEvaluacion").html("");
					$("#lstPuntoEvaluacion").html(datos);
					$('#lstPuntoEvaluacion option:eq(0)').prop('selected', true);
					$('#lstPuntoEvaluacion').selectmenu('refresh');
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide");
					alert(error);
				}
			});
	});


	function openModalCargando(){
		swal({
			title: "Cargando...",			
			imageUrl: "../css/images/ajax-loader.gif"			
		});
		$(".confirm").css("display", "none");
	}

	function closeModalCargando(){
		$(".confirm").click();
	}

</script>
</body>
</html>