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
<?php echo $c_funciones->getHeaderNivel2("CRR - VM", 
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

				<div style="height: 100%; text-align: center;">
					<h1>Elegir objeto a evaluar</h1>
				</div>
				<div >
					<a href="indexPunto.php" data-ajax="false" data-role="button">Punto de evaluaci&oacute;n</a>
					<a href="indexEvento.php" data-ajax="false" data-role="button">Evento</a>
					<a href="indexPais.php" data-ajax="false" data-role="button">Pa&iacute;s</a>
				</div>

			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
	</div>
	<script type="text/javascript">
	</script>
</body>
</html>