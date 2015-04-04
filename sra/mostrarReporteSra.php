<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);
$idReporte = $_GET["idReporte"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Reportes CRR", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST CRR"); ?>
		<div role="main" class="ui-content">
				<div class="ui-body ui-body-a ui-corner-all">

<?php

				$result=$c_funciones->getReporteSra($idReporte);

				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
							$HtmlReporte=$row[2];				
						}
					echo $HtmlReporte;	
?>
					
				</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>
</body>
<script>
</script>
</html>