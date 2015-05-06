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
  </style>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>  
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>  $(function() {    $( "#txtFecha" ).datepicker({dateFormat: "yy-mm-dd"});  });  </script>');

?>


<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST CSR"); ?>
		<div role="main" class="ui-content">
		<form action="realizarEvaluacionEvento.php" method="POST" data-ajax="false" >
			<p align="center"><strong>Seleccione el Evento que desea evaluar CSR</strong><br />		
				<div class="ui-body ui-body-a ui-corner-all">
						<select name="lstEventos" id="lsteEventos">
							<?php 				

									$result = $c_funciones->getListaEventos();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
			<p align="center"><strong>Seleccione el nivel de riesgo para ese Evento</strong><br />						
						<select name="lstNivelRiesgo" id="lstNivelRiesgo">
							<?php 				

									$result = $c_funciones->getNivelRiesgo();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	

      			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
      					<label for="txtFecha">Fecha de elaboración</label>
      					<input type="text" name="txtFecha" id="txtFecha">	
      			</div> 						
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<input type="submit" id="botonEvaluar" data-theme="a" name="submit" value="Iniciar Evaluación" class="ui-btn-hidden" aria-disabled="false"/>
				</div>							

				</div>									
	</form>


		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>		

	</div>		
<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeWarning" align="center"></p>
      <center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
      <br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>
	</body>
	<script>
		 $(document).ready(function(){
            $('#botonEvaluar').click(function(){

            	if($("#txtFecha").val().trim()=="")
            	{
                   $("#mensajeWarning").text("Debes ingresar una fecha valida");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;   

            	}
       	  });

		});
	</script>
	</html>