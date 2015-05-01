<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/
	include_once("dbMng.php");
	class Funciones extends DataBaseManager{
	/**
		Constructor
	*/
		// constructor


// $link = mysql_connect('creativesolitcom.ipagemysql.com', 'vm_user_fast', '*password*'); 
// if (!$link) { 
//     die('Could not connect: ' . mysql_error()); 
// } 
// echo 'Connected successfully'; 
// mysql_select_db(dbfast_vm); 

		function __construct(){
		//$serverName, $port, $db_name, $username, $password

			// $serverName = "localhost";
			// CREDENCIALES VISION MUNDIAL
			// $serverName = "localhost";
			// $port = "3306";
			// $db_name = "fastdbvm";
			// // $username = "root";
			// $username = "root";
			// $password = "M2chus04";

			//CREDENCIALES LOCALES
			$serverName = "localhost";
			$port = "3306";
			$db_name = "fastdbvm";
			// $username = "root";
			$username = "root";
			$password = "M2chus04";
			parent::__construct($serverName, $port, $db_name, $username, $password);		
		}

	/**
		Funcion para obtener todos los imports de librerias de javascript necesarios en la pagina
	*/
		function getJavascriptImports(){
			
		}
		
	/**
		Funcion para obtener todos los imports de librerias CSS necesarias para la pagina.	
	*/
		function getCssImports(){
			
			echo '<link rel="stylesheet" href="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])) . '\css\jquery.mobile-1.4.3.min.css">';
			echo '<link rel="stylesheet" href="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])) . '\css\jqm-demos.css">';

		}

	/**
		Funcion para construir el menu superior y lateral
	*/
		function getMenu($strTipoUsuario){
			if($strTipoUsuario==1)
			{
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>USUARIOS</h3>
						<ul data-role="listview">											
							<li data-icon="user" data-theme="a"><a href="Usuarios/index.php" data-ajax="false">Crear Usuario</a></li>					
							<li data-icon="user" data-theme="a"><a href="Usuarios/asignarUsuarioP.php" data-ajax="false">Asignar Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="Usuarios/desasignarUsuarioP.php" data-ajax="false">Desasignar Usuario</a></li>									
							<li data-icon="user" data-theme="a"><a href="Usuarios/modificarInfoUsuario.php" data-ajax="false">Modificar Info Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="Usuarios/eliminarUsuario.php" data-ajax="false">Eliminar Usuario </a></li>					
						</ul>				
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/busarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/index.php" data-ajax="false">Hiss-cam</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>AGREGAR INFO A FAST</h3>
							<ul data-role="listview">
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarPais.php" data-ajax="false">País</a></li>
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarRegion.php" data-ajax="false">Región</a></li>	
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>
								<li data-icon="location" data-theme="a"><a href="Agregar/agregarPtoEvaluacion.php" data-ajax="false">Punto de Evaluación</a></li>	
								<li data-icon="calendar" data-theme="a"><a href="Agregar/agregarEvento.php" data-ajax="false">Evento</a></li>												
							</ul>
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>MODIFICAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="edit" data-theme="a"><a href="Modificar/modificarPais.php" data-ajax="false">País</a></li>
								<li data-icon="edit" data-theme="a"><a href="Modificar/modificarRegion.php" data-ajax="false">Región</a></li>	
								<li data-icon="edit" data-theme="a"><a href="Modificar/modificarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="edit" data-theme="a"><a href="Modificar/modificarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>	
								<li data-icon="edit" data-theme="a"><a href="Modificar/modificarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>	
								<li data-icon="location" data-theme="a"><a href="Modificar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Modificar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3 >ELIMINAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="delete" data-theme="a"><a href="Eliminar/eliminarPais.php" data-ajax="false">País</a></li>
								<li data-icon="delete" data-theme="a"><a href="Eliminar/eliminarRegion.php" data-ajax="false">Región</a></li>
								<li data-icon="delete" data-theme="a"><a href="Eliminar/eliminarAmenaza.php" data-ajax="false">Amenaza</a></li>	
								<li data-icon="delete" data-theme="a"><a href="Eliminar/buscarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>	
								<li data-icon="delete" data-theme="a"><a href="Eliminar/buscarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>	
								<li data-icon="location" data-theme="a"><a href="Eliminar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Eliminar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';					
			}
			else if($strTipoUsuario==2)
			{
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>USUARIOS</h3>
						<ul data-role="listview">											
							<li data-icon="user" data-theme="a"><a href="Usuarios/index.php" data-ajax="false">Crear Usuario</a></li>					
							<li data-icon="user" data-theme="a"><a href="Usuarios/asignarUsuarioP.php" data-ajax="false">Asignar Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="Usuarios/desasignarUsuarioP.php" data-ajax="false">Desasignar Usuario</a></li>									
							<li data-icon="user" data-theme="a"><a href="Usuarios/modificarInfoUsuario.php" data-ajax="false">Modificar Info Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="Usuarios/eliminarUsuario.php" data-ajax="false">Eliminar Usuario </a></li>					
						</ul>				
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/index.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>AGREGAR INFO A FAST</h3>
							<ul data-role="listview">
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>
								<li data-icon="action" data-theme="a"><a href="Agregar/agregarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>
								<li data-icon="location" data-theme="a"><a href="Agregar/agregarPtoEvaluacion.php" data-ajax="false">Punto de Evaluación</a></li>	
								<li data-icon="calendar" data-theme="a"><a href="Agregar/agregarEvento.php" data-ajax="false">Evento</a></li>												
							</ul>
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>MODIFICAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Modificar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Modificar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3 >ELIMINAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Eliminar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Eliminar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';

			}
			else if($strTipoUsuario==3)
				{							
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/index.php" data-ajax="false">Hiss-Cam</a></li>					
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';	

		}
		else if($strTipoUsuario==4)
		{
	
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';
		}
	}


	function getHeader($tituloPagina = "", $CodigoDentroDeHeader = ""){
		echo '<head>
		<title>' . $tituloPagina . '</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   		

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Estilos -->
		<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />

		<!-- Estilos para menu  
		<link type="text/css" rel="stylesheet" href="css/menu/demo.css" />
		<link type="text/css" rel="stylesheet" href="css/menu/jquery.mmenu.all.css" /> -->


		<!-- Scripts -->
		<script src="js/jquery-2.1.1.js"></script>
		<script src="js/jquery.mobile-1.4.4.min.js"></script>


		<!-- libreria para alertas 
		<script src="js/sweet-alert.js"></script>
		<link rel="stylesheet" href="css/sweet-alert.css">-->


		<!-- Scripts para menu 
		<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script> -->

		<!-- for the fixed header 
		<style type="text/css">
			.header,
			.footer
			{
				position: fixed;
				width: 100%;
				z-index: 100;

				box-sizing: border-box;
			}
			.footer
			{
				bottom: 0;
			}
		</style>-->
		' . $CodigoDentroDeHeader . 


		'

		<!-- <script type="text/javascript">
			function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
				swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
			}
		</script>-->
</head>';
}

	function getMenuNivel2($strTipoUsuario){
			if($strTipoUsuario==1)
			{
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="../home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>USUARIOS</h3>
						<ul data-role="listview">											
							<li data-icon="user" data-theme="a"><a href="../Usuarios/index.php" data-ajax="false">Crear Usuario</a></li>					
							<li data-icon="user" data-theme="a"><a href="../Usuarios/asignarUsuarioP.php" data-ajax="false">Asignar Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="../Usuarios/desasignarUsuarioP.php" data-ajax="false">Desasignar Usuario</a></li>									
							<li data-icon="user" data-theme="a"><a href="../Usuarios/modificarInfoUsuario.php" data-ajax="false">Modificar Info Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="../Usuarios/eliminarUsuario.php" data-ajax="false">Eliminar Usuario </a></li>					
						</ul>				
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/index.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>AGREGAR INFO A FAST</h3>
							<ul data-role="listview">
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarPais.php" data-ajax="false">País</a></li>
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarRegion.php" data-ajax="false">Región</a></li>	
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>
								<li data-icon="location" data-theme="a"><a href="../Agregar/agregarPtoEvaluacion.php" data-ajax="false">Punto de Evaluación</a></li>	
								<li data-icon="calendar" data-theme="a"><a href="../Agregar/agregarEvento.php" data-ajax="false">Evento</a></li>												
							</ul>
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>MODIFICAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarPais.php" data-ajax="false">País</a></li>
								<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarRegion.php" data-ajax="false">Región</a></li>	
								<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>	
								<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>	
								<li data-icon="location" data-theme="a"><a href="../Modificar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Modificar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3 >ELIMINAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="delete" data-theme="a"><a href="../Eliminar/eliminarPais.php" data-ajax="false">País</a></li>
								<li data-icon="delete" data-theme="a"><a href="../Eliminar/eliminarRegion.php" data-ajax="false">Región</a></li>
								<li data-icon="delete" data-theme="a"><a href="../Eliminar/eliminarAmenaza.php" data-ajax="false">Amenaza</a></li>	
								<li data-icon="delete" data-theme="a"><a href="../Eliminar/buscarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>	
								<li data-icon="delete" data-theme="a"><a href="../Eliminar/buscarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>	
								<li data-icon="location" data-theme="a"><a href="../Eliminar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Eliminar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="../logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="../mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="../vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="../developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';					
			}
			else if($strTipoUsuario==2)
			{
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>USUARIOS</h3>
						<ul data-role="listview">											
							<li data-icon="user" data-theme="a"><a href="../Usuarios/index.php" data-ajax="false">Crear Usuario</a></li>					
							<li data-icon="user" data-theme="a"><a href="../Usuarios/asignarUsuarioP.php" data-ajax="false">Asignar Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="../Usuarios/desasignarUsuarioP.php" data-ajax="false">Desasignar Usuario</a></li>									
							<li data-icon="user" data-theme="a"><a href="../Usuarios/modificarInfoUsuario.php" data-ajax="false">Modificar Info Usuario</a></li>
							<li data-icon="user" data-theme="a"><a href="../Usuarios/eliminarUsuario.php" data-ajax="false">Eliminar Usuario </a></li>					
						</ul>				
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/index.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>AGREGAR INFO A FAST</h3>
							<ul data-role="listview">
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarAmenaza.php" data-ajax="false">Amenaza</a></li>
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarPlanMitigacion.php" data-ajax="false">Plan de Mitigación</a></li>
								<li data-icon="action" data-theme="a"><a href="../Agregar/agregarPlanPrevencion.php" data-ajax="false">Plan de Prevención</a></li>
								<li data-icon="location" data-theme="a"><a href="../Agregar/agregarPtoEvaluacion.php" data-ajax="false">Punto de Evaluación</a></li>	
								<li data-icon="calendar" data-theme="a"><a href="../Agregar/agregarEvento.php" data-ajax="false">Evento</a></li>												
							</ul>
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>MODIFICAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Modificar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Modificar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3 >ELIMINAR INFO DE FAST</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Eliminar/buscarPaisPto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Eliminar/buscarEvento.php" data-ajax="false">Evento</a></li>																											
							</ul>				
			    	</div>

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="../logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="../mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="../vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="../developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';

			}
			else if($strTipoUsuario==3)
				{							
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/indexPais.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/indexPunto.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/indexEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>EVALUAR</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/index.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="../logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="../mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="../vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="../developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';	

		}
		else if($strTipoUsuario==4)
		{
	
				echo '	
		  <!-- Menu  -->
		  <div data-role="panel" id="Menu" data-theme="b">
		    	<ul data-role="listview">
			    	<li data-icon="home"><a href="home.php" data-rel="close" data-ajax="false"><center>FAST MENU</center></a></li>

			    	<div data-role="collapsible" data-inset="true">
					<h3>MI INFORMACIÓN</h3>
						<ul data-role="listview">
							<li data-icon="edit" data-theme="a"><a href="../Modificar/modificarMiInfo.php" data-ajax="false">Modificar mi Información</a></li>	
						</ul>
					</div>		    	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CRR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="alert" data-theme="a"><a href="../Crr/buscarReportePaisCrr.php" data-ajax="false">País</a></li>
								<li data-icon="location" data-theme="a"><a href="../Crr/buscarReportePtoCrr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Crr/buscarReporteEventoCrr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>					
			    	</div>

			    	<div data-role="collapsible" data-inset="true">
					<h3>SRA</h3>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../sra/buscarReportePtoSra.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../sra/buscarReporteEventoSra.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>				    	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>CSR</h3>
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Csr/buscarReportePtoCsr.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../Csr/buscarReporteEventoCsr.php" data-ajax="false">Evento</a></li>
							</ul>	
				    	</div>	
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>HISS-CAM</h3>	
				    	<div data-role="collapsible" data-inset="true">
						<h3>REPORTES</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../Hiss-Cam/buscarReportePtoHiss.php" data-ajax="false">Hiss-Cam</a></li>
							</ul>	
				    	</div>					
			    	</div>	

			    	<div data-role="collapsible" data-inset="true">
					<h3>QUICK VIEW</h3>
							<ul data-role="listview">
								<li data-icon="location" data-theme="a"><a href="../QuickView/index.php" data-ajax="false">Punto de Evaluación</a></li>
								<li data-icon="calendar" data-theme="a"><a href="../QuickView/buscarEvento.php" data-ajax="false">Evento</a></li>
							</ul>					
			    	</div>			    		    		    		    	

			    	<ul data-role="listview">
			    	<li data-icon="back" data-theme="a"><a href="../logOut.php" data-ajax="false" rel="external">Log Out</a></li>
			    	</ul>		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About WORLD VISION</a></h3>
						<ul data-role="listview">
							<li data-icon="star" data-theme="a"><a href="../mision.php">Misión</a></li>
							<li data-icon="star" data-theme="a"><a href="../vision.php">Visión</a></li>
						</ul>
			    	</div>			    		

			    	<div data-role="collapsible" data-inset="true">
					<h3><a>About FAST</a></h3>
						<ul data-role="listview">
							<li data-icon="info" data-theme="a"><a href="../developers.php">Developers</a></li>
						</ul>
			    	</div>		    	    			    	

		    	</ul>		    	
		  </div>
		  <!-- /Menu -->
';
		}
	}

function getHeaderNivel2($tituloPagina = "", $CodigoDentroDeHeader = ""){
	echo '<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
	<title>' . $tituloPagina . '</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Estilos -->
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.4.min.css" />

	<!-- Estilos para menu 
	<link type="text/css" rel="stylesheet" href="../css/menu/demo.css" /> -->

	<link type="text/css" rel="stylesheet" href="../css/menu/jquery.mmenu.all.css" />

	<!-- Scripts -->
	<script src="../js/jquery-2.1.1.js"></script>		
<script src="../js/jquery.mobile-1.4.4.min.js"></script>


<!-- libreria para alertas -->
<script src="../js/sweet-alert.js"></script>
<link rel="stylesheet" href="../css/sweet-alert.css">


<!-- Scripts para menu 
<script type="text/javascript" src="../js/menu/jquery.mmenu.min.all.js"></script>-->
<!-- for the fixed header 
<style type="text/css">
	.header,
	.footer
	{
		position: fixed;
		width: 100%;
		z-index: 100;
		box-sizing: border-box;
	}
	.footer
	{
		bottom: 0;
	}
</style>-->
' . $CodigoDentroDeHeader . '


<script>
	function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
		swal(TituloMensaje, CuerpoMensaje, TipoMensaje);

	}
</script>


</head>';
}

function getHeaderPage($TituloDePagina = ""){
	echo '
	<!-- headerPage -->
	<div data-role="header" data-position="fixed"  >	
	<a href="#Menu" class="ui-btn ui-icon-bars ui-btn-icon-notext ui-corner-all"></a>
		<div style="text-align:center; ">
		<br><font size="5">'. $TituloDePagina .'</font>
		</div>
		<div style="position: absolute; right:0; top: 0; ">
		<img src="img/logo-fit.png" alt="logo" width="100px" />
		</div>	
	</div>
	<!-- /headerPage -->
	';
}

function getHeaderPageNivel2($TituloDePagina = ""){
	echo '
	<!-- headerPage -->
	<div data-role="header" data-position="fixed"  >	
	<a href="#Menu" class="ui-btn ui-icon-bars ui-btn-icon-notext ui-corner-all"></a>
		<div style="text-align:center; ">
		<br><font size="5">'. $TituloDePagina .'</font>
		</div>
		<div style="position: absolute; right:0; top: 0; ">
		<img src="../img/logo-fit.png" alt="logo" width="100px" />
		</div>	
	</div>
	<!-- /headerPage -->
	';
}

	/**
		Funcion para construir el footer de cada pagina.
	 */
		function getFooter(){
			echo '	
			<!-- footer -->
		  	<div data-role="footer" data-position="fixed" >
			<h1>World Vision Guatemala,2015 </h1>
				<div style="position: absolute; right:0; top: 0; ">
				<img src="img/logo-fit.png" style="width:85px; height:20px; margin-top:1px;"/>		
				</div>			
			</div> 
			<!-- /footer -->

		<!-- <script type="text/javascript">
			function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
				swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
			}
		</script>-->
		';

	}

	function getFooterNivel2(){
			echo '	
			<!-- footer -->
		  	<div data-role="footer" data-position="fixed" >
			<h1>World Vision Guatemala,2015 </h1>
				<div style="position: absolute; right:0; top: 0; ">
				<img src="../img/logo-fit.png" style="width:85px; height:20px; margin-top:1px;"/>		
				</div>			
			</div> 
		 	<!-- /footer -->

		<!-- <script type="text/javascript">
			function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
				swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
			}
		</script>-->
		';

}

		/**
		FUNCIONES PARA USUARIOS
		*/

		function getListaUsuariosNoSuper($idUsuarioLogeado){
			//devuelve la lista de usuarios menos el logueado
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idUSUARIO, correo FROM USUARIO WHERE idUSUARIO !='$idUsuarioLogeado' and fk_idTIPO_USUARIO !=1");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaUsuarios($idUsuarioLogeado){
			//devuelve la lista de usuarios menos el logueado
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idUSUARIO, correo FROM USUARIO WHERE idUSUARIO !='$idUsuarioLogeado'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaUsuarios2($idUsuarioLogeado){
			//devuelve la lista de usuarios reporteros y consultores de pais menos el logueado
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idUsuario, correo FROM usuario WHERE idUsuario IN(
					SELECT fk_idUSUARIO FROM asignacion_usuario_pais WHERE fk_idPAIS IN(
						SELECT fk_idPAIS FROM asignacion_usuario_pais WHERE fk_idUSUARIO = '$idUsuarioLogeado') AND fk_idUSUARIO != '$idUsuarioLogeado' AND fk_idTIPO_USUARIO NOT IN (1,2));");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function getTipoUsuarios(){
			//tablas,campos,restricciones,agrupacion, ordenamiento
			try {
				$result = $this->db->Consultar("tipo_usuario", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getTipoUsuarios2(){
			//devuelve el tipo de usuario que no son super administradores ni administradores de pais
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idTIPO_USUARIO, nombretipo FROM TIPO_USUARIO WHERE idTIPO_USUARIO NOT IN (1,2)");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getIdUsuario($strUsuario){
			//devuelve el id del usuario
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idUSUARIO FROM USUARIO WHERE CORREO='$strUsuario'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$idUsuario=$row[0];				
				}				
				return $idUsuario;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function getInfoUsuario($idUsuario){
			//devuelve toda la informacion del usuario
			try {
				$result = $this->db->ExecutePersonalizado("SELECT * FROM USUARIO WHERE idUsuario='$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function asignarUsuario($idPais,$strUsuario){
			try {

				$strTablaPais = " asignacion_usuario_pais ";
				$strCamposPais = " fk_idPAIS,fk_idUSUARIO ";
				$strValoresPais = $idPais. "," . $strUsuario. " ";
				$result = $this->db->Insertar($strTablaPais, $strCamposPais, $strValoresPais);
				if($result){
					return 1;
				}else{
					return -2;
				}				

			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al asignar usuario: ' . $e->getMessage();
				return;
			}							
		}

		function desasignarUsuarioP($idUsuario, $idPais){
			//desasigna el usuario al pais especifico
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM asignacion_usuario_pais WHERE fk_idPAIS = '$idPais' AND fk_idUSUARIO = '$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function eliminarUsuario($idUsuario){
			//elmimina el usuario del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM USUARIO WHERE idUsuario = '$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}					

		function InsertarUsuario($strNombreUsuario, $strApellidoUsuario, $strCorreoUsuario, $strPassword, $intTipoUsuario, $strPaisUsuario){
			//validaciones 
			
			//nombre no vacio
			if($strNombreUsuario == ""){
				echo 'El nombre del usuario no puede ser vacío.';
				return;
			}

			//Apellido no vacio
			if($strApellidoUsuario == ""){
				echo 'El apellido del usuario no puede ser vacío.';
				return;
			}

			if($strCorreoUsuario == ""){
				echo 'El correo del usuario no puede ser vacío.';
				return;
			}

			if($strPassword == ""){
				echo 'El password del usuario no puede ser vacío.';
				return;
			}

			if($intTipoUsuario == null || $intTipoUsuario == ""){
				echo 'Debe elegir un tipo de usuario.';
				return;
			}

			if($strPaisUsuario == null || $strPaisUsuario == ""){
				echo 'Debe elegir un país para el usuario.';
				return;
			}

			//validaciones han pasado
			//inicia la insercion
			try {
				$strTabla = " usuario ";
				$strCampos = " nombre, apellido, correo, password, fk_idTIPO_USUARIO "; 
				$strValores = " '" . $strNombreUsuario . "', '" . $strApellidoUsuario . "', '" . $strCorreoUsuario . "', " ; 
				$strValores .= " '" . $this->getMD5($strPassword) . "', " . $intTipoUsuario . " " ;
				$idInsertado = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);				
				//se inserta el pais con el usuario  en la tabla asignacion_usuario_pais				
				$strTablaPais = " asignacion_usuario_pais ";
				$strCamposPais = "fk_idPAIS, fk_idUSUARIO";
				$strValoresPais = $strPaisUsuario . "," . $idInsertado . " ";
				$result2 = $this->db->Insertar($strTablaPais, $strCamposPais, $strValoresPais);
				if($result2){
					return 1;
				}else{
					return -2;
				}
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar el nuevo usuario';
				return;
			}
		}

		function verificarExistenciaAsignacion($idUsuario, $idPais){
			//devuelve la lista de usuarios resporteros y consultores de pais menos el logueado
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idASIGNACION_USUARIO_PAIS from asignacion_usuario_pais WHERE fk_idUSUARIO ='$idUsuario' AND fk_idPAIS='$idPais';");
				if(mysqli_num_rows($result)>0){

					return 0;

				}
				else{
					return 1;
				}
				
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function verificarExistenciaUsuarioUpdate($variable, $idUsuario){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$correo = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT correo FROM USUARIO WHERE correo='$correo'  AND idUSUARIO !='$idUsuario'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$correo)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function modificarUsuario($nombre, $apellido, $correo, $pass, $idUsuario){
			try {
				$password = $this->getMD5($pass);
				$_SESSION["passwordUsuario"] = $pass;	
				$result = $this->db->ExecutePersonalizado("UPDATE USUARIO SET nombre='$nombre', apellido='$apellido', correo='$correo', password='$password' WHERE idUSUARIO='$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function modificarUsuarioNoPass($nombre, $apellido, $correo, $idUsuario){
			
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE USUARIO SET nombre='$nombre', apellido='$apellido', correo='$correo' WHERE idUSUARIO='$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function modificarInfoUsuario($nombre, $apellido, $pass, $idUsuario){
			//modifica una amenaza en el sistema
			try {
				$password = $this->getMD5($pass);
				$result = $this->db->ExecutePersonalizado("UPDATE USUARIO SET nombre='$nombre', apellido='$apellido', password='$password' WHERE idUSUARIO='$idUsuario'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}				

		/**
		FUNCIONES PARA PAISES
		*/
		function getListaPaises($idUsuarioLogeado = ""){
			//carga en un select, el id y nombre de todos los paises
			try {
				$strTabla = "";				
				$strCampos = "";
				$strRestricciones = "";
				if($idUsuarioLogeado != ""){
					$strTabla = " pais p, asignacion_usuario_pais aup ";
					$strCampos = " p.* ";
					$strRestricciones = " p.idPAIS = aup.fk_idPAIS AND aup.fk_idUSUARIO = " . $idUsuarioLogeado . " ";
				}else{
					$strTabla = " pais ";
					$strCampos = " * ";
					$strRestricciones = "";
				}
				$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones);
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaPaisesAsignados($idUsuario){
			//devuelve la lista de los paises en los cuales un usuario esta asignado
			try {
				$result = $this->db->ExecutePersonalizado("SELECT * FROM PAIS WHERE idPAIS IN (SELECT fk_idPAIS FROM asignacion_usuario_pais WHERE fk_idUSUARIO='$idUsuario')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function contarPaisesAsignados($idUsuario){
			//cuenta a cuentos paises aun esta asignado el usuario
			try {
				$result = $this->db->ExecutePersonalizado("SELECT COUNT(idPAIS) FROM PAIS WHERE idPAIS IN (SELECT fk_idPAIS FROM asignacion_usuario_pais WHERE fk_idUSUARIO='$idUsuario')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function getNombrePais($idPais){
			//devuelve el nombre de un pais especifico
			try {
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PAIS WHERE idPAIS='$idPais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function verificarExistenciaPais($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombrePais=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PAIS WHERE nombre='$nombrePais'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombrePais)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	
		

		function verificarExistenciaPaisUpdate($variable, $idPais){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$nombrePais = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PAIS WHERE nombre='$nombrePais'  AND idPAIS !='$idPais'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombrePais)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}				

		function insertarPais($nombrePais, $idRegion){
			//agrega un nuevo pais al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO PAIS (nombre, fk_idREGION) VALUES('$nombrePais', '$idRegion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function eliminarPais($pais){
			//elimina pais del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM PAIS WHERE idPais='$pais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function getInfoPais($idPais){
			//devuelve el nombre de un pais especifico
			try {
				$result = $this->db->ExecutePersonalizado("SELECT * FROM PAIS WHERE idPAIS='$idPais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function modificarPais($nombrePais, $idRegion, $idPais){
			//modifica un pais en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE PAIS SET nombre='$nombrePais', fk_idREGION='$idRegion' WHERE idPAIS='$idPais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		



		/**
		FUNCIONES PARA REGIONES
		*/
		function getListaRegiones(){
			//carga en un select, el id y nombre de todas las regiones
			try {
				$result = $this->db->Consultar("region", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function verificarExistenciaRegion($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombreRegion=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM REGION WHERE nombre='$nombreRegion'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombreRegion)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getInfoRegion($idRegion){
			//devuelve toda la informacion de una region especifica
			try {

				$result = $this->db->ExecutePersonalizado("SELECT * FROM REGION WHERE idREGION='$idRegion'");
				return $result;

			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function insertarRegion($nombreRegion){
			//agrega una nueva region al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO REGION (nombre) VALUES('$nombreRegion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function eliminarRegion($region){
			//elimina region del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM REGION WHERE idRegion='$region'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function verificarExistenciaRegionUpdate($variable, $idRegion){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$nombreRegion = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM REGION WHERE nombre='$nombreRegion'  AND idREGION !='$idRegion'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombreRegion)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}


		function modificarRegion($nombreRegion, $idRegion){
			//modifica un pais en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE REGION SET nombre='$nombreRegion' WHERE idREGION='$idRegion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}					
		/**
		 FUNCIONES PARA PUNTOS DE EVALUACION
		 */
		 function verificarExistenciaPtoEvaluacion($variable, $idPais){
			//verifica si ya existe un Punto de Evaluacion con dicho nombre
		 	try {
		 		$nombrePtoEvaluacion = trim($variable," \t\n\r\0\x0B");
		 		$result = $this->db->ExecutePersonalizado("SELECT nombre, PAIS_idPAIS FROM PUNTO_EVALUACION WHERE nombre='$nombrePtoEvaluacion' AND PAIS_idPAIS='$idPais'");
		 		while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
		 			if(strcasecmp($row[0],$nombrePtoEvaluacion)==0 AND strcasecmp($row[1],$idPais)==0 ){

		 				return true;
		 			}
		 			else{
		 				return false;
		 			}

		 		}
		 	} catch (Exception $e) {
		 		echo 'Error: ' .$e->getMessage();
		 	}
		 }

		function verificarExistenciaPtoEvaluacionUpdate($variable, $idPais, $idPtoEvaluacion){
			//verifica si ya existe un Punto de Evaluacion con dicho nombre
			try {
				$nombrePtoEvaluacion = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre, PAIS_idPAIS FROM PUNTO_EVALUACION WHERE nombre='$nombrePtoEvaluacion' AND PAIS_idPAIS='$idPais' AND idPUNTO_EVALUACION != '$idPtoEvaluacion' ");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombrePtoEvaluacion)==0 AND strcasecmp($row[1],$idPais)==0 ){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function insertarPtoEvaluacion($nombrePtoEvaluacion, $latitud, $longitud, $descripcion, $idPais){
			//agrega un  Punto de Evaluacion al sistema
		 	try {
		 		$result = $this->db->ExecutePersonalizado("INSERT INTO PUNTO_EVALUACION (nombre, latitud, longitud, descripcion, PAIS_idPAIS) VALUES ('$nombrePtoEvaluacion', '$latitud','$longitud', '$descripcion', '$idPais')");
		 		return $result;
		 	} catch (Exception $e) {
		 		echo 'Error: ' .$e->getMessage();
		 	}
		 }

		 function getListaPtosEvaluacion($pais){
		 	try{
		 		$result = $this->db->ExecutePersonalizado("SELECT idPUNTO_EVALUACION, nombre FROM PUNTO_EVALUACION WHERE PAIS_idPAIS='$pais'");
		 		return $result;
		 	}catch(Exception $e){
		 		echo 'Error: ' .$e->getMessage();
		 	}

		 }

		 function getListaPuntosEvaluacionConSRAPais($idPais){
		 	try{
		 		$result = $this->db->ExecutePersonalizado("SELECT idPUNTO_EVALUACION, NombreTipoObjeto, fk_NIVEL_RIESGO FROM RESULTADO_SRA WHERE idPUNTO_EVALUACION IN (SELECT idPUNTO_EVALUACION FROM PUNTO_EVALUACION WHERE PAIS_idPAIS='$idPais') ORDER BY FechaCreacion ASC LIMIT 1;");
		 		return $result;
		 	}catch(Exception $e){
		 		echo 'Error: ' .$e->getMessage();
		 	}

		 }		 

		function getPtoEvaluacion($idPtoEvaluacion){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT idPUNTO_EVALUACION, Nombre, Latitud, Longitud, Descripcion FROM PUNTO_EVALUACION WHERE idPUNTO_EVALUACION = $idPtoEvaluacion");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}		

		function eliminarPtoEvaluacion($ptoEvaluacion){
			//elimina un Punto de Evaluacion del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM PUNTO_EVALUACION WHERE idPUNTO_EVALUACION='$ptoEvaluacion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}			

		function modificarPtoEvaluacion($nombrePtoEvaluacion, $descripcion, $latitud, $longitud, $idPais, $idPtoEvaluacion){
			//modifica un Punto de Evaluacion en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE PUNTO_EVALUACION SET nombre='$nombrePtoEvaluacion', descripcion='$descripcion', latitud='$latitud', longitud='$longitud', PAIS_idPAIS='$idPais' WHERE idPUNTO_EVALUACION='$idPtoEvaluacion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function getPtosPais($idPais){
			//modifica un Punto de Evaluacion en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("SELECT idPUNTO_EVALUACION, Nombre, Latitud, Longitud FROM PUNTO_EVALUACION WHERE PAIS_idPais = $idPais");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		



		/**
		FUNCIONES PARA AMENAZAS
		*/	

		function getAmenazas($idAmenaza = -1){
			$strHtml = "";
			$strTabla = " amenaza ";
			$strCampos = " * ";
			$strRestricciones = "";
			if($idAmenaza != -1){
				$strRestricciones .= " idAMENAZA = " . $idAmenaza . " ";
			}			
			try {
				$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaAmenazas(){
			//carga en un select, el id y nombre de todas las amenazas
			try {
				$result = $this->db->Consultar("amenaza", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function verificarExistenciaAmenaza($variable){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$nombreAmenaza = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM AMENAZA WHERE nombre='$nombreAmenaza'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp(str_replace("'","''",$row[0]),$nombreAmenaza)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function verificarExistenciaAmenazaUpdate($variable, $idAmenaza){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$nombreAmenaza = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM AMENAZA WHERE nombre='$nombreAmenaza'  AND idAMENAZA !='$idAmenaza'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombreAmenaza)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function eliminarAmenaza($amenaza){
			//elimina una Amenaza del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM AMENAZA WHERE idAMENAZA='$amenaza'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function insertarAmenaza($nombreAmenaza, $descripcion){
			//agrega una Amenza al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO AMENAZA (nombre, descripcion) VALUES ('$nombreAmenaza', '$descripcion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function modificarAmenaza($nombreAmenaza, $descripcion, $idAmenaza){
			//modifica una amenaza en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE AMENAZA SET nombre='$nombreAmenaza', descripcion='$descripcion' WHERE idAMENAZA='$idAmenaza'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}									


/**
	FUNCIONES PARA PUNTOS DE EVALUACION
*/
	function ConsultarPuntosEvaluacion($intIdPais = -1){		
		$strTabla = " punto_evaluacion ";
		$strCampos = " * ";
		$strRestricciones = "";
		if($intIdPais != -1){
			$strRestricciones = " PAIS_idPAIS = " . $intIdPais . " ";
		}
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	/**
		FUNCIONES VARIAS
	*/
		function getMD5($strPassword){
			return md5($strPassword);
		}



/**
	FUNCIONES PARA EVALUACION SRA
*/
	//insertamos una nueva evaluacion 
	function CrearEvaluacionSra($intIdUsuario, $strFecha, $strElaboradoPor, $intIdPuntoEvaluacion = -1, $intIdEvento = -1){
		//CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, $idPuntoEvaluacion);
		try {
			$strTabla = " evaluacion ";
			$strCampos = " fk_idUSUARIO, Fecha, Creador";
			//$parts = explode('/', $strFecha);
			$date  = $strFecha;//"$parts[2]-$parts[0]-$parts[1]";
			// $fecha = explode("/",$strFecha);
			// $NuevaFecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
			$strValores = " " . $intIdUsuario . ", '" . $date . "', '" . $strElaboradoPor . "' ";

			if($intIdPuntoEvaluacion != -1){
				$strCampos .= ", fk_idPUNTO_EVALUACION ";
				$strValores .= ", " . $intIdPuntoEvaluacion . " ";
			}else{
				$strCampos .= ", fk_idEVENTO ";
				$strValores .= ", " . $intIdEvento . " ";
			}

			$idInsertado = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);				
			return $idInsertado;
		} catch (Exception $e) {
				//no se pudo realizar la insercion
			echo 'Error al crear la evaluacion. ' . $e->getMessage();
			return;
		}
	}


	function ValidarLogin($strUsuario, $strPassword, $strTipoUsuario){
		//funcion para validar que el usuario exista y setear la variable del id del usuario si es que existe
		$strTabla = " usuario ";
		$strCampos = " * ";
		$strRestricciones = " correo = '" . $strUsuario . "' AND password = '" . $this->getMD5($strPassword) . "' AND fk_idTIPO_USUARIO = " . $strTipoUsuario . " ";		
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			$rowcount=mysqli_num_rows($result);
			// $cont = 0;
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {					
				$_SESSION["idUsuario"] = $row[0];		
				$_SESSION["passwordUsuario"] = $strPassword;		
			}			
			if($rowcount > 0){
				return true;
			}else{
				$_SESSION["idUsuario"] = "";
				return false;
			}			
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}


	function ConsultarNivelesDeRiesgo(){
		$strTabla = " nivel_riesgo ";
		$strCampos = " * ";
		$strRestricciones = "";		
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function InsertarEvalAmenazas($idAmenaza, $impacto, $probabilidad, $idEvaluacion, $nivelRiesgo){
		//fk_idAMENAZA, impacto, probabilidad, fk_idEVALUACION, fk_idNIVEL_RIESGO		
		try {
			$strCampos = " fk_idAMENAZA, impacto, probabilidad, fk_idEVALUACION, fk_idNIVEL_RIESGO ";
			$strValores = " " . $idAmenaza . "," . $impacto . "," . $probabilidad . "," . $idEvaluacion . "," . $nivelRiesgo . " ";
			$strTabla = " sra ";
			$idInsertado = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);
			return $idInsertado;
		} catch (Exception $e) {
			return -1;
		}
	}

/**
	FUNCIONES PARA EVENTOS
*/	
	function CrearEvento(){
		$strTabla = " EVENTO ";
		$strCampos = " nombre, localidad, descripcion,fecha_evento";
		$strRestricciones = "";		
		$fecha = explode("/",$strFecha);
		$NuevaFecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
		$strValores = " " . $intIdUsuario . ", '" . $NuevaFecha . "', '" . $strElaboradoPor . "' ";

		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

		function getListaEventos(){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM EVENTO");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}	

		function getInfoEvento($idEvento){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM EVENTO WHERE idEVENTO= '$idEvento'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}	

		function getNombreEvento($idEvento){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM EVENTO WHERE idEVENTO= '$idEvento'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}			

		function verificarExistenciaEvento($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombreEvento=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM EVENTO WHERE nombre='$nombreEvento'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombreEvento)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	


		function verificarExistenciaEventoUpdate($variable, $idEvento){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombreEvento=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM EVENTO WHERE nombre='$nombreEvento' AND idEVENTO !='$idEvento'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombreEvento)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}			

		function eliminarEvento($idEvento){
			//elimina una Amenaza del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM EVENTO WHERE idEVENTO='$idEvento'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	


		function insertarEvento($nombreEvento, $localidad, $descripcion, $latitud, $longitud, $fecha){
			//agrega un nuevo evento al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO EVENTO (nombre, localidad, descripcion, latitud, longitud, fecha_evento) VALUES('$nombreEvento', '$localidad', '$descripcion', '$latitud', '$longitud', '$fecha')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function modificarEvento($nombreEvento, $descripcion, $localidad, $latitud, $longitud, $fecha, $idEvento){
			//modifica una evento en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE EVENTO SET nombre='$nombreEvento', descripcion='$descripcion', localidad='$localidad', latitud='$latitud', longitud='$longitud', fecha_evento='$fecha' WHERE idEVENTO='$idEvento'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}								

	/**
	FUNCIONES PARA PLAN DE MITIGACION
	 */		
	
			function verificarExistenciaPlanMitigacion($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombreMitigacion=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM MITIGACION WHERE nombre='$nombreMitigacion'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp(str_replace("'","''",$row[0]),$nombreMitigacion)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function verificarExistenciaPlanMitigacionUpdate($variable, $idPlan){
			//verifica si ya existe un Plan  con dicho nombre
			try {
				$nombrePlan = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM MITIGACION WHERE nombre='$nombrePlan'  AND idMITIGACION !='$idPlan'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombrePlan)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function getListaMitigaciones(){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM MITIGACION");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}


		function getInfoMitigacion($idMitigacion){
			// devuelve toda la informacion relacionada con un Plan de Mitigacion especifico
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM MITIGACION WHERE idMITIGACION='$idMitigacion'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

		function eliminarPlanMitigacion($idMitigacion){
			//elimina un Plan de mitigacion especifico  del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM MITIGACION WHERE idMITIGACION='$idMitigacion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function insertarPlanMitigacion($nombreMitigacion, $descripcion){
			//agrega un nuevo plan de Mitigacion al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO MITIGACION (nombre, descripcion) VALUES('$nombreMitigacion', '$descripcion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function modificarPlanMitigacion($nombrePlan, $descripcion, $idPlan){
			//modifica una amenaza en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE MITIGACION SET nombre='$nombrePlan', descripcion='$descripcion' WHERE idMITIGACION='$idPlan'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}										
	
	/**
	FUNCIONES PARA PLAN DE PREVENCION
	 */	
		function verificarExistenciaPlanPrevencion($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombrePrevencion=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PREVENCION WHERE nombre='$nombrePrevencion'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp(str_replace("'","''",$row[0]),$nombrePrevencion)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function verificarExistenciaPlanPrevencionUpdate($variable, $idPlan){
			//verifica si ya existe un Plan  con dicho nombre
			try {
				$nombrePlan = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PREVENCION WHERE nombre='$nombrePlan'  AND idPREVENCION !='$idPlan'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp(str_replace("'","''",$row[0]),$nombrePlan)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function getListaPrevenciones(){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM PREVENCION");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}	


		function getInfoPrevencion($idPrevencion){
			//devuelve informacion relacionada con un Plan de Prevencion especifico
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM PREVENCION WHERE idPrevencion='$idPrevencion'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

		function eliminarPlanPrevencion($idPrevencion){
			//elimina una Amenaza del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM PREVENCION WHERE idPrevencion='$idPrevencion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function insertarPlanPrevencion($nombrePrevencion, $descripcion){
			//agrega un nuevo plan de Prevencion al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO PREVENCION (nombre, descripcion) VALUES('$nombrePrevencion', '$descripcion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}


		function modificarPlanPrevencion($nombrePlan, $descripcion, $idPlan){
			//modifica una amenaza en el sistema
			try {
				$result = $this->db->ExecutePersonalizado("UPDATE PREVENCION SET nombre='$nombrePlan', descripcion='$descripcion' WHERE idPREVENCION='$idPlan'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

/**
 FUNCIONES PARA REQUERIMIENTOS MINIMOS DE SEGURIDAD
 */
		function getRequerimientosMinimosCategoria($idCategoria, $idNivelRiesgo){
			//devuelve los requerimientos minimos para una Categoria de Requerimientos y Nivel de Riesgo especifico
			try{
				$result = $this->db->ExecutePersonalizado("SELECT idPREGUNTA_CSR, pregunta, requerimiento_minimo FROM PREGUNTA_CSR WHERE fk_idCATEGORIA_CSR='$idCategoria' AND fk_idNIVEL_RIESGO='$idNivelRiesgo'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

		function getRequerimientoMinimo($idRequerimiento){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT pregunta FROM PREGUNTA_CSR WHERE idPREGUNTA_CSR ='$idRequerimiento'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

		function getCantidadRequerimientosMinimosCategoria($idCategoria, $idNivelRiesgo){
			//devuelve los requerimientos minimos para una Categoria de Requerimientos y Nivel de Riesgo especifico
			try{
				$result = $this->db->ExecutePersonalizado("SELECT COUNT(*) FROM PREGUNTA_CSR WHERE fk_idCATEGORIA_CSR='$idCategoria' AND fk_idNIVEL_RIESGO='$idNivelRiesgo'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}		

		function getCantidadRequerimientos($idNivelRiesgo){
			//devuelve los requerimientos minimos para un Nivel de Riesgo especifico
			try{
				$result = $this->db->ExecutePersonalizado("SELECT COUNT(*) FROM PREGUNTA_CSR WHERE fk_idNIVEL_RIESGO='$idNivelRiesgo'");
				$row = mysqli_fetch_array($result, MYSQL_NUM);
				return $row[0];

				
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}		


	function getPlanesPrevencion(){
		$strTabla = " Prevencion ";
		$strCampos = " * ";
		$strRestricciones = "";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function getPlanesMitigacion(){
		$strTabla = " Mitigacion ";
		$strCampos = " * ";
		$strRestricciones = "";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}



	function getEval($idEvaluacion){
		$strTabla = " evaluacion ";
		$strCampos = " * ";
		$strRestricciones = " idEVALUACION = " . $idEvaluacion . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function ConsultarUsuario($idUsuario){
		$strTabla = " usuario ";
		$strCampos = " * ";
		$strRestricciones = " idUSUARIO = " . $idUsuario . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function ConsultarPuntoEvaluacion($idPuntoEvaluacion){
		$strTabla = " punto_evaluacion ";
		$strCampos = " * ";
		$strRestricciones = " idPUNTO_EVALUACION = " . $idPuntoEvaluacion . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function ConsultarEvento($idEvento){
		$strTabla = " evento ";
		$strCampos = " * ";
		if($idEvento != -1){
			$strRestricciones = " idEVENTO = " . $idEvento . " ";
		}	
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	function insertarReporteSra($FechaCreacion, $htmlReporte, $Usuario, $TipoObjeto, $NombreObjeto, $idPuntoEval, $descripcion){
		try {
				$strTabla = " resultado_sra ";
				$strCampos = "";
				$strValores = "";
					$strCampos = "  fecha_creacion, html_reporte, usuario, tipo_objeto, nombre_tipo_objeto, idPUNTO_EVALUACION, descripcion_evaluacion ";
					$strValores = "'" . $FechaCreacion . "','" . $htmlReporte . "','" . $Usuario . "', "  . $TipoObjeto . ", '" . $NombreObjeto . "', " . $idPuntoEval . ", '" . $descripcion . "' ";				
				//return "INSERT INTO " . $strTabla . "(" . $strCampos . ") VALUES(" . $strValores . ")";
				$result = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);
				if($result > 0){
					return $result;
				}else{
					return -1;
				}
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar reporte sra: ' . $e->getMessage();
				return;
			}
	}

	function getReporteSra($idReporteSra){
		$strTabla = " resultado_sra ";
		$strCampos = " * ";
		$strRestricciones = " idRESULTADO_SRA = " . $idReporteSra . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	/**
	FUNCIONES PARA RIESGOS
	 */
		function getNivelRiesgo(){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT * FROM NIVEL_RIESGO");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

	/**
	FUNCIONES PARA CRR
	 */		
		function getCrr($idPuntoEvaluacion){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT nivel_riesgo FROM RESULTADO_CRR WHERE fk_idPUNTO_EVALUACION = '$idPuntoEvaluacion' ORDER BY idRESULTADO_CRR DESC limit 1;");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}	

		function getCrrEvento($idEvento){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT nivel_riesgo FROM RESULTADO_CRR WHERE fk_idEVENTO ='$idEvento' ORDER BY idRESULTADO_CRR DESC limit 1;");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}		


/**
 FUNCIONES PARA CORREO ELECTRÓNICO 
 Esta funcion recibe uno o una lista de destinatarios a entregar el correo
 un asunto, el mensaje 
 */
 function EnviarCorreo($destinatarios, $Asunto, $mensaje){
 	try {
 		$headers = "De: visionmundial@vm.com\r\n";
 		// $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n"; 		
 		$headers .= "MIME-Version: 1.0\r\n";
 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 		$mensaje = "<html><head></head><body>" . $mensaje . "</body></html>";
 		$arrDestinatarios = explode(",",$destinatarios);

 		foreach ($arrDestinatarios as $Correo) {
 			mail($Correo, $Asunto, $mensaje, $headers);	

 		} 		
 		//echo str_replace("<","-",$mensaje);
 	} catch (Exception $e) {
 		echo "Ha ocurrido un error y no se ha podido enviar el correo.";
 	}
 }


 function getHtmlReporteSRA($idReporte){
 	try {
 		$result = $this->db->ExecutePersonalizado("SELECT html_reporte FROM `resultado_sra` WHERE idRESULTADO_SRA = " . $idReporte . " ");
 		return $result;
 	} catch (Exception $e) {
 		echo 'Error: ' .$e->getMessage();
 	}
 }

/**
 FUNCIONES PARA CSR
 */

	function insertarReporteCsr($FechaCreacion, $htmlReporte, $Usuario, $idNivelRiesgo, $idPuntoEval, $idEvento, $nombreObjeto){
		try {

				$strSql = "";			
				$strSql = "INSERT INTO resultado_csr (fecha_creacion, html_reporte, usuario, fk_NIVEL_RIESGO,  idPUNTO_EVALUACION, idEvento, nombre_objeto ) VALUES('$FechaCreacion', '$htmlReporte', '$Usuario', '$idNivelRiesgo', '$idPuntoEval', '$idEvento', '$nombreObjeto' );";
					$result = mysqli_query($this->db->link,$strSql) or die(mysql_error());
					$id = mysqli_insert_id($this->db->link);
					return $id;
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar reporte sra: ' . $e->getMessage();
				return;
			}
	}

function insertarReporteHissCam($NombreDepartamento, 
								$FechaReporte, 
								$Tema, 
								$PaisRegion, 
								$EjercitoOtro, 
								$NivelCompromiso, 
								$HtmlReporte){
		try {
				$strTabla = " hiss_cam_reporte ";
				$strCampos = "";
				$strValores = "";
					$strCampos = "  nombre_departamento, 
									fecha_reporte, 
									tema, 
									pais_region, 
									ejercito_otro_actor, 
									nivel_compromiso, 
									html_reporte ";
					$strValores = "'" . $NombreDepartamento . "','" . $FechaReporte . "','" . $Tema . "', '" . $PaisRegion . "', '" . $EjercitoOtro . "', '" . $NivelCompromiso . "', '" . $HtmlReporte . "' ";
				//return "INSERT INTO " . $strTabla . "(" . $strCampos . ") VALUES(" . $strValores . ")";
				$result = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);
				if($result > 0){
					return $result;
				}else{
					return -1;
				}
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar reporte hisscam: ' . $e->getMessage();
				return;
			}
	}

	function getReporteCsr($idReporteCsr){
		$strTabla = " resultado_csr ";
		$strCampos = " * ";
		$strRestricciones = " idRESULTADO_CSR = " . $idReporteCsr . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	 function getReportesCsrPtos($strTipoUsuario,$idUsuario){
	 	try {
	 			if($strTipoUsuario ==1){
	 		
	 				$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CSR, fecha_creacion, html_reporte, pais.nombre, usuario, nombre_objeto 
	 															FROM resultado_csr, punto_evaluacion, pais
																WHERE resultado_csr.idPUNTO_EVALUACION = punto_evaluacion.idPUNTO_EVALUACION 
                                                                and PAIS_idPAIS=pais.idPAIS
                                                                and resultado_csr.idPUNTO_EVALUACION>0;");	 			
	 			}
	 			else{

	 				$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CSR, fecha_creacion, html_reporte, pais.nombre, usuario, nombre_objeto 
	 															FROM resultado_csr, punto_evaluacion, pais
																WHERE resultado_csr.idPUNTO_EVALUACION IN
																(SELECT idPUNTO_EVALUACION FROM punto_evaluacion WHERE PAIS_idPAIS IN 
                                                                (SELECT fk_idPAIS FROM asignacion_usuario_pais WHERE fk_idUSUARIO =2)) 
                                                                and resultado_csr.idPUNTO_EVALUACION = punto_evaluacion.idPUNTO_EVALUACION 
                                                                and PAIS_idPAIS=pais.idPAIS
                                                                and resultado_csr.idPUNTO_EVALUACION>0;");
	 			}
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }	

	 function getReportesCsrEventos(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CSR, fecha_creacion, html_reporte, nombre_objeto, evento.localidad, usuario 
	 								                   FROM resultado_csr, evento 
	 								                   WHERE resultado_csr.idEvento >0 and resultado_csr.idEvento=evento.idEvento;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }	 

	

 function getHtmlReporteHISSCAM($idReporte){
 	try {
 		$result = $this->db->ExecutePersonalizado("SELECT html_reporte FROM `hiss_cam_reporte` WHERE idHISS_CAM_REPORTE = " . $idReporte . " ");
 		return $result;
 	} catch (Exception $e) {
 		echo 'Error: ' .$e->getMessage();
 	}
 }

 function insertarReporteCRR($UsuarioEvaluador, 
								$NivelRiesgo, 
								$TipoObjeto, 
								$idPunto, 
								$idEvento, 
								$idPais, 
								$HtmlReporte,
								$Fecha){
		try {
				$strTabla = " resultado_crr ";
				$strCampos = "";
				$strValores = "";
				if($idPunto == ""){
					$idPunto = "NULL";
				}
				if($idEvento == ""){
					$idEvento = "NULL";
				}
				if($idPais == ""){
					$idPais = "NULL";
				}
					$strCampos = "  usuario_evaluador, 
									nivel_riesgo, 
									tipo_objeto, 
									fk_idPUNTO_EVALUACION, 
									fk_idEVENTO, 
									fk_idPAIS, 
									resultado_html,
									fecha ";
					$strValores = "'" . $UsuarioEvaluador . "','" . $NivelRiesgo . "'," . $TipoObjeto . ", " . $idPunto . ", " . $idEvento . ", " . $idPais . ", '" . $HtmlReporte . "', '" . $Fecha . "' ";
				//return "INSERT INTO " . $strTabla . "(" . $strCampos . ") VALUES(" . $strValores . ")";
				$result = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);
				if($result > 0){
					return $result;
				}else{
					return -1;
				}
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar reporte hisscam: ' . $e->getMessage();
				return;
			}
	}

 function getHtmlReporteCRR($idReporte){
 	try {
 		$result = $this->db->ExecutePersonalizado("SELECT resultado_html FROM `resultado_crr` WHERE idRESULTADO_CRR = " . $idReporte . " ");
 		return $result;
 	} catch (Exception $e) {
 		echo 'Error: ' .$e->getMessage();
 	}
 }


 function Bitacora($strUsuario, $strAccion){
 	try {
 		$this->db->ExecutePersonalizado("INSERT INTO Bitacora( usuario, accion ) VALUES('" . $strUsuario . "','" . $strAccion . "')");
 		return 1;
 	} catch (Exception $e) {
 		return -1;
 	}
 }

 function ConsultarBitacoraHtml(){
 	try {
 		$strHtml = "";
 		$result = $this->db->ExecutePersonalizado("SELECT * FROM bitacora "); 		
 		while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
 			$date=date_create($row[3]);
 			$fecha = date_format($date,"d/m/Y h:i:s");
 			$strHtml .= '<tr>
 			<th>' . $row[1] . '</th>
 			<td>' . $row[2] . '</td>
 			<td>' . $fecha . '</td>
 		</tr>'; 					
 	}
 	if($strHtml == ""){
 		echo '<tr><th>bitacora vacia</th><td></td><td>' . date("d/m/Y H:i:s") . '</td>';
 	}else{ 		
 		echo $strHtml;
 	}
 } catch (Exception $e) {
 	return -1;
 }
}

	 function getReportesCrrPais(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CRR, FECHA, nombre, usuario_evaluador FROM resultado_crr, pais where tipo_objeto = 0 AND pais.idPAIS = resultado_crr.fk_idPAIS;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }	

	 function getReportesCrrEvento(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CRR, FECHA, nombre, usuario_evaluador FROM resultado_crr, EVENTO where tipo_objeto = 1 AND evento.idEvento = resultado_crr.fk_idEVENTO;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }		

	 function getReportesCrrPtos(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_CRR, FECHA, nombre, usuario_evaluador FROM resultado_crr, punto_evaluacion where tipo_objeto = 2 AND punto_evaluacion.idPunto_Evaluacion = resultado_crr.fk_idPUNTO_EVALUACION;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }		  

	function getReporteCrr($idReporteCrr){
		$strTabla = " resultado_crr ";
		$strCampos = " * ";
		$strRestricciones = " idRESULTADO_CRR = " . $idReporteCrr . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}	


	function getReportesHissCam(){
		$strTabla = " hiss_cam_reporte ";
		$strCampos = " * ";
		$strRestricciones = "";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}		 

	function getReporteHissCam($idReporteHiss){
		$strTabla = " hiss_cam_reporte ";
		$strCampos = " * ";
		$strRestricciones = " idHISS_CAM_REPORTE = " . $idReporteHiss . " ";
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	 function getReportesSraEvento(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_SRA, fecha_creacion, evento.nombre, correo  FROM usuario, resultado_sra, EVENTO where tipo_objeto = 2 AND evento.idEvento = resultado_sra.idPUNTO_EVALUACION AND evento.idEvento = resultado_sra.idPUNTO_EVALUACION and usuario.idUsuario = RESULTADO_SRA.usuario;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }		

	 function getReportesSraPtos(){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT idRESULTADO_SRA, fecha_creacion, punto_evaluacion.nombre, correo  FROM usuario, resultado_sra, punto_evaluacion where tipo_objeto = 1 AND punto_evaluacion.idPUNTO_EVALUACION = resultado_sra.idPUNTO_EVALUACION and usuario.idUsuario = RESULTADO_SRA.usuario;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }

	 function getDescripcionSraPto($idPUNTO_EVALUACION){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT descripcion_evaluacion from resultado_sra where tipo_objeto=1 and idPUNTO_EVALUACION='$idPUNTO_EVALUACION' ORDER BY idRESULTADO_SRA DESC LIMIT 1;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }	 

	 function getDescripcionSraEvento($idPUNTO_EVALUACION){
	 	try {
	 		$result = $this->db->ExecutePersonalizado("SELECT descripcion_evaluacion from resultado_sra where tipo_objeto=2 and idPUNTO_EVALUACION='$idPUNTO_EVALUACION' ORDER BY idRESULTADO_SRA DESC LIMIT 1;");
	 		return $result;
	 	} catch (Exception $e) {
	 		echo 'Error: ' .$e->getMessage();
	 	}
	 }	


	} // FIN DE CLASE
	?>