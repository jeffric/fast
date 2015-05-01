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
<?php echo $c_funciones->getHeaderNivel2(" Modificar Puntos de Evaluación", 
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
          $idPtoEvaluacion = $_GET['idPtoEvaluacion'];

$result = $c_funciones->getPtoEvaluacion($idPtoEvaluacion);     
while ($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
        $latitud = $row[2];
        $longitud = $row[3];
}          
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Modificar"); ?>
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

                    });
                }

                function updateMarkerStatus(str) {

                }

                function updateMarkerPosition(latLng) {

                   $("#txtLatitud").val(latLng.lat());
                   $("#txtLongitud").val(latLng.lng());
                }

                function updateMarkerAddress(str) {

                }                

                function iniciarMapa(lat, lon){
                  directionsDisplay = new google.maps.DirectionsRenderer(); 
                  currentPosition = new google.maps.LatLng(lat, lon);
                  map = new google.maps.Map(document.getElementById('map_canvas'), {
                      zoom: 5,
                      center: currentPosition,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                 });

                  directionsDisplay.setMap(map);
<?php

$result = $c_funciones->getPtoEvaluacion($idPtoEvaluacion);     
while ($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
?>
        
         var pda<?php echo $row[0]; ?>="<?php echo $row[1];?>",
         lat<?php echo $row[0]; ?>=<?php echo $row[2]; ?>,
         lon<?php echo $row[0]; ?>=<?php echo $row[3]; ?>,
         PositionPtoEvaluacion<?php echo $row[0]; ?> = new google.maps.LatLng(lat<?php echo $row[0]; ?>, lon<?php echo $row[0]; ?>);

         var PositionMarkerPda<?php echo $row[0]; ?> = new google.maps.Marker({
         position: PositionPtoEvaluacion<?php echo $row[0]; ?>,
         animation: google.maps.Animation.DROP,
         map: map,
         title: "<?php echo $row[1];?>",
         icon: '../css/images/PtoEvaluacion.png',         
         draggable: true
         });        

                     $("#selectPais").val("<?php echo $idPais; ?>");
                     $('#selectPais').selectmenu('refresh');

                   $("#txtNombre").val("<?php echo $row[1]; ?>");
                   $("#txtDescripcion").val("<?php echo $row[4]; ?>");

                  // Update current position info.
                 updateMarkerPosition(PositionPtoEvaluacion<?php echo $row[0]; ?>);
                 geocodePosition(PositionPtoEvaluacion<?php echo $row[0]; ?>);            


                 // Add dragging event listeners.
                 google.maps.event.addListener(PositionMarkerPda<?php echo $row[0]; ?>, 'dragstart', function() {
                 });
  
                 google.maps.event.addListener(PositionMarkerPda<?php echo $row[0]; ?>, 'drag', function() {
                 updateMarkerPosition(PositionMarkerPda<?php echo $row[0]; ?>.getPosition());
                 });
  
                 google.maps.event.addListener(PositionMarkerPda<?php echo $row[0]; ?>, 'dragend', function() {
                 geocodePosition(PositionMarkerPda<?php echo $row[0]; ?>.getPosition());
                 });  


         var contenido<?php echo $row[0]; ?> = '<div " style="width: 150px; height: 150px; border: 1px solid #000;">'+

         ''+
         '</div>';



         var infowindow<?php echo $row[0]; ?> = new google.maps.InfoWindow({
         content: "<?php echo str_replace("'","''",$row[1]);?>"+contenido<?php echo $row[0]; ?>
         });      

         google.maps.event.addListener(PositionMarkerPda<?php echo $row[0]; ?>, 'click', function() {
         infowindow<?php echo $row[0]; ?>.open(map, PositionMarkerPda<?php echo $row[0]; ?>);
         });

<?php } 
?>


              

              
            }

            function locError(error) {
               // the current position could not be located
            }

            function locSuccess(position) {
                // initialize map with current position 
                iniciarMapa(<?php echo $latitud?>, <?php echo $longitud?>);

            }
            $(document).on("ready", function() {
               navigator.geolocation.getCurrentPosition(locSuccess, locError);
              
            });



        </script>
                <center>
                <div id="map_canvas" style="height:450px; width:100%; ">                
                </div> 
                </center>


            <div data-role="content">                        
                <div id="infoPanel">
            <div class="ui-body ui-body-a ui-corner-all">
              <label for="selectPais">País del punto de evaluación:</label> 
              <select name="selectPais" id="selectPais">     
                <?php               
                $result = $c_funciones->getListaPaises();                   
                while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
                echo'
                <option value="'. $row[0] . '">' . $row[1] . '</option>';
                }                   
 ?>
            </select>                 

                <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">

                <label for="txtNombre">Nombre Punto De Evaluación:</label> 
                <input type="text" name="txtNombre" id="txtNombre" style="font-weight:Bold; font-size:20;"> 

                <label for="txtDescripcion">Descripcion:</label> 
                <input type="text" name="txtDescripcion" id="txtDescripcion" style="font-weight:Bold; font-size:20;"> 

                <label for="name">Latitud:</label> 
                <input type="text" name="namelatitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 

                <label for="direccion">Longitud:</label> 
                <input type="text" name="namelongitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;">                                

                </div>
                <a href="#"  data-role="button" id="botonGuardar">Guardar Cambios</a>
            </div>  
                                             
                </div>
            </div>                
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
    <?php echo $c_funciones->getFooterNivel2(); ?>              
	</div>	

  <div id="pageMensaje" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
      <center><img src="../img/mensaje.png" style="width:55%; height:55%; margin-top:1px;" /> 
      <br>           
            <a href="../Modificar/buscarPaisPto.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
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
  <script type="text/javascript">
        $(function(){

        $("#botonGuardar").click(function(){
          validar();
        });

        function validar(){
          var nombre = $('#txtNombre').val().trim();
          var descripcion = $('#txtDescripcion').val().trim();
          var latitud = $('#txtLatitud').val().trim();
          var longitud = $('#txtLongitud').val().trim();

            if(nombre == ""){

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
                        data: {nombreMetodo: "modificarPtoEvaluacion", AjxNombre: nombre, AjxDescripcion: descripcion, AjxLatitud: $('#txtLatitud').val(), AjxLongitud:$('#txtLongitud').val(), AjxPto: <?php echo $idPtoEvaluacion; ?>, AjxPais: <?php echo $idPais?>},
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