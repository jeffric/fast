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
		<?php $c_funciones->getHeaderPageNivel2("FAST CRR Pa&iacute;s"); ?>
		<div role="main" class="ui-content">			
			<div class="ui-body ui-body-a ui-corner-all">

				<form action="EvaluarCRR.php" method="POST" data-ajax="false">

					<div class="ui-body ui-body-a ui-corner-all">
				<p align="center"><strong>Seleccione el Pais que desea evaluar </strong><br />								

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="lstPais" >Pa&iacute;ses</label>
							<select name="lstPais" id="lstPais">
								<?php
								if($strTipoUsuario==1){	
									$result = $c_funciones->getListaPaises();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo '<option value="'. $row[0] . '">' . $row[1] . '</option>';
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
					<input type="hidden" value="0" name="TipoObjeto" id="TipoObjeto" />
					<input type="hidden" value="" name="Pais" id="Pais" />
					<input type="hidden" value="" name="NPais" id="NPais" />

				</form>	

			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
			var valor = $(this).val();
			var texto = $("#lstPais option:selected").text();
			$("#Pais").val(valor);
			$("#NPais").val(texto);
		$("#lstPais").change(function(){
			var valor = $(this).val();
			var texto = $("#lstPais option:selected").text();
			$("#Pais").val(valor);
			$("#NPais").val(texto);
		});

	});
	</script>
</body>	
</html>