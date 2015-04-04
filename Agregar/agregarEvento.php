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
<?php echo $c_funciones->getHeaderNivel2("Agregar Eventos", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>
  <!-- scripts para mapas -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>

  '); ?>


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
                  icon: '../css/images/Evento.png',
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
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Agregar"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>AGREGAR EVENTO</strong><br />
					<div class="ui-body ui-body-a ui-corner-all">

      						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
      							<label for="txtNombre" >Nombre del Evento</label>
      							<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
      						</div>
      						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
      							<label for="txtLocalidad" >Localidad (Lugar donde se realizará el evento)</label>
      							<input type="text" name="txtLocalidad" id="txtLocalidad" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
      						</div>			

      						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
      							<label for="txtDescripcion" >Descripción del Evento</label>						
      							<input  name="txtDescripcion" id="txtDescripcion" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
      						</div>
      						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
      							<label for="txtFecha">Fecha</label>
      							<input type="date"  id="txtFecha">	
      						</div>                    

                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
        			     <p align="center"><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
        	        <div id="mapCanvas" class="content" style="height:375px;">                
        	        </div>
                </div>

                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                    <label for="txtLatitud">Latitud:</label> 
                    <input type="text" name="namelatitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
                  </div>

                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                    <label for="txtLongitud">Longitud:</label> 
                    <input type="text" name="namelongitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
                  </div>
                    		<a href=""  data-role="button" id="botonAgregar">Agregar Evento</a></center> 
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
            <a href="../Agregar/agregarEvento.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

</body>
  <script type="text/javascript">

       $(function(){

        $("#botonAgregar").click(function(){
          validar();
        });

        function validar(){
          var nombre = $('#txtNombre').val().trim();
          var localidad = $('#txtLocalidad').val().trim();
          var descripcion = $('#txtDescripcion').val().trim();
          var latitud = $('#txtLatitud').val().trim();
          var longitud = $('#txtLongitud').val().trim();
          var fecha = $('#txtFecha').val().trim();

            if(nombre == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;          
            }
            else if(localidad.trim() >=0 || localidad == ""){

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
            else if(fecha.trim() == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;                        
            }                            
            else{

                      $.ajax({
                        type: "POST",
                        url: "../funcionesAjax.php",
                        data: {nombreMetodo: "agregarEvento", AjxNombre: nombre, AjxLocalidad: localidad, AjxDescripcion: descripcion, AjxFecha: fecha, AjxLatitud: $('#txtLatitud').val(), AjxLongitud:$('#txtLongitud').val()},
                        contentType: "application/x-www-form-urlencoded",
                        beforeSend: function(){
                        $('#loader_gif').fadeIn("slow");

                        },
                        dataType: "html",
                        success: function(msg){
                          $("#loader_gif").fadeOut("slow");  

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