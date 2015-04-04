<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SRA - VM</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">

	<!-- Estilos -->	
	
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.4.min.css" />
	
	<!-- Estilos para menu -->
	<link type="text/css" rel="stylesheet" href="../css/menu/demo.css" />
	
	<link type="text/css" rel="stylesheet" href="../css/menu/jquery.mmenu.all.css" />
	
	<!-- <link rel="stylesheet" href="../css/css-personalizado.css" /> -->

	<!-- Scripts -->
	<script src="../js/jquery-2.1.1.js"></script>
	<script src="../js/jquery.mobile-1.4.4.min.js"></script>

	<!-- Scripts para menu -->
	<script type="text/javascript" src="../js/menu/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript">
		$(function() {
			$('nav#menu').unbind("mmenu");
			$('nav#menu').mmenu();
		});
	</script>

	<!-- for the fixed header -->
	<style type="text/css">
		.header,
		.footer
		{
			position: fixed;
			width: 100%;

			box-sizing: border-box;
		}
		.footer
		{
			bottom: 0;
		}

		th {
			border-bottom: 1px solid #d6d6d6;
		}

		tr:nth-child(even) {
			background: #e9e9e9;
		}

		/*COLORES PARA RIESGOS - VISION MUNDIAL*/

		.insignificante{
			/*color verde*/
			background-color: green;color: white;text-shadow: none;
		}

		.bajo{
			/*color amarillo*/
			background-color: rgb(236, 236, 9);color: white;text-shadow: none;
		}

		.medio{
			/*color naranja*/
			background-color: orange;color: white;text-shadow: none;	
		}

		.alto{
			/*color rojo*/
			background-color: red;color: white;text-shadow: none;
		}

		.critico{
			/*color negro*/
			background-color: black;color: white;text-shadow: none;
		}


	</style>
</head>
<body>
	<div id="page">
		<div class="header" style="z-index: 100;">
			<a href="#menu"></a>
			<div style="text-align:center;">
				FAST - SRA
			</div>
			<div style="position: absolute; right:0; top: 0;">
				<img src="../img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>
		<div class="content">
			<div data-role="header" data-theme="a" class="ui-corner-all ui-shadow" style="margin-bottom: 20px;"> 
				<h1>Test SRA</h1> 
			</div> 
			
			<div class="content">
				<table data-role="table" id="sra-table" data-mode="reflow" class="ui-responsive table-stroke ui-table ui-table-reflow">
					<thead>
						<tr>
							<th >Pregunta</th>
							<th >Riesgo</th>
							<th >Impacto</th>
							<th ><abbr title="Rotten Tomato Rating">Probabilidad</abbr></th>
							<th >Nivel de Riesgo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>1</th>
							<td><b class="ui-table-cell-label">Riesgo</b>Accidentes de tr&aacute;fico</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP1_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: green;color: white;text-shadow: none;"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP1_Impacto" class="" id="rdbP1_Impactoa" value="0" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP1_Impacto" id="rdbP1_Impactob" value="1" ></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: orange;color: black;text-shadow: none;"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP1_Impacto" id="rdbP1_Impactoc" value="2"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: red;color: black;text-shadow: none;"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP1_Impacto" id="rdbP1_Impactod" value="3"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: black;color: white;text-shadow: none;"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP1_Impacto" id="rdbP1_Impactoe" value="4"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP1_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;"style="background-color: green;color: white;text-shadow: none;">Improbable</label><input type="radio" name="rdbP1_Probabilidad" id="rdbP1_Probabilidada" value="4" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Moderadamente Probable</label><input type="radio" name="rdbP1_Probabilidad" id="rdbP1_Probabilidadb" value="3"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Probable</label><input type="radio" name="rdbP1_Probabilidad" id="rdbP1_Probabilidadc" value="2"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Muy Probable</label><input type="radio" name="rdbP1_Probabilidad" id="rdbP1_Probabilidadd" value="1"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Inminente</label><input type="radio" name="rdbP1_Probabilidad" id="rdbP1_Probabilidade" value="0"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgof" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: rgb(148, 221, 0);color: white;text-shadow: none;"style="background-color: green;color: white;text-shadow: none;">Nulo</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgof" value="5" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" style="background-color: green;color: white;text-shadow: none;"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgoa" value="0"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Bajo</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgob" value="1"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Medio</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgoc" value="2"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Alto</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgod" value="3"></div>

											<div class="ui-radio ui-mini"><label for="rdbP1_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP1_NivelDeRiesgo" id="rdbP1_NivelDeRiesgoe" value="4"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>2</th>
							<td><b class="ui-table-cell-label">Riesgo</b>Secuestro</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP2_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP2_Impacto" id="rdbP2_Impactoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP2_Impacto" id="rdbP2_Impactob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP2_Impacto" id="rdbP2_Impactoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP2_Impacto" id="rdbP2_Impactod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP2_Impacto" id="rdbP2_Impactoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP2_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP2_Probabilidad" id="rdbP2_Probabilidada" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP2_Probabilidad" id="rdbP2_Probabilidadb" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP2_Probabilidad" id="rdbP2_Probabilidadc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP2_Probabilidad" id="rdbP2_Probabilidadd" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP2_Probabilidad" id="rdbP2_Probabilidade" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP2_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP2_NivelDeRiesgo" id="rdbP2_NivelDeRiesgoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP2_NivelDeRiesgo" id="rdbP2_NivelDeRiesgob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP2_NivelDeRiesgo" id="rdbP2_NivelDeRiesgoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP2_NivelDeRiesgo" id="rdbP2_NivelDeRiesgod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP2_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP2_NivelDeRiesgo" id="rdbP2_NivelDeRiesgoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>3</th>
							<td><b class="ui-table-cell-label">Riesgo</b>Crimen Com&uacute;n</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP3_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP3_Impacto" id="rdbP3_Impactoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP3_Impacto" id="rdbP3_Impactob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP3_Impacto" id="rdbP3_Impactoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP3_Impacto" id="rdbP3_Impactod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP3_Impacto" id="rdbP3_Impactoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP3_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP3_Probabilidad" id="rdbP3_Probabilidada" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP3_Probabilidad" id="rdbP3_Probabilidadb" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP3_Probabilidad" id="rdbP3_Probabilidadc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP3_Probabilidad" id="rdbP3_Probabilidadd" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP3_Probabilidad" id="rdbP3_Probabilidade" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP3_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP3_NivelDeRiesgo" id="rdbP3_NivelDeRiesgoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP3_NivelDeRiesgo" id="rdbP3_NivelDeRiesgob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP3_NivelDeRiesgo" id="rdbP3_NivelDeRiesgoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP3_NivelDeRiesgo" id="rdbP3_NivelDeRiesgod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP3_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP3_NivelDeRiesgo" id="rdbP3_NivelDeRiesgoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>4</th>
							<td><b class="ui-table-cell-label">Riesgo</b>Fuego Cruzado</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP4_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP4_Impacto" id="rdbP4_Impactoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP4_Impacto" id="rdbP4_Impactob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP4_Impacto" id="rdbP4_Impactoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP4_Impacto" id="rdbP4_Impactod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP4_Impacto" id="rdbP4_Impactoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP4_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP4_Probabilidad" id="rdbP4_Probabilidada" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP4_Probabilidad" id="rdbP4_Probabilidadb" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP4_Probabilidad" id="rdbP4_Probabilidadc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP4_Probabilidad" id="rdbP4_Probabilidadd" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP4_Probabilidad" id="rdbP4_Probabilidade" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP4_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP4_NivelDeRiesgo" id="rdbP4_NivelDeRiesgoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP4_NivelDeRiesgo" id="rdbP4_NivelDeRiesgob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP4_NivelDeRiesgo" id="rdbP4_NivelDeRiesgoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP4_NivelDeRiesgo" id="rdbP4_NivelDeRiesgod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP4_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP4_NivelDeRiesgo" id="rdbP4_NivelDeRiesgoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>5</th>
							<td style="word-wrap: break-word"><b class="ui-table-cell-label">Riesgo</b>Desastre Natural - Evacuaci&oacute;n de edificios</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP5_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP5_Impacto" id="rdbP5_Impactoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP5_Impacto" id="rdbP5_Impactob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP5_Impacto" id="rdbP5_Impactoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP5_Impacto" id="rdbP5_Impactod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP5_Impacto" id="rdbP5_Impactoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP5_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP5_Probabilidad" id="rdbP5_Probabilidada" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP5_Probabilidad" id="rdbP5_Probabilidadb" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP5_Probabilidad" id="rdbP5_Probabilidadc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP5_Probabilidad" id="rdbP5_Probabilidadd" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP5_Probabilidad" id="rdbP5_Probabilidade" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP5_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP5_NivelDeRiesgo" id="rdbP5_NivelDeRiesgoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP5_NivelDeRiesgo" id="rdbP5_NivelDeRiesgob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP5_NivelDeRiesgo" id="rdbP5_NivelDeRiesgoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP5_NivelDeRiesgo" id="rdbP5_NivelDeRiesgod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP5_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP5_NivelDeRiesgo" id="rdbP5_NivelDeRiesgoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th><b class="ui-table-cell-label">Pregunta</b>6</th>
							<td style="word-wrap: break-word"><b class="ui-table-cell-label">Riesgo</b>Emergencia M&eacute;dica</td>
							<td><b class="ui-table-cell-label">Impacto</b>
								Emergencia M&eacute;dica
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP6_Impactoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" class="insignificante" name="rdbP6_Impacto" id="rdbP6_Impactoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Impactob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP6_Impacto" class="bajo" id="rdbP6_Impactob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Impactoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP6_Impacto" class="medio" id="rdbP6_Impactoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Impactod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP6_Impacto" class="alto" id="rdbP6_Impactod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Impactoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP6_Impacto" class="critico" id="rdbP6_Impactoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Probabilidad</b>
								Emergencia M&eacute;dica
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP6_Probabilidada" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP6_Probabilidad" id="rdbP6_Probabilidada" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Probabilidadb" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP6_Probabilidad" id="rdbP6_Probabilidadb" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Probabilidadc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP6_Probabilidad" id="rdbP6_Probabilidadc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Probabilidadd" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP6_Probabilidad" id="rdbP6_Probabilidadd" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_Probabilidade" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP6_Probabilidad" id="rdbP6_Probabilidade" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
							<td><b class="ui-table-cell-label">Nivel de riesgo</b>
								Emergencia M&eacute;dica
								<table>
									<tr>
										<td>
											<div class="ui-radio ui-mini"><label for="rdbP6_NivelDeRiesgoa" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: green;color: white;text-shadow: none;">Insignificante</label><input type="radio" name="rdbP6_NivelDeRiesgo" id="rdbP6_NivelDeRiesgoa" value="on" checked="checked"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_NivelDeRiesgob" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: rgb(236, 236, 9);color: white;text-shadow: none;">Menor</label><input type="radio" name="rdbP6_NivelDeRiesgo" id="rdbP6_NivelDeRiesgob" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_NivelDeRiesgoc" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: orange;color: black;text-shadow: none;">Moderado</label><input type="radio" name="rdbP6_NivelDeRiesgo" id="rdbP6_NivelDeRiesgoc" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_NivelDeRiesgod" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: red;color: black;text-shadow: none;">Severo</label><input type="radio" name="rdbP6_NivelDeRiesgo" id="rdbP6_NivelDeRiesgod" value="on"></div>

											<div class="ui-radio ui-mini"><label for="rdbP6_NivelDeRiesgoe" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child"style="background-color: black;color: white;text-shadow: none;">Cr&iacute;tico</label><input type="radio" name="rdbP6_NivelDeRiesgo" id="rdbP6_NivelDeRiesgoe" value="on"></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<a href="sra-summary.php" data-role="button" data-theme="b">Evaluar</a>
			</div>
		</div>
		<nav id="menu">
			<ul>
				<li><a href="../home.php">Home</a></li>
				<li><a href="../home.php">CRR</a>
					<ul>
						<li><a href="../crr/index.php">Evaluar CRR</a></li>
						<li><a href="../crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">SRA</a>
					<ul>
						<li><a href="../sra/index.php">Evaluar SRA</a></li>
						<li><a href="../sra/reportes.php">Reportes SRA</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CSR</a>
					<ul>
						<li><a href="../csr/index.php">Evaluar CSR</a></li>
						<li><a href="../csr/reportes.php">Reportes CSR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CRR</a>
					<ul>
						<li><a href="../crr/index.php">Evaluar CRR</a></li>
						<li><a href="../crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="#">Acerca de nosotros</a>
					<ul>
						<li><a href="../about/mision.php">Misi&oacute;n</a></li>
						<li><a href="../about/vision.php">Visi&oacute;n</a></li>
						<li><a href="../about/valores.php">Valores</a></li>
						<li><a href="../about/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="#">Acerca de FAST</a>
					<ul>
						<li><a href="../aboutfast/mision.php">Misi&oacute;n</a></li>
						<li><a href="../aboutfast/vision.php">Visi&oacute;n</a></li>
						<li><a href="../aboutfast/valores.php">Valores</a></li>
						<li><a href="../aboutfast/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="../contacto.php">Contacto</a></li>
			</ul>
		</nav>
	</div>
	<!-- FOOTER -->
	<?php $c_funciones->getFooter(); ?>
	<script type="text/javascript">

		//0=Inisignificante, 1=Bajo, 2=Medio, 3=Alto, 4=Critico, 5=nulo

		//								_Insignificante_	_Menor_			_Moderado_		_Severo_		_Critico_
		// Imninente 		  	  ||	Bajo(0,0)				Medio(0,1)			Alto(0,2)			Critico(0,3)			Critico(0,4)
		// Muy Probable 		  ||	Bajo(1,0)				Medio(1,1)			Alto(1,2)			Alto(1,3)			Critico(1,4)
		// Probable  			  ||	Insignificante(2,0)		Bajo(2,1)			Medio(2,2)			Alto(2,3)			Alto(2,4)
		// Moderadamente Probable || 	Insignificante(3,0)		Bajo(3,1)			Bajo(3,2)			Medio(3,3)			Medio(3,4)
		// Improbable   		  ||	Nulo(4,0)				Insignificante(4,1)	Insignificante(4,2)	Bajo(4,3)			Bajo(4,4)
		

		
		var MatrizSra = [
		    [1,2,3,4,4],
		    [1,2,3,3,4],
		    [0,1,2,3,3],
		    [0,1,1,2,2],
		    [5,0,0,1,1]
		];

		function getRiskLevelNumber(Probabilidad, Impacto){
			if(parseInt(Probabilidad) > 4 || parseInt(Impacto) > 4){
				return -1;
			}
			return MatrizSra[parseInt(Probabilidad)][parseInt(Impacto)];
		}


		function getRiskLevelString(Probabilidad, Impacto){
			if(parseInt(Probabilidad) > 4 || parseInt(Impacto) > 4){
				return "";
			}
			var RiskNumber = getRiskLevelNumber(parseInt(Probabilidad), parseInt(Impacto));
			//0=Inisignificante, 1=Bajo, 2=Medio, 3=Alto, 4=Critico, 5=nulo
			switch(RiskNumber){
				case 0:
					return "Insignificante";
				case 1:
					return "Bajo";
				case 2:
					return "Medio";
				case 3:
					return "Alto";
				case 4:
					return "Cr&iacute;tico";
				case 5:
					return "Nulo";
				default:
					return "";
			}
		}

		$(function(){
			$('input[name=rdbP1_Impacto]').click(function() {
				var prob = $($('input[name=rdbP1_Probabilidad]:radio:checked')).val();
				var impact = $(this).val();
				var stval = getRiskLevelNumber(prob,impact);
				$('[name=rdbP1_NivelDeRiesgo][value="'+ stval +'"]').prop('checked','checked');
				$("input[type='radio']").checkboxradio("refresh");
			});

			$('input[name=rdbP1_Probabilidad]').click(function() {
				var impact = $($('input[name=rdbP1_Impacto]:radio:checked')).val();
				var prob = $(this).val();
				var stval = getRiskLevelNumber(prob,impact);
				$('[name=rdbP1_NivelDeRiesgo][value="'+ stval +'"]').prop('checked','checked');
				$("input[type='radio']").checkboxradio("refresh");
			});
		});

	</script>
</body>
</html>