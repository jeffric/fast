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
<html>
<?php echo $c_funciones->getHeaderNivel2("Buscar Punto de Evaluación", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>  
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>  $(function() {    $( "#txtFecha" ).datepicker({dateFormat: "yy-mm-dd"});  });  </script>'); ?>

    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST CSR"); ?>
		<div role="main" class="ui-content">
		<form action="realizarEvaluacion.php" method="POST" data-ajax="false" >
			<p align="center"><strong>Seleccione el Punto de Evaluación que desea evaluar CSR</strong><br />		
				<div class="ui-body ui-body-a ui-corner-all">
						<select name="lstPuntos" id="lstPuntos">
							<?php 				

									$result = $c_funciones->getListaPtosEvaluacion($idPais);
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
			<p align="center"><strong>Seleccione el nivel de riesgo para ese punto CSR</strong><br />						
						<select name="lstNivelRiesgo" id="lstNivelRiesgo">
							<?php 				

									$result = $c_funciones->getNivelRiesgo();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
				
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				 Fecha:
				 <input type="text" id="txtFecha" name="txtFecha">
				<input type="submit" id="botonEvaluar" data-theme="a" name="submit" value="Iniciar Evaluación" class="ui-btn-hidden" aria-disabled="false"/>
				</div>							

				</div>									
	</form>





		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>

	</html>