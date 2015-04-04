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
<?php echo $c_funciones->getHeaderNivel2("Eliminar Evento", 
	'<style>
    .panel-content {
      padding: 1em;
    }
  </style>'); ?>
    <?php
          $idEvento = $_GET['idEvento'];
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Eventos"); ?>
		<div role="main" class="ui-content">
				<div class="ui-body ui-body-a ui-corner-all">
					<p align="center">Confirme la eliminacion de Evento: "
<?php 				
						$result = $c_funciones->getInfoEvento($idEvento);					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'<strong>'.$row[1] .'</strong>';
						}				
?>	
					<br>
					<br>	
		            <a href="#"  data-role="button" id="botonEliminar">Eliminar Evento</a></center> 
		        </div>    

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>		

</div>		

<div id="pagePregunta" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajePregunta" align="center">Éste Evento será eliminado, toda información relacionada a el, tambien será eliminada del sistema.</p>
			<center>
			<img src="../img/interrogacion.png" style="width:40%; height:40%; margin-top:1px;" />
			<br>
            <a href="#" data-role="button" id="botonConfirmar" data-rel="back">Confirmar</a>
            <a href="#" data-role="button" id="botonCancelar" data-rel="back">Cancelar</a>
            </center>
           </article>
</div>

<div id="pageEliminado" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeEliminado" align="center">El Evento fue eliminado exitosamente</p>
			<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" />
            <a href="../Eliminar/buscarEvento.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
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

                $.mobile.changePage('#pagePregunta', 'pop', true, true);	

            });

			$("#botonConfirmar").click(function(){
			    $.ajax({
		                  type: "POST",
		                  url: "../funcionesAjax.php",
		                  data: {nombreMetodo: "eliminarEvento", AjxEvento: <?php echo $idEvento; ?>},
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