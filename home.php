<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();


		if($_SESSION["Usuario"] == ""){
			header("Location: index.php");
			return;
		}

		$strUsuario=$_SESSION["Usuario"];
		$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Home", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); 

?>

<body>

<div data-role="page" id="home">
		 <?php $c_funciones->getHeaderPage("FAST Home"); ?>

		  <div role="main" class="ui-content">

				
				<center><img src="img/logo-fast.jpg" style="width:50%; height:50%; margin-top:1px;" /></center>

<?php
				if($strTipoUsuario ==1){

					echo "<a href='Bitacora.php' data-role='button' data-ajax='false' id='botonAgregar' data-rel='dialog'>BITACORA DE ACCIONES</a>";
				}
?>
				
	 						 						 			
																					  	
		    
		  </div>
		 <?php echo $c_funciones->getMenu($strTipoUsuario); ?>
		 <?php echo $c_funciones->getFooter(); ?>	
</div>

<div id="pageError" data-role="page" data-theme="b" >
    <header data-role="header">
        <h1>Error</h1>
            <article data-role="content">
            <p>Usuario, contraseña o tipo de usuario no validos</p>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
           </article>
</div>	 

	<script>
       $(document).ready(function(){

            $('#btn').click(function(){

            	alert("hola");
       	  });

       	  });
	</script>
</body>
</html>