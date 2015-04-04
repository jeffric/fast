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
<?php echo $c_funciones->getHeaderNivel2("CRR", 
	'  <style>
	.panel-content {
		padding: 1em;
	}
</style>'); ?>
<body>
	<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST CRR Punto de evaluaci&oacute;n"); ?>
		<div role="main" class="ui-content">			
			<div class="ui-body ui-body-a ui-corner-all">

				<form action="EvaluarCRR.php" method="POST" data-ajax="false">

					<div class="ui-body ui-body-a ui-corner-all">
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="lstPais" >Pa&iacute;ses</label>
							<select name="lstPais" id="lstPais">
								<option value="-2">Elegir un pa&iacute;s</option>
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
							<label for="lstPuntoEvaluacion" >Punto de evaluaci&oacute;n</label>
							<select name="lstPuntoEvaluacion" id="lstPuntoEvaluacion">						
							</select>
						</div>					
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="Fecha" >Fecha</label>
							<input type="date" name="Fecha" id="Fecha" value="" data-role="date" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">					
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="ElaboradoPor" >Elaborado por</label>
							<input type="text" name="ElaboradoPor" id="ElaboradoPor" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<input type="submit" id="btnCrearEval" data-theme="a" name="btnCrearEval" value="Crear evaluación" class="ui-btn-hidden" aria-disabled="false"/>
						</div>
					</div>
					<input type="hidden" value="2" name="TipoObjeto" id="TipoObjeto" />
					<input type="hidden" value="" name="Punto" id="Punto" />
					<input type="hidden" value="" name="NPunto" id="NPunto" />

				</form>	

			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
	</div>

<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeWarning" align="center"></p>
      <center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
      <br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>	
	<script type="text/javascript">
		$("#lstPais").change(function(){
			var idPais = $(this).val();
			if(idPais == "-2"){
						   
						   $("#mensajeWarning").text("Debes elegir un país valido");    
		                  $.mobile.changePage('#pageWarning', 'pop', true, true);

				$("#lstPuntoEvaluacion").html("<option value='-2'>Elegir un punto de evaluación</option>");
				$('#lstPuntoEvaluacion option:eq(0)').prop('selected', true);
				$('#lstPuntoEvaluacion').selectmenu('refresh');
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

		$("#lstPuntoEvaluacion").change(function(){
			var valor = $(this).val();
			var texto = $("#lstPuntoEvaluacion option:selected").text();			
			$("#Punto").val(valor);
			$("#NPunto").val(texto);
		});		

	</script>
</body>	
</html>