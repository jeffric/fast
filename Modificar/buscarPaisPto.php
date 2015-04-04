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

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Buscar Punto de Evaluación", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
	<?php $c_funciones->getHeaderPageNivel2("FAST MAPAS"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>Seleccione el país, del cual desea modificar el Punto de Evaluación</strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">	
					<ul data-role="listview" data-filter="true" data-ajax="false">
<?php 	

						if($strTipoUsuario==1){			
								$result = $c_funciones->getListaPaises();					
								while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<li><a href=../Modificar/buscarPtoEvaluacion.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
								}	
						}
						else{
								$result = $c_funciones->getListaPaisesAsignados($idUsuario);					
								while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<li><a href=../Modificar/buscarPtoEvaluacion.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
								}
						}				
?>
					</ul>
				</div>					
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>					
</div>		
</body>
</html>