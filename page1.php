<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">

	<!-- Estilos -->
	<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />
	
	<!-- Estilos para menu -->
	<link type="text/css" rel="stylesheet" href="css/menu/demo.css" />
	
	<link type="text/css" rel="stylesheet" href="css/menu/jquery.mmenu.all.css" />
	

	<!-- Scripts -->
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.js"></script>	

	<!-- Scripts para menu -->
	<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript">
		$(function() {
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
	</style>

</head>
<body>

	<div id="page">
		<div class="header">
			<a href="#menu"></a>
			<div style="text-align:center;">
				FAST
			</div>
			<div style="position: absolute; right:0; top: 0;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>
		<div class="content">
			<div class="ui-grid-c ui-responsive">
				<div class="ui-block-a" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/crr-logo.png" alt="crr-section">
						<h2>CRR</h2>
					</a>
				</div>
				<div class="ui-block-b" style="text-align: center;">
					<a href="sra/sra-index.php">
						<img src="img/sra-logo.png" alt="crr-section">
						<h2>SRA</h2>
					</a>
				</div>
				<div class="ui-block-c" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/hiss-logo.png" style="width:80%;" alt="crr-section">
						<h2>HISS CAM</h2>
					</a>					
				</div>
				<div class="ui-block-d" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/csr-logo.png" style="width:78%;" alt="crr-section">
						<h2>CSR</h2>
					</a>
				</div>
			</div><!-- /grid-b -->
			<div data-role="controlgroup">
				<a href="reportes.php" data-role="button">Reportes</a>
				<a href="configuracion.php" data-role="button">Configuraci&oacute;n</a>
				<a href="historial.php" data-role="button">Historial</a>
			</div> <!-- /Down Menu -->
		</div>
		<nav id="menu">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="home.php">CRR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CRR</a></li>
						<li><a href="crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">SRA</a>
					<ul>
						<li><a href="crr/index.php">Evaluar SRA</a></li>
						<li><a href="crr/reportes.php">Reportes SRA</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CSR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CSR</a></li>
						<li><a href="crr/reportes.php">Reportes CSR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CRR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CRR</a></li>
						<li><a href="crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="#">Acerca de nosotros</a>
					<ul>
						<li><a href="about/mision.php">Misi&oacute;n</a></li>
						<li><a href="about/vision.php">Visi&oacute;n</a></li>
						<li><a href="about/valores.php">Valores</a></li>
						<li><a href="about/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="#">Acerca de FAST</a>
					<ul>
						<li><a href="aboutfast/mision.php">Misi&oacute;n</a></li>
						<li><a href="aboutfast/vision.php">Visi&oacute;n</a></li>
						<li><a href="aboutfast/valores.php">Valores</a></li>
						<li><a href="aboutfast/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="contacto.php">Contacto</a></li>
			</ul>
		</nav>
	</div>
	<!-- FOOTER -->
	<?php $c_funciones->getFooter(); ?>		
</body>
</html>