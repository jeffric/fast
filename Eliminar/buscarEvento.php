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
<?php echo $c_funciones->getHeaderNivel2("Buscar Evento", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>'); ?>

<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Eventos"); ?>
		<div role="main" class="ui-content">
				<div class="ui-body ui-body-a ui-corner-all">
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<p align="center"><strong>Seleccione el Evento que desea eliminar</strong><br />		
						<ul data-role="listview" data-filter="true" data-ajax="false">
<?php 				
							$result = $c_funciones->getListaEventos();			
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
							echo'
							<li><a href=../Eliminar/eliminarEvento.php?idEvento='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li>';
							}					
?>						</ul>
					</div>		
				</div>
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
			<?php echo $c_funciones->getFooterNivel2(); ?>		
</div>		
</body>
</html>