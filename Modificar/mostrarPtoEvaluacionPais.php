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
<?php echo $c_funciones->getHeaderNivel2("Puntos de Evaluación", 
	'<script type="text/javascript">
	$(function() {
		//$("nav#menu").mmenu();
	});
</script>'); ?>
    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Ptos de Evaluación"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong></strong><br />	
				<?php 				
				$result = $c_funciones->getNombrePais($idPais);					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<strong>'.$row[0] .'</strong>';
				}		
				 echo " 
				<script> var map,
                currentPosition,
                directionsDisplay 
                var geocoder = new google.maps.Geocoder();
        		</script>";			
				?>		

  <script type="text/javascript">
                function geocodePosition(pos) {
                    geocoder.geocode({
                      latLng: pos
                    },
                    function(responses) {
                        if (responses && responses.length > 0) {
                            updateMarkerAddress(responses[0].formatted_address);                           
                        } else {
                          updateMarkerAddress('Cannot determine address at this location.');
                        }
                    });
                }

                function updateMarkerStatus(str) {

                }

                function updateMarkerPosition(latLng) {

                }

                function updateMarkerAddress(str) {

                }                

                function iniciarMapa(lat, lon){
                  directionsDisplay = new google.maps.DirectionsRenderer(); 
                  currentPosition = new google.maps.LatLng(lat, lon);
                  map = new google.maps.Map(document.getElementById('map_canvas'), {
                      zoom: 1,
                      center: currentPosition,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                 });

<?php

$con = mysqli_connect("localhost","root","admin","fastdbvm");

if ($con->connect_errno>0){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sqlpdas="SELECT idPUNTO_EVALUACION, Nombre, Latitud, Longitud FROM PUNTO_EVALUACION WHERE PAIS_idPais = $idPais";  

if (!$result = $con->query($sqlpdas)) {
die('There was an error running the query [' . $con->error . ']');
}

while ($filaidPdas = $result->fetch_assoc()) { 
?>

         var pda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>="<?php echo $filaidPdas['Nombre'];?>",
         lat<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>=<?php echo $filaidPdas['Latitud']; ?>,
         lon<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>=<?php echo $filaidPdas['Longitud']; ?>,
         PositionPda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?> = new google.maps.LatLng(lat<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>, lon<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>);

         var PositionMarkerPda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?> = new google.maps.Marker({
         position: PositionPda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>,
         animation: google.maps.Animation.DROP,
         map: map,
         title: "<?php echo $filaidPdas['Nombre'];?>",
         draggable: true
         });           

         var contenido<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?> = '<div " style="width: 150px; height: 150px; border: 1px solid #000;">'+

         '<center><a href="lstSelAmenazaSRA.php?PtoDeEval=<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>" data-ajax="false"'+
         'data-role="button"'+
         'id="botonGuardar"'+
         '">SRA</a></center>'+

         ' <center><a href="Evaluar.php?PtoDeEval=<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>" data-ajax="false"'+
         'data-role="button"'+
         'id="botonGuardar"'+
         '">HISS-CAM</a></center>'+

         ' <center><a href="#"'+
         'data-role="button"'+
         'id="botonGuardar"'+
         '">CSR</a></center>'+
         '</div>';



         var infowindow<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?> = new google.maps.InfoWindow({
         content: '<?php echo $filaidPdas['Nombre'];?>'+contenido<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>
         });      

         google.maps.event.addListener(PositionMarkerPda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>, 'click', function() {
         infowindow<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>.open(map, PositionMarkerPda<?php echo $filaidPdas['idPUNTO_EVALUACION']; ?>);
         });

<?php } mysqli_close($con);
?>



                  // Update current position info.
                  updateMarkerPosition(currentPosition);
                  geocodePosition(currentPosition);
                
            }

            function locError(error) {
               // the current position could not be located
            }

            function locSuccess(position) {
                // initialize map with current position 
                iniciarMapa(14.551518299999998, -90.57179589999998);

            }
            $(document).on("ready", function() {
               navigator.geolocation.getCurrentPosition(locSuccess, locError);
              
            });



        </script>

                <div id="map_canvas" style="height:500px; border:10px solid #a0a0a0;">                
                </div> 


            <div data-role="content">                        
                <div id="infoPanel">
                    <div id="markerStatus">
                    </div>
                    <div id="info">                    
                    </div>
                    <div id="address">                                      
                    </div>

<div id="ajax_loader"><img id="loader_gif" src="../css/themes/default/images/ajax-loader.gif" style=" display:none;"/>
</div> 
                        <div id="Resultado">
                        </div>     
                                             
                </div>
            </div>                
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>