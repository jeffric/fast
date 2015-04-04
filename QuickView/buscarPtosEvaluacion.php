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
	'<script type="text/javascript">
	$(function() {
		//$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST MAPAS"); ?>
		<div class="content">
			<p><strong>Selecciones el pais, del cual desea eliminar el Punto de Evaluación</strong><br />		
			<ul data-role="listview" data-filter="true" data-ajax="false">
				<?php 				
				$result = $c_funciones->getListaPaises();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<li><a href=mostrarPtoEvaluacionPais.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
				}					
				?>
					
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>