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
<?php echo $c_funciones->getHeaderNivel2("Eliminar Punto de Evaluación", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>'); ?>
    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>

<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Puntos de Evaluación"); ?>
		<div role="main" class="ui-content">
			<div class="ui-body ui-body-a ui-corner-all">  
					<p align="center"><strong>Seleccione el Punto de Evaluación que desea eliminar del sistema</strong><br />	
		            <select name="selectPtoEvaluacion" id="selectPtoEvaluacion">   
		            <option value="-2">Elegir un Punto de Evaluación</option>  
<?php 				
						$result = $c_funciones->getListaPtosEvaluacion($idPais);					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
						}					
?>
		            </select> 		

		            <div id="ajax_loader">
		            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
		            </div>
		            <a href="#"  data-role="button" id="botonEliminar">Eliminar Punto de Evaluación</a>
			</div>
		            
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>					
</div>	

<div id="pagePregunta" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajePregunta" align="center">Este Punto de Evaluación será eliminado, toda información relacionada a el, tambien será eliminada del sistema.</p>
			<center>
			<img src="../img/interrogacion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="botonConfirmar" data-rel="back">Confirmar</a>
            <a href="#" data-role="button" id="botonCancelar" data-rel="back">Cancelar</a>
            </center>
           </article>
</div>

<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
			<center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageEliminado" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeEliminado" align="center">El Punto de Evaluación fue eliminado exitosamente</p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" />
            <a href="../Eliminar/buscarPaisPto.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageCancelado" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeExito" align="center">La acción ha sido Cancelada</p>
			<center>
			<img src="../img/error.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>

</body>
<script>
       $(document).ready(function(){
            
            $('#botonEliminar').click(function(){
	            	punto = $("#selectPtoEvaluacion option:selected").val();
					if(punto==-2){

						$("#mensaje").text("Debes elegir un Punto de Evaluación válido");
						$.mobile.changePage('#pageWarning', 'pop', true, true);
						return false;	

					}
					else{
	            		
	            		$.mobile.changePage('#pagePregunta', 'pop', true, true);	
					}                
            });

			$("#botonConfirmar").click(function(){
				      $.ajax({
			                  type: "POST",
			                  url: "../funcionesAjax.php",
			                  data: {nombreMetodo: "eliminarPtoEvaluacion", ptoEvaluacion: $('#selectPtoEvaluacion').val()},
			                  contentType: "application/x-www-form-urlencoded",
			                  beforeSend: function(){
			                    $('#loader_gif').fadeIn("slow");

			                  },
			                  dataType: "html",
			                  success: function(msg){
				                $("#loader_gif").fadeOut("slow");
								$.mobile.changePage('#pageEliminado', 'pop', true, true);
								return false;		                    
		                  	}              
	                	});							
			});

			$("#botonCancelar").click(function(){
								
				$.mobile.changePage('#pageCancelado', 'pop', true, true);
				return false;
			});
                    
        });
    </script>
	</html>