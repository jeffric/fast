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
<?php echo $c_funciones->getHeaderNivel2("Buscar Reporte CSR Punto Evaluación", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Buscar Reporte CSR"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>Puntos de Evaluación</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">

					BUSCAR:
					<input id="filterTable-input" data-type="search">
						<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive">
						    <thead>
						        <tr>
						            <th data-priority="1">idReporte</th>
						            <th data-priority="persist">Fecha</th>
						            <th data-priority="2">Nombre Punto de Evaluación</th>
						            <th data-priority="3">País</th>
						            <th data-priority="4">Creador</th>
						        </tr>
						        </thead>
						        <tbody>

<?php

								$result = $c_funciones->getReportesCsrPtos($strTipoUsuario,$idUsuario);
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo '<tr>';
										echo '<th>'.$row[0].'</th>';
										echo '<td>'.$row[1].'</td>';
										echo '<td><a href=mostrarReporteCsr.php?idReporte='.$row[0].' data-ajax="false">'.$row[5].'</a></td>';
										echo '<td>'.$row[3].'</td>';		
										echo '<td>'.$row[4].'</td>';									
										echo '</tr>';			
									}
?>						        	

						        </tbody>
						    </table>	
					
				</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>
</body>
<script>
</script>
</html>