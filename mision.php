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
<?php echo $c_funciones->getHeader("Misión", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPage("FAST"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong></strong><br />
				<div class="ui-body ui-body-a ui-corner-all">

<h2>MISIÓN</h2>
World Vision es una confraternidad internacional de cristianos cuya misión es seguir a Jesucristo como nuestro Señor y Salvador, trabajando con los pobres y oprimidos para promover la transformación humana, buscar la justicia y testificar las buenas nuevas del Reino de Dios.
					
				</div>

				<div class="ui-body ui-body-a ui-corner-all">

<h2>Nuestros valores centrales</h2>
La Confraternidad de World Vision comparte una idea común que se basa en seis valores centrales. Estos valores son los principios fundamentales que orientan y determinan lo que la organización hace.

<li>Somos cristianos:</li>
Nos esforzamos por imitar a Jesucristo en su identificación con los pobres y los oprimidos y en su interés especial por la niñez.
<br>
<br>
<li>Estamos comprometidos con los pobres:</li>
Servimos a los pueblos más necesitados y promovemos la transformación de sus condiciones de vida.
<br>
<br>
<li>Valoramos a las personas:</li>
Consideramos que todas las personas son creadas y amadas por Dios.
<br>
<br>
<li>Somos mayordomos:</li>
Somos transparentes en nuestro trato con donantes, comunidades, gobiernos y público en general.
<br>
<br>
<li>Somos socios:</li>
Mantenemos una posición colaboradora y una actitud abierta hacia otras organizaciones humanitarias.
<br>
<br>
<li>Somos sensibles:</li>
Ante carencias sociales y económicas complejas, con raíces profundas que exigen un desarrollo sostenible y a largo plazo.
<br>
<br>					
				</div>				
		</div>
		<?php echo $c_funciones->getMenu($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooter(); ?>	
</div>
</body>
<script>
</script>
</html>