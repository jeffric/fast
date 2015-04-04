<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Master page Nivel 2", 
	'<script type="text/javascript">
	$(function() {
		//$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Home"); ?>
		<div class="content">
			<p><strong>CONTENIDO ACA</strong><br />				
			</div>
			<?php echo $c_funciones->getMenuNivel2(); ?>
		</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>