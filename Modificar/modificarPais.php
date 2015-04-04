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
<?php echo $c_funciones->getHeaderNivel2("Modificar País", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Paises"); ?>
		<div role="main" class="ui-content">
				<p align="center"><strong>Seleccione el Pais que desea modificar </strong><br />	
				<div class="ui-body ui-body-a ui-corner-all">
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">					
		            <select name="selectPais" id="selectPais">   
		            <option value="-2">Elegir un país</option>  
						<?php 				
						$result = $c_funciones->getListaPaises();					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'
						<option value="'. $row[0] . '">' . $row[1] . '</option>';
						}					
						?>
		            </select> 
		            </div>	

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtNombre" >Nombre País</label>
						<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>    

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtRegion" >Región a la que pertence actualmente</label>
						<input type="text" name="txtRegion" id="txtRegion" value="" disabled="true" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div> 

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<center><label for="selectRegion">Seleccione nueva región a asignar</label>	
					</div> 

				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
		            <select name="selectRegion" id="selectRegion" >   
<?php 				
						$result = $c_funciones->getListaRegiones();					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'
						<option value="'. $row[0] . '">' . $row[1] . '</option>';
						}					
?>             


		            </select> 			           
				</div>

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<a href="#"  data-role="button" id="botonGuardar">Guardar Cambios</a> 
					</div> 			
			</div>
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

<div id="pageMensaje" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
      <center><img src="../img/mensaje.png" style="width:55%; height:55%; margin-top:1px;" /> 
      <br>           
            <a href="../Modificar/modificarPais.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

</body>

<script type="text/javascript">


		$(function(){
		
				$("#selectPais").change(function(){
					CargarInfo();
				});

				function CargarInfo(){

					strpais = $("#selectPais option:selected").val();
					if(strpais==-2){

		                  $("#mensajeWarning").text("Debes elegir un país valido");    
		                  $.mobile.changePage('#pageWarning', 'pop', true, true);
		                  return false; 				
					}
					else{

			                $.ajax({
			                  type: "POST",
			                  url: "../funcionesAjax.php",
			                  data: {nombreMetodo: "obtenerInfoPais", AjxPais: strpais},
			                  contentType: "application/x-www-form-urlencoded",
			                  beforeSend: function(){

			                  },
			                  dataType: "html",
			                  success: function(msg){
			                  	 var recoge=msg.split(",");

			                  	 $('#txtNombre').val(recoge[1]);
			                  	 $('#txtRegion').val(recoge[4]);
								 $("#selectRegion").val(recoge[3]);
								 $('#selectRegion').selectmenu('refresh');				 
			                  	
									
									  

			                  }              


			                });					
					}

				}


				$("#botonGuardar").click(function(){
					validar();
				});			


	           function validar(){
				      var nombre = $('#txtNombre').val().trim();

		              if(nombre.trim() == ""){

		                  $("#mensajeWarning").text("No debes dejar campos vacios");    
		                  $.mobile.changePage('#pageWarning', 'pop', true, true);
		                  return false; 		              	          
		              }
		              else{



				              var idPais = $("#selectPais option:selected").val().trim();
				              var idRegion = $('#selectRegion option:selected').val().trim();
		                    $.ajax({
		                        type: "POST",
		                        url: "../funcionesAjax.php",
		                        data: {nombreMetodo: "modificarPais", AjxNombre:nombre, AjxPais:idPais, AjxRegion:idRegion},
		                        contentType: "application/x-www-form-urlencoded",
		                        beforeSend: function(){

		                        },
		                        dataType: "html",
		                        success: function(msg){
				                  $("#mensaje").text(msg);    
				                  $.mobile.changePage('#pageMensaje', 'pop', true, true);
				                  return false; 

		                                    

		                      }              

		                    });

		               }    

	           }

		});		

</script>
	</html>