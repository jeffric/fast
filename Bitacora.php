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
<?php echo $c_funciones->getHeader("Bit&aacute;cora de uso", 
	'<style>
	.panel-content {
		padding: 1em;
	}
</style>'); ?>
<body>
	<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPage("FAST Bit&aacute;cora de uso"); ?>
		<div role="main" class="ui-content">			
			<div class="ui-body ui-body-a ui-corner-all">
				<p align="center"><strong>Bit&aacute;cora de uso</strong><br />
					<div class="ui-body ui-body-a ui-corner-all">

						BUSCAR:
						<input id="filterTable-input" data-type="search">
						<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive">
							<thead>
								<tr>
									<th width="20%" data-priority="1">Usuario</th>
									<th width="60%"data-priority="2">Acci&oacute;n</th>
									<th width="20%" data-priority="3">Fecha/Hora</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									echo $c_funciones->ConsultarBitacoraHtml();
								?>
							</tbody>
						</table>	

					</div>
				</div>
			</div>
			<?php echo $c_funciones->getMenu($strTipoUsuario); ?>			
			<?php echo $c_funciones->getFooter(); ?>	
		</div>
		<script>
		</script>
	</body>
	</html>