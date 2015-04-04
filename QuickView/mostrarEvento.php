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
<?php echo $c_funciones->getHeaderNivel2("Mostrar Eventos", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>
  <!-- scripts para mapas -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>

  '); 

 $idEvento = $_GET['idEvento'];

$result = $c_funciones->getInfoEvento($idEvento);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
          $idEvento=$row[0];
					$nombreEvento=$row[1];
					$localidad=$row[2];
					$descripcion=$row[3];
					$fecha=$row[4];
					$latitud = $row[5];
					$longitud = $row[6];
				}

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
                  icon: <?php
                              $result1=$c_funciones->getCrrEvento($idEvento);
                              if(mysqli_num_rows($result1)>0){

                              while ($row1 = mysqli_fetch_array($result1, MYSQL_NUM)){
                                  $nivelCrr = $row1[0];

                                  } 
                                    if($nivelCrr =="INSIGNIFICANTE"){

                                        echo '"../css/images/eventoverde.png"';
                                    }
                                    else if($nivelCrr =="BAJO"){

                                        echo '"../css/images/eventoamarillo.png"';
                                    }
                                    else if($nivelCrr =="MEDIO"){
                                        echo '"../css/images/eventonaranja.png"';

                                    }
                                    else if($nivelCrr =="ALTO"){
                                        echo '"../css/images/eventorojo.png"';

                                    }                                    
                                    else if($nivelCrr =="CRITICO"){
                                        echo '"../css/images/eventonegro.png"';

                                    }                                                     

                              } 
                              else{
                                  echo '"../css/images/eventogris.png"';
                              } 


                  ?>,
                  draggable: false
                  });

               var contenido<?php echo $idEvento; ?> = '<div " style="width: 150px; height: 150px; border: 1px solid #000;">'+
<?php
                $result2=$c_funciones->getDescripcionSraEvento($idEvento);
                if(mysqli_num_rows($result2)>0){

                while ($row2 = mysqli_fetch_array($result2, MYSQL_NUM)){
                    $descripcionLastSra = $row2[0];
                    echo "'Observaciones:<br>$descripcionLastSra'";

                    }                    

                } 
                else{
                    echo '"Sin SRA"';
                }

?>
+
               '</div>';

               var infowindow<?php echo $idEvento; ?> = new google.maps.InfoWindow({
               content: '<?php echo $nombreEvento;?>'+contenido<?php echo $idEvento; ?>
               }); 

               google.maps.event.addListener(currentPositionMarker, 'click', function() {
               infowindow<?php echo $idEvento ?>.open(map, currentPositionMarker);
               })

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
                iniciarMapa(<?php echo $latitud?>, <?php echo $longitud?>);
            }

            $(document).on("ready", function() {
                // find current position and on success initialize map and calculate the route
                navigator.geolocation.getCurrentPosition(locSuccess, locError);

            });

         </script>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Mostrar"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>MOSTRAR EVENTO</strong><br />
					<div class="ui-body ui-body-a ui-corner-all">

    						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
    							<label for="txtNombre" >Nombre del Evento</label>
    							<input disabled="true" type="text" name="txtNombre" id="txtNombre" value="<?php echo $nombreEvento; ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
    						</div>
    						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
    							<label for="txtLocalidad" >Localidad (Lugar donde se realizará el evento)</label>
    							<input disabled="true" type="text" name="txtLocalidad" id="txtLocalidad" value="<?php echo $localidad; ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
    						</div>			

    						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
    							<label for="txtDescripcion" >Descripción del Evento</label>						
    							<textarea disabled="true" cols="40" rows="5" name="txtDescripcion" id="txtDescripcion" style="resize:none;"><?php echo $descripcion; ?></textarea>
    						</div>
    						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
    							<label for="txtFecha">Fecha</label>
    							<input disabled="true" type="date" data-clear-btn="false" id="txtFecha" value="<?php echo $fecha; ?>">	
    						</div>                
					</div>	

        <div class="ui-body ui-body-a ui-corner-all">
<table>
    <tr>
        <th>
            NIVEL DE CRR
        <th>
        </tr>
        <tr>
        <td> <img src="../css/images/eventogris.png"> Sin CRR
        </td>
        <td> <img src="../css/images/eventoverde.png"> Insignificante  
        </td>
        <td> <img src="../css/images/eventoamarillo.png"> Bajo
        </td>
        <td> <img src="../css/images/eventonaranja.png"> Medio
        </td>  
        <td> <img src="../css/images/eventorojo.png"> Alto
        </td>    
        <td> <img src="../css/images/eventonegro.png"> Crítico
        </td>                                     
    </tr>
</table>          
	        <div id="mapCanvas" class="content" style="height:375px;">                
	        </div>

            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"> 
                <label for="txtLatitud">Latitud:</label> 
                <input type="text" name="namelatitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 

                <label for="txtLongitud">Longitud:</label> 
                <input type="text" name="namelongitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
            </div>
        </div>

		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
    <?php echo $c_funciones->getFooterNivel2(); ?>    

  </div>
</div>
			
	</body>
  <script type="text/javascript">

       $(function(){




        });

  </script>

	</html>