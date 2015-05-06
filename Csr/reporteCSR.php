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

if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	$arrSelect= $_POST['select'];	
	$_SESSION["arrSelect"] =$arrSelect;
	$idNivelRiesgo =$_SESSION["idNivelRiesgo"];

	}
	else{
			header("Location: ../Csr/index.php");
			return;

	}

$idUsuario = $c_funciones->getIdUsuario($strUsuario);
$idEvaluacion =$_SESSION["idEvaluacionCsrActual"];
$result=$c_funciones->getPtoEvaluacion($_SESSION["idPuntoEvaluacion"]);
while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
	$nombrePuntoEvaluacion = $row[1];

}

$reporteHtml="";



?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluacion CSR", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">




'); ?>
<body>
<div data-role="page" id="page" >
		<?php $c_funciones->getHeaderPageNivel2("FAST CSR"); ?>
		<div role="main" class="ui-content">
			<div class="ui-body ui-body-a ui-corner-all">

<?php 
			$reporteHtml= $reporteHtml.'<p align="center"><strong>REPORTE CSR</strong><br />';
				$reporteHtml= $reporteHtml.'<p align="center">';
				$reporteHtml= $reporteHtml.'Fecha Reporte: '.$_SESSION["fechaCsr"].'</br><br>';

					if($idNivelRiesgo==1){
						$reporteHtml= $reporteHtml.'Punto Evaluación: <b>'.$nombrePuntoEvaluacion.'</b><br>';
						$reporteHtml= $reporteHtml.'Nivel de riesgo: Insignificante';

					}
					else if($idNivelRiesgo==2){
						$reporteHtml=  $reporteHtml.'Punto Evaluación: <b>'.$nombrePuntoEvaluacion.'</b><br>';
						$reporteHtml=  $reporteHtml.'Nivel de Riesgo: Bajo';

					}
					else if($idNivelRiesgo==3){
						$reporteHtml=  $reporteHtml.'Punto Evaluación: <b>'.$nombrePuntoEvaluacion.'</b><br>';
						$reporteHtml=  $reporteHtml.'Nivel de Riesgo: Medio';

					}
					else if($idNivelRiesgo==4){
						$reporteHtml=  $reporteHtml.'Punto Evaluación: <b>'.$nombrePuntoEvaluacion.'</b><br>';
						$reporteHtml=  $reporteHtml.'Nivel de Riesgo: Alto';

					}



			



		$contadorNoAplicable=0;
		$contadorNoIniciado=0;
		$contadorIniciado=0;
		$contadorCompletado=0;

		$cadenaNoAplicable='<ol>';
		$cadenaNoIniciado='<ol>';
		$cadenaIniciado='<ol>';
		$cadenaCompletado='<ol>';
	
		$cum=0;

	if(($arrSelect)){
						if(!empty($arrSelect)) {
$contador=0;
$numeracionRequerimiento=1;
								foreach($arrSelect as $option){
										if($option == '1'){
											$contadorNoAplicable = $contadorNoAplicable+1;
											$cadenaNoAplicable=$cadenaNoAplicable.'
											<br>'.$numeracionRequerimiento.")".$_POST['requerimientos'.$contador].'';										
										}
										else if($option == '2'){
											$contadorNoIniciado = $contadorNoIniciado+1;
											$cadenaNoIniciado=$cadenaNoIniciado.'
											<br>'.$numeracionRequerimiento.")".$_POST['requerimientos'.$contador].'';

										}
										else if($option == '3'){
											$contadorIniciado = $contadorIniciado+1;
											$cadenaIniciado=$cadenaIniciado.'
											<br>'.$numeracionRequerimiento.")".$_POST['requerimientos'.$contador].'';											
										}
										else{
											$contadorCompletado = $contadorCompletado+1;
											$cadenaCompletado=$cadenaCompletado.'
											<br>'.$numeracionRequerimiento.")".$_POST['requerimientos'.$contador].'';											
										}

										$contador=$contador+1;
										$numeracionRequerimiento =$numeracionRequerimiento+1;

								}

									$contadorNoAplicable = ($contadorNoAplicable/57)*100;
									$contadorNoIniciado = ($contadorNoIniciado/57)*100;
									$contadorIniciado = ($contadorIniciado/57)*100;
									$contadorCompletado = ($contadorCompletado/57)*100;

									$NA = number_format($contadorNoAplicable, 2, '.', '');
									$NOIN = number_format($contadorNoIniciado, 2, '.', '');
									$IN = number_format($contadorIniciado, 2, '.', '');
									$COM = number_format($contadorCompletado, 2, '.', '');	
									if($contadorCompletado ==0){

										$reporteHtml= $reporteHtml.'<br><b>CUMPLIMIENTO: 0%</b>';

									}
									else{
										$cum =number_format((($contadorCompletado/($contadorIniciado+$contadorNoIniciado+$contadorCompletado))*100), 2, '.', '');
									 	$reporteHtml= $reporteHtml.'<br><b>CUMPLIMIENTO:'.number_format((($contadorCompletado/($contadorIniciado+$contadorNoIniciado+$contadorCompletado))*100), 2, '.', '').'%</b>';

									}	
									$reporteHtml=  $reporteHtml.'</p>';									
									$reporteHtml=  $reporteHtml.'<table data-role="table" class="ui-responsive">';
								    $reporteHtml=  $reporteHtml.'<thead style="text-align: center;">';
								    $reporteHtml=  $reporteHtml.'		<tr style="text-align: center; background-color: #9CF; font-weight: bold;">';
								    $reporteHtml=  $reporteHtml.'            <th style="text-align: center";><font face="courier">NO APLICA</font></th>';
								    $reporteHtml=  $reporteHtml.'            <th style="text-align: center";><font face="courier">NO INICIADOS</font></th>';
								    $reporteHtml=  $reporteHtml.'            <th style="text-align: center";><font face="courier">INICIADOS</font></th>';
								    $reporteHtml=  $reporteHtml.'            <th style="text-align: center";><font face="courier">COMPLETADOS</font></th>';							    								    
								    $reporteHtml=  $reporteHtml.'   </thead>';

									$reporteHtml=  $reporteHtml.'<tbody>';

																								
									$reporteHtml=  $reporteHtml.'<tr>';
									$reporteHtml=  $reporteHtml.'<td style="text-align: center;">';
									$reporteHtml=  $reporteHtml.$NA.'%';
									$reporteHtml=  $reporteHtml.'<br>';
									$reporteHtml=  $reporteHtml.'</td>';

									$reporteHtml=  $reporteHtml.'<td style="text-align: center;">';
									$reporteHtml=  $reporteHtml.$NOIN.'%';
									$reporteHtml=  $reporteHtml.'<br>';
									$reporteHtml=  $reporteHtml.'</td>';

									$reporteHtml= $reporteHtml.'<td style="text-align: center;">';
									$reporteHtml= $reporteHtml.$IN.'%';
									$reporteHtml= $reporteHtml.'<br>';
									$reporteHtml= $reporteHtml.'</td>';

									$reporteHtml= $reporteHtml.'<td style="text-align: center;">'; 
									$reporteHtml= $reporteHtml.$COM.'%';
									$reporteHtml= $reporteHtml.'<br>';
									$reporteHtml= $reporteHtml.'</td>';

									
									$reporteHtml= $reporteHtml.'</tr>';

									$reporteHtml= $reporteHtml.'<tr style="background-color: #ddd; font-weight: bold;">';
									$reporteHtml= $reporteHtml.'<td>';
									$reporteHtml= $reporteHtml.$cadenaNoAplicable.'</ol>';
									$reporteHtml= $reporteHtml.'</td>';

									$reporteHtml= $reporteHtml.'<td>';
									$reporteHtml= $reporteHtml.$cadenaNoIniciado.'</ol>';
									$reporteHtml= $reporteHtml.'</td>';

									$reporteHtml= $reporteHtml.'<td>';
									$reporteHtml= $reporteHtml.$cadenaIniciado.'</ol>';
									$reporteHtml= $reporteHtml.'</td>';	

									$reporteHtml= $reporteHtml.'<td>';
									$reporteHtml= $reporteHtml.$cadenaCompletado.'</ol>';
									$reporteHtml= $reporteHtml.'</td>';	

									$reporteHtml= $reporteHtml.'<td>';
									$reporteHtml= $reporteHtml.'</td>';	

									$reporteHtml= $reporteHtml.'</tr>';

									$reporteHtml= $reporteHtml.'</tbody>';


									$reporteHtml= $reporteHtml.'</table>';	

									$resultado = $c_funciones->insertarReporteCsr($_SESSION["fechaCsr"], $reporteHtml, $strUsuario, $idNivelRiesgo, $_SESSION["idPuntoEvaluacion"], -1, $nombrePuntoEvaluacion );

									if($resultado>0){

											$result=$c_funciones->getReporteCsr($resultado);

																while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
																	$HtmlReporte=$row[2];				
																}
																echo $HtmlReporte;	
											
									}

										

						}
					}

	



?>
	</div>
	</div>	

			<div data-role="fieldcontain">
				<label for="txtDescripcion">Lista de correos (correos separados por comas):</label>
				<textarea cols="40" rows="8" name="txtCorreos" id="txtCorreos" placeholder="Ej: cordonez@vm.com, jp@vm.com, jfuentes@gmail.com, lbarrios@gmail.com..."></textarea>
			</div>
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a id="btnCorreo" data-role="button" href="#" name="btnEvaluar" class="ui-btn-hidden" aria-disabled="false">Enviar por correo</a>
			</div>	
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>		
				
</body>
	<script type="text/javascript">

       $(document).ready(function(){

			$("#btnCorreo").click(function(){
				var correos = $("#txtCorreos").val();
				alert(<?php echo $resultado; ?>);
			      $.ajax({
		                  type: "POST",
		                  url: "../funcionesAjax.php",
		                  data: {nombreMetodo: "sendGMail", AjxTipoReporte: 1, mails:correos, Asunto:"Visión Mundial - Reporte CRR Punto de Evaluación", AjxIDReporte:<?php echo $resultado; ?> },
		                  contentType: "application/x-www-form-urlencoded",
		                  beforeSend: function(){
		                    $('#loader_gif').fadeIn("slow");

		                  },
		                  dataType: "html",
		                  success: function(msg){
		                  		alert(msg);
		                  }  			      	
           
                });								

			});


        });       	


	</script>
	</html>