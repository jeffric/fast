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
<?php echo $c_funciones->getHeaderNivel2("Agregar Pais", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Paises"); ?>   
		<div role="main" class="ui-content">
      	<p align="center"><strong>AGREGAR PAÍS</strong><br/>	
      			<div class="ui-body ui-body-a ui-corner-all">  
                  <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                    <label for="textNombrePais">Nombre de País:</label> 
                    <input type="text" name="textNombrePais" id="textNombrePais"> 
                  </div>

                    <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
                    <label for="selectRegion">Elige la Región a la que pertenecerá el nuevo País:</label>             
                    <select name="selectRegion" id="selectRegion" >   
      <?php         
                    $result = $c_funciones->getListaRegiones();         
                    while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
                    echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
                    }         
      ?>             
                    </select> 
                    </div>  

                    <div id="ajax_loader" align="center">
                    <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
                    </div>
                    <a href="#"  data-role="button" id="botonAgregar">Agregar País</a>
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
            <a href="../Agregar/agregarPais.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
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

<script>
       $(document).ready(function(){

            $('#botonAgregar').click(function(){

             var nombre = $('#textNombrePais').val().trim();
             if(nombre.trim() == ""){

                  $("#mensajeWarning").text("No debes dejar campos vacios");    
                  $.mobile.changePage('#pageWarning', 'pop', true, true);
                  return false;         
             }
              else{

                    $.ajax({
                            type: "POST",
                            url: "../funcionesAjax.php",
                            data: {nombreMetodo: "agregarPais", pais:$('#textNombrePais').val().trim(), region:$('#selectRegion option:selected').val() },
                            contentType: "application/x-www-form-urlencoded",
                            beforeSend: function(){
                                $('#loader_gif').fadeIn("slow");

                            },
                            dataType: "html",
                            success: function(msg){
                                $('#textNombrePais').val('');  
                                $("#loader_gif").fadeOut("slow");                 
                                $("#mensaje").text(msg);    
                                $.mobile.changePage('#pageMensaje', 'pop', true, true);
                                return false;
                            }              
                      });
                  }  

       	  });

        });
  </script>
	</html>