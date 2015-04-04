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
  </style>'); ?>

    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST MAPAS"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>Seleccione el Punto de Evaluación que desea modificar</strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">	
					<ul data-role="listview" data-filter="true" data-ajax="false">
						<?php 				
						$result = $c_funciones->getListaPtosEvaluacion($idPais);					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'<li><a href=../Modificar/modificarPtoEvaluacion.php?idPtoEvaluacion='.$row[0] .'&idPais='.$idPais.' data-ajax="false">' . $row[1] . '</a></li> ';
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