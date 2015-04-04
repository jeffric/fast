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
<?php echo $c_funciones->getHeader("Visión", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPage("FAST"); ?>
		<div role="main" class="ui-content">
				<div class="ui-body ui-body-a ui-corner-all">
<h2>VISIÓN</h2>

"Nuestra Visión para cada niño y niña, vida en toda su plenitud, nuestra oración para cada corazón, la voluntad para hacer esto posible".
					
				</div>

				<div class="ui-body ui-body-a ui-corner-all">
<h2>NUESTRA CAUSA</h2>

"Una niñez protegida promotora de una sociedad más justa y segura".
					
				</div>				
		</div>
		<?php echo $c_funciones->getMenu($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooter(); ?>	
</div>
</body>
<script>
</script>
</html>