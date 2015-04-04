<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Blank", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPage("FAST Blank"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>BLANK</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">

					<?php


					?>
					
				</div>
		</div>
		<?php echo $c_funciones->getMenu($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooter(); ?>	
</div>
</body>
<script>
</script>
</html>