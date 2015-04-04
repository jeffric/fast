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

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Agregar Punto De Evaluación", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>
  <!-- scripts para mapas -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>

  '); 
?>
          <script type="text/javascript">

              var map,
                  currentPosition,
                  directionsDisplay, 
                  directionsService

              var geocoder = new google.maps.Geocoder();

              function geocodePosition(pos) {
                     geocoder.geocode({
                       latLng: pos
                     },
                     function(responses) {

                     });
              }

              function updateMarkerPosition(latLng) {

                   $("#txtLatitud").val(latLng.lat());
                   $("#txtLongitud").val(latLng.lng());
              }   

              function iniciarMapa(lat, lon){
                  directionsDisplay = new google.maps.DirectionsRenderer(); 
                  currentPosition = new google.maps.LatLng(lat, lon);
                  map = new google.maps.Map(document.getElementById('mapCanvas'), {
                  zoom: 7,
                  center: currentPosition,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                  });

                  directionsDisplay.setMap(map);

              var currentPositionMarker = new google.maps.Marker({
                  position: currentPosition,
                  animation: google.maps.Animation.DROP,
                  map: map,
                  title: "Posicion Actual",
                  icon: '../css/images/PtoEvaluacion.png',
                  draggable: true
                  });

                  // Update current position info.
                 updateMarkerPosition(currentPosition);
                 geocodePosition(currentPosition);
                  
                 // Add dragging event listeners.
                 google.maps.event.addListener(currentPositionMarker, 'dragstart', function() {
                 });
  
                 google.maps.event.addListener(currentPositionMarker, 'drag', function() {
                 updateMarkerPosition(currentPositionMarker.getPosition());
                 });
  
                 google.maps.event.addListener(currentPositionMarker, 'dragend', function() {
                 geocodePosition(currentPositionMarker.getPosition());
                 });
                
              }

            function locError(error) {
               // the current position could not be located
            }

            function locSuccess(position) {
                // initialize map with current position 
                iniciarMapa(position.coords.latitude, position.coords.longitude);
            }

            $(document).on("ready", function() {
                // find current position and on success initialize map and calculate the route
                navigator.geolocation.getCurrentPosition(locSuccess, locError);

            });

         </script>
<body>

<div data-role="page" id="page" data-role="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST MAPAS"); ?>
		<div role="main" class="ui-content" >
          			<p align="center"><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">        
                	        <div id="mapCanvas" class="content" style="height:375px;">                
                	        </div> 
                  </div>              
                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">                    
          	        <p align="center"><strong>Seleccione el Pais, al cual pertenecerá dicho Punto de Evaluación</strong><br /> 
                      <select name="selectPais" id="selectPais">     
<?php 				
                  if($strTipoUsuario==1){
                				$result = $c_funciones->getListaPaises();					
                				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
                				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
                				}					
                   }
                  else{
                      $result = $c_funciones->getListaPaisesAsignados($idUsuario);          
                      while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
                      echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
                      }
                  }         
?>
                      </select> 
                   </div>   
                      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">            
                      <label for="Nombre">Nombre Punto De Evaluación:</label> 
                      <input type="text" name="Nombre" id="txtNombre" style="font-weight:Bold; font-size:20;"> 
                      </div>

                      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                      <label for="Descripcion">Descripcion:</label> 
                      <input type="text" name="Descripcion" id="txtDescripcion" style="font-weight:Bold; font-size:20;"> 
                      </div>

                      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                      <label for="name">Latitud:</label> 
                      <input type="text" name="latitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
                      </div>

                      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                      <label for="longitud">Longitud:</label> 
                      <input type="text" name="longitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
          			      </div>

                      <div id="ajax_loader">
                      <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
                      </div> 

                      <a href="#"  data-role="button" id="botonAgregar">Agregar Punto de Evaluación</a></center> 
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
            <a href="../Agregar/agregarPtoEvaluacion.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

	</body>
      <script>
       $(document).ready(function(){
            
            $('#botonAgregar').click(function(){
                
                  validar();

            });

            function validar(){

              var nombre = $('#txtNombre').val().trim();
              var descripcion = $('#txtDescripcion').val().trim();
              var latitud = $('#txtLatitud').val().trim();
              var longitud = $('#txtLongitud').val().trim();

              if(nombre.trim() == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;    

              }
              else if(descripcion.trim() == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;            
              }
              else if(latitud.indexOf(' ') >=0 || latitud == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;           
              }
              else if(longitud.indexOf(' ') >=0 || longitud == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;            
              }
              else{

                 $.ajax({
                    type: "POST",
                    url: "../funcionesAjax.php",
                    data: {nombreMetodo: "agregarPtoEvaluacion", AjxNombre: nombre, AjxLatitud:latitud, AjxLongitud:longitud, AjxDescripcion:descripcion, AjxPais:$('#selectPais').val()},
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