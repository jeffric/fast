<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$esPuntoEvaluacion = false;
		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}
		
//recogemos datos de la pagina anterior: Pais, Punto de evaluacion, fecha, y elaborado por.
		$idPuntoEvaluacion = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$idUsuario = $_SESSION["idUsuario"];
	$idPais = $_POST["lstPais"];
	if(isset($_POST["lstPuntoEvaluacion"])){
		$idPuntoEvaluacion = $_POST["lstPuntoEvaluacion"];
		$esPuntoEvaluacion = true;
	}else{
		$esPuntoEvaluacion = false;
	}
	$FechaElaboracion = $_POST["txtFecha"];
	$strElaboradoPor = $_POST["txtCreador"];

	if($esPuntoEvaluacion){
		$idEvaluacion = $c_funciones->CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, $idPuntoEvaluacion);	
	}else{
		$idEvaluacion = $c_funciones->CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, -1, $idPais);	
	}
	$_SESSION["idEvalSraActual"] = $idEvaluacion;
}

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Amenazas", 

	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>

	');
?>

<style>

	/* Add alternating row stripes */
	.table-stripe tbody tr:nth-child(odd) td,
	.table-stripe tbody tr:nth-child(odd) th {
		background-color: rgba(0,0,0,0.04);
	}

	/* These apply across all breakpoints because they are outside of a media query */
	/* Make the labels light gray all caps across the board */
	.movie-list thead th,
	.movie-list tbody th .ui-table-cell-label,
	.movie-list tbody td .ui-table-cell-label {
		text-transform: uppercase;
		
		color: rgba(0,0,0,0.5);
		font-weight: bold;
	}
	/* White bg, large blue text for rank and title */
	.movie-list tbody th {
		font-size: 1.2em;
		background-color: #fff;
		color: #77bbff;
		text-align: center;
	}
	/*  Add a bit of extra left padding for the title */
	.movie-list tbody td.title {
		padding-left: .8em;
	}
	/* Add strokes */
	.movie-list thead th {
		border-bottom: 1px solid #d6d6d6; /* non-RGBA fallback */
		border-bottom: 1px solid rgba(0,0,0,.1);
	}
	.movie-list tbody th,
	.movie-list tbody td {
		border-bottom: 1px solid #e6e6e6; /* non-RGBA fallback  */
		border-bottom: 1px solid rgba(0,0,0,.05);
	}
	/*  Custom stacked styles for mobile sizes */
	/*  Use a max-width media query so we dont have to undo these styles */
	@media (max-width: 40em) {
		/*  Negate the margin between sections */
		.movie-list tbody th {
			margin-top: 0;
			text-align: left;
		}
		/*  White bg, large blue text for rank and title */
		.movie-list tbody th,
		.movie-list tbody td.title {
			display: block;
			font-size: 1.2em;
			line-height: 110%;
			padding: .5em .5em;
			background-color: #fff;
			color: #77bbff;
			-moz-box-shadow: 0 1px 6px rgba(0,0,0,.1);
			-webkit-box-shadow: 0 1px 6px rgba(0,0,0,.1);
			box-shadow: 0 1px 6px rgba(0,0,0,.1);
		}
		/*  Hide labels for rank and title */
		.movie-list tbody th .ui-table-cell-label,
		.movie-list tbody td.title .ui-table-cell-label {
			display: none;
		}
		/*  Position the title next to the rank, pad to the left */
		.movie-list tbody td.title {
			margin-top: -2.1em;
			padding-left: 2.2em;
			border-bottom: 1px solid rgba(0,0,0,.15);
		}
		/*  Make the data bold */
		.movie-list th,
		.movie-list td {
			font-weight: bold;
		}
		/* Make the label elements a percentage width */
		.movie-list td .ui-table-cell-label,
		.movie-list th .ui-table-cell-label {
			min-width: 20%;
		}
	}
	/* Media query to show as a standard table at wider widths */
	@media ( min-width: 40em ) {
		/* Show the table header rows */
		.movie-list td,
		.movie-list th,
		.movie-list tbody th,
		.movie-list tbody td,
		.movie-list thead td,
		.movie-list thead th {
			display: table-cell;
			margin: 0;
		}
		/* Hide the labels in each cell */
		.movie-list td .ui-table-cell-label,
		.movie-list th .ui-table-cell-label {
			display: none;
		}
	}
	/* Hack to make IE9 and WP7.5 treat cells like block level elements */
	/* Applied in a max-width media query up to the table layout breakpoint so we dont need to negate this */
	@media ( max-width: 40em ) {
		.movie-list td,
		.movie-list th {
			width: 100%;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			float: left;
			clear: left;
		}
	}
</style>

'); ?>
<body>
	<?php 
	if(isset($_SESSION["idEvalSraActual"])){
		if(is_numeric($_SESSION["idEvalSraActual"])){
			//$_SESSION["idEvalSraActual"] = $idEvaluacion;
		}else{
			echo '
			<script type="text/javascript">
				$(function(){
					setTimeout(function() {
						swal({   
							title: "Advertencia",   
							text: "La evaluacion SRA no se ha podido crear. Se le redireccionara para crear una nueva evaluacion SRA.",   
							type: "warning",   
							showCancelButton: false,   
							confirmButtonColor: "#DD6B55",   
							confirmButtonText: "Aceptar",   
							cancelButtonText: "",   
							closeOnConfirm: false,   
							closeOnCancel: false 
						}, 
						function(isConfirm){   
							if (isConfirm) {     
								window.location = "index.php";
							} 
							else {     
								window.location = "index.php";
							} 
						});
					}, 100);
				});	
			</script>
				';
		}
	}else{
		echo '
			<script type="text/javascript">
				$(function(){
					setTimeout(function() {
						swal({   
							title: "Advertencia",   
							text: "La evaluacion SRA no se ha podido crear. Se le redireccionara para crear una nueva evaluacion SRA.",   
							type: "warning",   
							showCancelButton: false,   
							confirmButtonColor: "#DD6B55",   
							confirmButtonText: "Aceptar",   
							cancelButtonText: "",   
							closeOnConfirm: false,   
							closeOnCancel: false 
						}, 
						function(isConfirm){   
							if (isConfirm) {     
								window.location = "index.php";
							} 
							else {     
								window.location = "index.php";
							} 
						});
					}, 100);
				});	
			</script>
				';
	}	
?>
<div data-role ="page" id="page">
	<?php $c_funciones->getHeaderPageNivel2("FAST Amenazas"); ?>
	<div role="main" class="ui-content">	
		<form action="frmEvaluarAmenazas.php" method="POST" data-ajax="false">
			<div class="ui-body ui-body-a ui-corner-all">
			<table data-role="table"id="movie-table-custom" data-mode="reflow" class="movie-list table-stripe">
				<thead>
					<tr>

						<th style="width:10%">Amenaza</th>	
						<th style="width:90%">Descripción</th>	
					</tr>
				</thead>
				<tbody>
					<?php 				
					$result = $c_funciones->getAmenazas();
					$row_cnt = mysqli_num_rows($result);
					if($row_cnt <= 0){
						echo '<script type="text/javascript">								
						$(function(){
							setTimeout(function() {
								mostrarMensaje("Advertencia","No existen amenazas por mostrar.","warning");
							}, 100);
});
</script>';
}
while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
	echo '<tr>';
	echo '	<td><label for="chk'. $row[0] . '">'. $row[1] . '</label>';
	echo '	<input type="checkbox" name="chkAmenazas[]" id="chk'. $row[0] . '" value="' . $row[0] . '"/></td>';
	echo '	<td style="vertical-align: middle;"><label>'. $row[2] . '</label></td>';
	echo '</tr>';
}					
?>					
</tbody>
</table>	
<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
	<input type="submit" id="btnAgregarAmenazas" data-theme="a" name="submit" value="Evaluar" class="ui-btn-hidden" aria-disabled="false"/>
</div>	
</form>
</div>
</div>
<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
<?php echo $c_funciones->getFooterNivel2(); ?>		

</div>		


<script type="text/javascript">
	$("#btnAgregarAmenazas").click(function(){
		swal({   
			title: "Amenazas",   
			text: "Amenazas agregadas exitosamente.",
			type: "success",
			showCancelButton: false,
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Aceptar",
			closeOnConfirm: false
		}, 
		function(){   
			window.location= "www.google.com";
		});
	});
</script>
</body>
</html>