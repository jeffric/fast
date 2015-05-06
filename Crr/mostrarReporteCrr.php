<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);
$idReporte = $_GET["idReporte"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Reportes CRR", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST CRR"); ?>
		<div role="main" class="ui-content">
				<div class="ui-body ui-body-a ui-corner-all">

<?php
				$result=$c_funciones->getReporteCrr($idReporte);

				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
							$HtmlReporte=$row[7];				
						}
					echo $HtmlReporte;	
?>
					
				</div>

			<div data-role="fieldcontain">
				<label for="txtDescripcion">Lista de correos (correos separados por comas):</label>
				<textarea cols="40" rows="8" name="txtCorreos" id="txtCorreos" placeholder="Ej: cordonez@vm.com, jp@vm.com, jfuentes@gmail.com, lbarrios@gmail.com..."></textarea>
			</div>
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a id="btnCorreo" data-role="button" href="#" name="btnEvaluar" class="ui-btn-hidden" aria-disabled="false">Enviar por correo</a>
			</div>	

		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>
</body>
	<script type="text/javascript">

       $(document).ready(function(){

			$("#btnCorreo").click(function(){

				var correos = $("#txtCorreos").val();
				alert(<?php echo $idReporte; ?>);
			      $.ajax({
		                  type: "POST",
		                  url: "../funcionesAjax.php",
		                  data: {nombreMetodo: "sendGMail", AjxTipoReporte: 2, mails:correos, Asunto:"World Vision - Reporte CRR", AjxIDReporte:<?php echo $idReporte; ?> },
		                  contentType: "application/x-www-form-urlencoded",
		                  beforeSend: function(){
		                    $('#loader_gif').fadeIn("slow");

		                  },
		                  dataType: "html",
		                  success: function(msg){
		                  		alert(msg);
		                  }  			      	
           
                });								

			});


        });       	


	</script>
</html>