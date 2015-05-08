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
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>
  <!-- scripts para mapas -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>

  '); ?>
    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>
<div  data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Ptos de Evaluación"); ?>
		<div role="main" class="ui-content">
			<p align="center"><br />	
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
                    })
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

$result=$c_funciones->getPtosPais($idPais);

while ($filaidPdas = mysqli_fetch_array($result, MYSQL_NUM)) { 
?>

         var pda<?php echo $filaidPdas[0]; ?>="<?php echo $filaidPdas[1];?>",
         lat<?php echo $filaidPdas[0]; ?>=<?php echo $filaidPdas[2]; ?>,
         lon<?php echo $filaidPdas[0]; ?>=<?php echo $filaidPdas[3]; ?>,
         PositionPda<?php echo $filaidPdas[0]; ?> = new google.maps.LatLng(lat<?php echo $filaidPdas[0]; ?>, lon<?php echo $filaidPdas[0]; ?>);

         var PositionMarkerPda<?php echo $filaidPdas[0]; ?> = new google.maps.Marker({
         position: PositionPda<?php echo $filaidPdas[0]; ?>,
         animation: google.maps.Animation.DROP,
         map: map,
         title: "<?php echo $filaidPdas[1];?>",
         icon: <?php 
                $result1=$c_funciones->getCrr($filaidPdas[0]);
                if(mysqli_num_rows($result1)>0){

                while ($row1 = mysqli_fetch_array($result1, MYSQL_NUM)){
                    $nivelCrr = $row1[0];

                    }                    
                        if($nivelCrr =="INSIGNIFICANTE"){

                            echo '"../css/images/verde.png"';
                        }
                        else if($nivelCrr =="BAJO"){

                            echo '"../css/images/amarillo.png"';
                        }
                        else if($nivelCrr =="MEDIO"){
                            echo '"../css/images/naranja.png"';

                        }
                        else if($nivelCrr =="ALTO"){
                            echo '"../css/images/rojo.png"';

                        }

                        else if($nivelCrr =="CRITICO"){
                            echo '"../css/images/negro.png"';

                        }

                } 
                else{
                    echo '"../css/images/gris.png"';
                }  


                    
         ?> ,
         draggable: false
         });           

         var contenido<?php echo $filaidPdas[0]; ?> = '<div " style="width: 200px; height: 150px; border: 1px solid #000;">'+
<?php
                $result2=$c_funciones->getDescripcionSraPto($filaidPdas[0]);
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



         var infowindow<?php echo $filaidPdas[0]; ?> = new google.maps.InfoWindow({
         content: "<?php echo $filaidPdas[1];?>"+contenido<?php echo $filaidPdas[0]; ?>
         });      

         google.maps.event.addListener(PositionMarkerPda<?php echo $filaidPdas[0]; ?>, 'click', function() {
         infowindow<?php echo $filaidPdas[0]; ?>.open(map, PositionMarkerPda<?php echo $filaidPdas[0]; ?>);
         });

<?php } 
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
<table>
    <tr>
        <th>
            NIVEL DE CRR
        <th>
        </tr>
        <tr>
        <td> <img src="../css/images/gris.png"> Sin CRR
        </td>
        <td> <img src="../css/images/verde.png"> Insignificante  
        </td>
        <td> <img src="../css/images/amarillo.png"> Bajo
        </td>
        <td> <img src="../css/images/naranja.png"> Medio
        </td>  
        <td> <img src="../css/images/rojo.png"> Alto
        </td>       
        <td> <img src="../css/images/negro.png"> Crítico
        </td>                                 
    </tr>
</table>
        <div class="ui-body ui-body-a ui-corner-all">
                <div id="map_canvas" style="height:500px;">                
                </div> 
        </div>
    </div>  
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
        <?php echo $c_funciones->getFooterNivel2(); ?>      


 </div>   	

	</body>
	</html>