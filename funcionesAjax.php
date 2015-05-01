<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/

	session_start();
	ob_start();
	$strMetodo = "";


//recuperacion del parametro que lleva el nombre del metodo.
//Este puede venir por post o por get.
/**
NOMBRE DEL PARAMETRO DE METODO: nombreMetodo
*/
try {
	if(isset($_POST["nombreMetodo"])){
		$strMetodo = $_POST["nombreMetodo"];
	}else if(isset($_GET["nombreMetodo"])){
		$strMetodo = $_GET["nombreMetodo"];
	}else{
		$strMetodo = "";
	}
} catch (Exception $e) {
	echo $e->getMessage();
}


//crear usuario
if($strMetodo == "CUsr")
	CrearUsuario();

function CrearUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$strNombre = str_replace("'","''",$_POST["AjxPNombre"]);		
	$strApellido = str_replace("'","''",$_POST["AjxPApellido"]);
	$strCorreo = $_POST["AjxPCorreo"];
	$strPassword = str_replace("'","''",$_POST["AjxPPassword"]);
	$strTipoUsuario = $_POST["AjxPTipoUser"];
	$strPaisUsuario = $_POST["AjxPPais"];

	try {
		$result = $db_funciones->InsertarUsuario($strNombre, 
			$strApellido,
			$strCorreo, 
			$strPassword,
			$strTipoUsuario,
			$strPaisUsuario);
		if($result == 1){
			echo "Usuario agregado exitosamente.";
		}else{
			echo $result;
		}
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//asignar usuario pais
if($strMetodo == "asignarUsuarioP")
	asignarUsuarioP();

function asignarUsuarioP(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];
	$strPais = $_POST["AjxPPais"];

	if($strUsuario == -2){
		echo "Usuario invalido";

	}
	else{
		$bandera=$db_funciones->verificarExistenciaAsignacion($strUsuario, $strPais);
		if($bandera==1){
			$bandera2=$db_funciones->asignarUsuario($strPais, $strUsuario);
			if($bandera2==1){

				echo "Usuario Asignado Exitosamente";
			}
			else{

				echo "Hubo un Error en la Asignacion";
			}
		}
		else{
			echo "El usuario ya se encuentra asignado a este pais";
		}
	}


}

//buscar paises asignados de usuario a desasignar
if($strMetodo == "buscarPaisesAsignados")
	buscarPaisesAsignados();

function buscarPaisesAsignados(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["usuario"];

	if($strUsuario == -2){

		$cadena ='<label for="txtPais" >Paises Asignados</label> <select>';

		$cadena=$cadena.'<option value="-2">Debe elejir un usuario valido</option></select name="lstPais" id="lstPais">'; 
	}
	else{
		$result = $db_funciones->getListaPaisesAsignados($strUsuario);
		$cadena ='<label for="txtPais" >Paises Asignados</label> <select name="lstPais" id="lstPais">';

		
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
			$cadena=$cadena.'<option value="'. $row[0] . '">' . $row[1] . '</option>';
		}
		$cadena=$cadena.'</select>';  

	}


	echo $cadena;


}


//desasignar usuario pais
if($strMetodo == "desasignarUsuarioP")
	desasignarUsuarioP();

function desasignarUsuarioP(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];
	$strPais = $_POST["AjxPPais"];


	$result=$db_funciones->contarPaisesAsignados($strUsuario);
	while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
		if($row[0]==1){
			echo "eliminar";
		}
		else{

			$result = $db_funciones->desasignarUsuarioP($strUsuario, $strPais);
			echo "desasignar";

		}
	}





}


//eliminar usuario 
if($strMetodo == "eliminarUsuario")
	eliminarUsuario();

function eliminarUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];


	$result=$db_funciones->eliminarUsuario($strUsuario);


}



//get puntos de evaluacion por pais
if($strMetodo == "getPtosEval")
	getPuntosEvaluacionxPais();

function getPuntosEvaluacionxPais(){
	$strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluacion</option>";
	$strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluaci&oacute;n</option>";
	$intIdPais = $_POST["AjxPPais"];
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$result = $db_funciones->ConsultarPuntosEvaluacion($intIdPais);
	while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
		$strHtml .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";		
	}
	echo $strHtml;
}
//Agregar Pais
if($strMetodo == "agregarPais")
	agregarPais();

function agregarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePais = str_replace("'","''",$_POST["pais"]);	
	$idRegion = $_POST["region"];	


	try {
		if(validarVacio($nombrePais)==false){
			$bandera=$db_funciones->verificarExistenciaPais($nombrePais);
			if($bandera==true){

				echo "Este Pais ya se encuentra registrado en el sistema";
			}
			else{
				$result = $db_funciones->insertarPais($nombrePais, $idRegion);

				echo "Pais: ".$nombrePais." guardado existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Agregar Region
if($strMetodo == "agregarRegion")
	agregarRegion();

function agregarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreRegion = str_replace("'","''",$_POST["region"]);	



	try {
		if(validarVacio($nombreRegion)==false){
			$bandera=$db_funciones->verificarExistenciaRegion($nombreRegion);
			if($bandera==true){

				echo "Esta Region ya se encuentra registrada en el sistema";
			}
			else{
				$result = $db_funciones->insertarRegion($nombreRegion);

				echo "Region: ".$nombreRegion." guardada existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
} 


//Agregar Punto de Evaluacion
if($strMetodo == "agregarPtoEvaluacion")
	agregarPtoEvaluacion();

function agregarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePtoEvaluacion = str_replace("'","''",$_POST["AjxNombre"]);	
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	
	$descripcion = str_replace("'","''",$_POST["AjxDescripcion"]);	
	$idPais = $_POST["AjxPais"];




	try {
		if(validarVacio($nombrePtoEvaluacion)==false AND validarVacio($descripcion)==false){
			$bandera=$db_funciones->verificarExistenciaPtoEvaluacion($nombrePtoEvaluacion, $idPais);
			if($bandera==true){

					echo 'Ya existe un Punto con el mismo nombre en este Pais, dentro del sistema';
				}
				else{
				$result = $db_funciones->insertarPtoEvaluacion($nombrePtoEvaluacion, $latitud, $longitud, $descripcion, $idPais );

				echo "Punto: ".$nombrePtoEvaluacion." guardado existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Eliminar Region
if($strMetodo == "eliminarRegion")
	eliminarRegion();

function eliminarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$region = $_POST["region"];	



	try {

		$result = $db_funciones->eliminarRegion($region);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Pais
if($strMetodo == "eliminarPais")
	eliminarPais();

function eliminarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$pais = $_POST["pais"];	



	try {

		$result = $db_funciones->eliminarPais($pais);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Punto de Evaluacion
if($strMetodo == "eliminarPtoEvaluacion")
	eliminarPtoEvaluacion();

function eliminarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$ptoEvaluacion = $_POST["ptoEvaluacion"];	

	try {

		$result = $db_funciones->eliminarPtoEvaluacion($ptoEvaluacion);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Agregar Amenaza
if($strMetodo == "agregarAmenaza")
	agregarAmenaza();

function agregarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$amenaza = str_replace("'","''",$_POST["amenaza"]);	
	$descripcion = str_replace("'","''",$_POST["descripcion"]);



	try {
		if(validarVacio($amenaza)==false AND validarVacio($descripcion)==false){
			$bandera=$db_funciones->verificarExistenciaAmenaza($amenaza);
			if($bandera==true){

				echo "Esta Amenaza ya se encuentra registrada en el sistema";
			}
			else{
				$result = $db_funciones->insertarAmenaza($amenaza, $descripcion);

				echo "Amenaza: ".$amenaza." guardada existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios!";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Amenaza
if($strMetodo == "eliminarAmenaza")
	eliminarAmenaza();

function eliminarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$amenaza = $_POST["amenaza"];	

	try {

		$result = $db_funciones->eliminarAmenaza($amenaza);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

function validarVacio($variable){
	trim($variable," \t\n\r\0\x0B");
	if(strcasecmp($variable, "")!=0){	
		return false;
	}
	else{
		return true;

	}
}

//Obtener informacion de usuario
if($strMetodo == "obtenerInfoUsuario")
	obtenerInfoUsuario();

function obtenerInfoUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idUsuario = $_POST["AjxPUser"];
	try {
			$result = $db_funciones->getInfoUsuario($idUsuario);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$cadena=$row[0].','.$row[1].','.$row[2].','.$row[3].','.$row[4].','.$row[5];				
				}				
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	}
//evaluacion de amenazas SRA
//EvalSRA
if($strMetodo == "EvalSRA")
	EvaluarSRA();
function EvaluarSRA(){
	$strJsonEval = $_POST["jsonSRA"];
	$strJsonPaso1 = $_POST["jsonPaso1"];
	//seteamos la variable de sesion para el paso 1
	$_SESSION["JsonPaso1SRA"] = $strJsonPaso1;
	$strCadenaEvaluados = "";
	include_once "funciones.php";
	$db_funciones = new Funciones();



	$arrJsonEval;
	$idEval = "";
	$error = "";
	
	$blnPrimeraVez = true;

	if($strJsonEval != "" && $strJsonEval != null){		
		$arrJsonEval = json_decode($strJsonEval);
		//obtenemos la informacion de evaluacion (idEvaluacion)
		$arrInfo = $arrJsonEval->InfoEval;

		$arrEval = $arrJsonEval->Eval;

		foreach($arrInfo as $json){
			$idEval = $json->IdEvaluacion;
			break;
		}

		foreach($arrEval as $json){
			//{"IdAmenaza": idAmenaza, "Impacto": impacto, "Probabilidad": probabilidad, "NivelDeRiesgo" : nivelDeRiesgo }
			$idAmenaza = $json->IdAmenaza;
			$impacto = $json->Impacto;
			$probabilidad = $json->Probabilidad;
			$nivelRiesgo = $json->NivelDeRiesgo;

			//Se inserta la evaluacion de cada amenaza, con el id de la evaluacion acarreado					
			//($strTabla, $strCampos, $strValores)					
			$result = $db_funciones->InsertarEvalAmenazas($idAmenaza, $impacto, $probabilidad, $idEval, $nivelRiesgo);
			if($result == -1){
				$error .= "No se pudo insertar la evaluacion de la amenaza: " . $idContenido . "<br>";
			}

			if($blnPrimeraVez){
				$strCadenaEvaluados = $result;
				$blnPrimeraVez = false;
			}else{
				$strCadenaEvaluados .= "," . $result;
			}
		}
		if($error == ""){
			echo $strCadenaEvaluados;
		}else{
			echo "-1|" . $strCadenaEvaluados . "|" . $error;
		}
	}else{
		Echo '-1||Error: No se han podido evaluar las amenazas. ';
	}
}


if($strMetodo == "setPaso2")
	SetPaso2SRA();
function SetPaso2SRA(){

	include_once "funciones.php";
	$db_funciones = new Funciones();

	$jsonPaso2 = $_POST["jsonSRAPaso2"];
	$jsonPaso1 = $_SESSION["JsonPaso1SRA"];
	$idEvalSra = $_SESSION["idEvalSraActual"];

	$NombreUsuarioCreador = "";
	$CorreoUsuarioCreador = "";
//$NombreUsuarioCreador = $row[1] . " " . $row[2];
//$CorreoUsuarioCreador = $row[3];

//variables de la evaluacion
	$idUsuarioEvaluador = "";
	$idPtoEval = "";
	$idEvento = "";
	$tipoObjeto = -1; //1 punto de evaluacion, 2 evento
	$nombreObjeto = "";
	$FechaEval = "";
	$Creador = "";


//punto/evento de evaluacion
	$nombrePtoEventoEval = "";
	//info de la evaluacion

	$resultEval = $db_funciones->getEval($idEvalSra);
	while ($row = mysqli_fetch_array($resultEval, MYSQL_NUM)){
		$idUsuarioEvaluador = $row[1];
		if(is_null($row[2])){
			$idPtoEval = "";
		}else{
			$idPtoEval = $row[2];
		}
		if(is_null($row[3])){
			$idEvento = "";
		}else{
			$idEvento = $row[3];
		}		
		$FechaEval = $row[4];
		$Creador = $row[5];
		break;
	}

	//info del usuario evaluador
	$resultUsuarioEval = $db_funciones->ConsultarUsuario($idUsuarioEvaluador);
	while ($row = mysqli_fetch_array($resultUsuarioEval, MYSQL_NUM)){
		$NombreUsuarioCreador = $row[1] . " " . $row[2];
		$CorreoUsuarioCreador = $row[3];
		break;
	}

	//consultamos punto de evaluacion o evento segun sea el caso
	if($idPtoEval == ""){
		//Es un evento
		$tipoObjeto = 2;
		$resultPtoEval = $db_funciones->ConsultarEvento($idEvento);
		while ($row = mysqli_fetch_array($resultPtoEval, MYSQL_NUM)){
			$nombrePtoEventoEval = "Evento: " . $row[1];
			$nombreObjeto = $row[1];
			break;
		}
	}else{
		//Es un punto de evaluacion
		$tipoObjeto = 1;
		$resultPtoEval = $db_funciones->ConsultarPuntoEvaluacion($idPtoEval);
		while ($row = mysqli_fetch_array($resultPtoEval, MYSQL_NUM)){
			$nombrePtoEventoEval = "Punto de evaluaci&oacute;n: " . $row[1];
			$nombreObjeto = $row[1];
			break;
		}
	}

	//parseo del json del paso 2 para sacar el nivel de riesgo y armar la tabla 2
	$strNivelRiesgoPaso2 = "";
	$strIdNivelRiesgoPaso2 = "";
	$strDescripcionPaso2 = "";
	$arrJsonPaso2 = json_decode($jsonPaso2);
		//obtenemos la informacion de evaluacion (idEvaluacion)
	$arrInfoPaso2 = $arrJsonPaso2->InfoEval;

	$arrEvalPaso2 = $arrJsonPaso2->Eval;

	foreach($arrInfoPaso2 as $itemJsonInfo){
		//$strNivelRiesgoPaso2 = $itemJsonInfo->idNivelRiesgo;
		//$strIdNivelRiesgoPaso2 = $itemJsonInfo->strNivelRiesgo;
		$strDescripcionPaso2 = $itemJsonInfo->Descripcion;
		break;
	}

	//Tabla 1 (encabezado con la info de la evaluacion)

	$strHtmlTabla1 = '<table class="tg" style="border-collapse:collapse;border-spacing:0;border-color:#aaa;table-layout: fixed; width: 100%;">';
	// $strHtmlTabla1 .= '	<tr>';
	// $strHtmlTabla1 .= '		<td class="tg-mnb8" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;background-color:#f38630;color:#ffffff">';
	// $strHtmlTabla1 .= 'Nivel de riesgo';
	// $strHtmlTabla1 .= '		</td>';	
	// $strHtmlTabla1 .= '		<td class="tg-031e" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;">';
	// $strHtmlTabla1 .= $strIdNivelRiesgoPaso2;
	// $strHtmlTabla1 .= '		</td>';	
	// $strHtmlTabla1 .= '	</tr>';
	// $strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<tr><td class="tg-mnb8" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;background-color:#f38630;color:#ffffff">';
	$strHtmlTabla1 .= 'Punto/Evento de evaluaci&oacute;n';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;">';
	$strHtmlTabla1 .= $nombrePtoEventoEval;
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;background-color:#f38630;color:#ffffff">';
	$strHtmlTabla1 .= 'Fecha';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;">';
	$arrFechaEval = explode('-',$FechaEval);
	$strHtmlTabla1 .= "$arrFechaEval[2]/$arrFechaEval[1]/$arrFechaEval[0]";
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;background-color:#f38630;color:#ffffff">';
	$strHtmlTabla1 .= 'Evaluador';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;">';
	$strHtmlTabla1 .= $NombreUsuarioCreador . " - " . $CorreoUsuarioCreador . "<br>" . $Creador ;
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '</table>';


	//construccion de la tabla # 2, Evaluacion automatica
	/*
<table class="tg" style="undefined;table-layout: fixed; width: 989px">
<colgroup>
<col style="width: 112px">
<col style="width: 129px">
<col style="width: 530px">
<col style="width: 109px">
<col style="width: 109px">
</colgroup>
  <tr>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  <tr>
    <td class="tg-hgcj">Amenaza 1</td>
    <td class="tg-f062">CRITICO<br></td>
    <td class="tg-031e">Maecenas luctus nec ante nec vulputate. Integer et euismod arcu. Curabitur volutpat mauris ac magna tincidunt, vel egestas dui tempus. Curabitur tristique turpis egestas justo dapibus volutpat. Nullam ac sollicitudin odio. Aliquam vulputate mauris vehicula tellus viverra lobortis ac in risus. Donec volutpat neque nec rutrum molestie.Fusce viverra consequat ipsum, nec tempor magna pellentesque sit amet. Morbi ex ligula, molestie et risus non, varius cursus erat. Phasellus volutpat tortor enim, id convallis ligula pharetra et. Praesent eu dolor non mi efficitur commodo. Mauris semper sem et bibendum posuere. Duis vulputate nec risus vitae ultrices. Donec mollis euismod nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;Mauris faucibus, nisl vel consequat ullamcorper, diam ex mollis nibh, imperdiet porttitor enim eros ut dui. Curabitur nisl leo, ultricies ac finibus ac, vestibulum id nibh. Suspendisse potenti. Donec sodales ipsum in neque mollis scelerisque. Ut molestie non erat nec feugiat. Nunc ut aliquam nunc. Aenean dictum tempor neque, ut convallis ante accumsan quis. Suspendisse vulputate nisl sed velit viverra pulvinar. Donec non dui magna. Fusce ultricies porta massa ac venenatis. Etiam fermentum luctus cursus. Donec ut orci vel erat dignissim aliquam quis sit amet lorem. Maecenas semper sagittis ipsum sed suscipit. Pellentesque cursus interdum malesuada. Aenean pharetra, metus lobortis tincidunt maximus, erat nunc semper metus, sed suscipit mauris ante vitae sem. Vestibulum nec accumsan lorem.</td>
    <td class="tg-f062">ALTO</td>
    <td class="tg-bghc">ACEPTABLE</td>
  </tr>
  <tr>
    <td class="tg-e3zv">Amenaza 2</td>
    <td class="tg-f062">MEDIO</td>
    <td class="tg-031e">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel interdum orci. Fusce auctor hendrerit enim, vitae sollicitudin orci lobortis sit amet. Sed dictum tellus quis dolor mattis, et euismod ante vestibulum. Cras at odio tellus. Nulla imperdiet odio et pretium congue. Ut eget pretium dolor. Praesent egestas consectetur risus, ac accumsan quam fringilla sed. Suspendisse potenti. Maecenas et sem justo. Cras id varius neque, a aliquam tortor. Suspendisse in ex et ligula malesuada laoreet. Vivamus at mi nec sem pretium rhoncus. Donec ac lorem id sapien hendrerit iaculis id a tortor. Curabitur feugiat, massa nec cursus molestie, sapien nulla laoreet mauris, ut ultrices lacus velit et leo. Pellentesque laoreet, urna ac hendrerit volutpat, ipsum elit lacinia urna, sit amet tristique tortor arcu eu mi.Morbi ut mi erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam eu bibendum est. Morbi quis finibus eros, at elementum tellus. Vivamus a dignissim odio. Integer placerat quam lectus, nec consequat magna egestas a. Donec a leo euismod, mattis purus in, convallis magna. Donec sollicitudin elementum ex sed eleifend.Pellentesque accumsan velit ac erat porta, quis fringilla lacus consectetur. Donec eros magna, feugiat ac euismod a, dignissim nec orci. Sed eros ante, suscipit ac magna a, feugiat mattis mi. Pellentesque ultricies, ipsum quis consectetur cursus, erat enim accumsan urna, nec rhoncus ex elit ut nibh. Ut a justo ligula. Mauris ultricies porta diam vitae iaculis. Pellentesque placerat dui id mi lacinia rhoncus. Cras dignissim faucibus tristique. Vivamus leo risus, mattis ullamcorper lacinia ut, viverra vitae odio. Donec id augue magna. Etiam non tellus sagittis, dictum turpis in, varius velit. Mauris tempus rhoncus lacus, quis interdum urna facilisis quis.</td>
    <td class="tg-f062">Medio</td>
    <td class="tg-1ea8">INACEPTABLE</td>
  </tr>
</table>
*/
	$strHtmlTabla2 = '';
	$strHtmlTabla2 .= '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
	// $strHtmlTabla2 .= '	<tr>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Amenaza</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Impacto</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Probabilidad</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Nivel de riesgo</td>';
	// $strHtmlTabla2 .= '	</tr>';
	
	//niveles de riego del paso 1
	$arrNivelesRP1 = array();
	//plan mitigacion prevencion
	$arrPMP = array();
	//niveles de riesgo del paso 2
	$arrNivelRP2 = array();
	//amenazas
	$arrAmenaza = array();
	//array es aceptable o inaceptable
	$arrAceptable = array();

	$arrJsonPaso1 = json_decode($jsonPaso1);		
	$arrEvalPaso1 = $arrJsonPaso1->Eval;

	foreach($arrEvalPaso1 as $itemJsonEval){
		array_push($arrAmenaza, $itemJsonEval->strAmenaza);
		array_push($arrNivelesRP1, $itemJsonEval->strNivelDeRiesgo);
	}	
	foreach ($arrEvalPaso2 as $iteJsonEval) {		
		$strPlanMit = "";
		$strPlanPrev = "";
		array_push($arrNivelRP2, $iteJsonEval->strNivelDeRiesgo);
		$arrPrevenciones = $iteJsonEval->Prevenciones;
		foreach ($arrPrevenciones as $itemPrevencion) {
			$strPlanPrev .= $itemPrevencion->nombre . ": " . $itemPrevencion->descripcion . "<br>";			
		}		
		$arrMitigaciones = $iteJsonEval->Mitigaciones;
		foreach ($arrMitigaciones as $itemMitigacion) {
			$strPlanMit .= $itemMitigacion->nombre . ": " . $itemMitigacion->descripcion . "<br>";			
		}

		array_push($arrPMP, $strPlanPrev . " <br> " . $strPlanMit);
	}

	/*
<tr>
    <td class="tg-hgcj">Amenaza 1</td>
    <td class="tg-f062">CRITICO<br></td>
    <td class="tg-031e">Maecenas luctus nec ante nec vulputate. Integer et euismod arcu. Curabitur volutpat mauris ac magna tincidunt, vel egestas dui tempus. Curabitur tristique turpis egestas justo dapibus volutpat. Nullam ac sollicitudin odio. Aliquam vulputate mauris vehicula tellus viverra lobortis ac in risus. Donec volutpat neque nec rutrum molestie.Fusce viverra consequat ipsum, nec tempor magna pellentesque sit amet. Morbi ex ligula, molestie et risus non, varius cursus erat. Phasellus volutpat tortor enim, id convallis ligula pharetra et. Praesent eu dolor non mi efficitur commodo. Mauris semper sem et bibendum posuere. Duis vulputate nec risus vitae ultrices. Donec mollis euismod nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;Mauris faucibus, nisl vel consequat ullamcorper, diam ex mollis nibh, imperdiet porttitor enim eros ut dui. Curabitur nisl leo, ultricies ac finibus ac, vestibulum id nibh. Suspendisse potenti. Donec sodales ipsum in neque mollis scelerisque. Ut molestie non erat nec feugiat. Nunc ut aliquam nunc. Aenean dictum tempor neque, ut convallis ante accumsan quis. Suspendisse vulputate nisl sed velit viverra pulvinar. Donec non dui magna. Fusce ultricies porta massa ac venenatis. Etiam fermentum luctus cursus. Donec ut orci vel erat dignissim aliquam quis sit amet lorem. Maecenas semper sagittis ipsum sed suscipit. Pellentesque cursus interdum malesuada. Aenean pharetra, metus lobortis tincidunt maximus, erat nunc semper metus, sed suscipit mauris ante vitae sem. Vestibulum nec accumsan lorem.</td>
    <td class="tg-f062">ALTO</td>
    <td class="tg-bghc">ACEPTABLE</td>
  </tr>
	*/
  $contAm = 0;
  foreach ($arrAmenaza as $amenaza) {
  	$strHtmlTabla2 .= '<tr>';
  	$strHtmlTabla2 .= '<td style="width:15%;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;" class="tg-hgcj font-weight:bold;text-align:center">' . $amenaza . '</td>';
  	$strHtmlTabla2 .= '<td style="width:15%;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;" class="tg-f062">' . $arrNivelesRP1[$contAm] . '</td>';
  	$strHtmlTabla2 .= '<td style="width:40%;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff; word-wrap: break-word;background-image:url(../img/rarrow.png); background-size: 100% 100%; background-position:right 0px; background-repeat:no-repeat;" class="tg-031e">' . $arrPMP[$contAm] . '</td>';
  	$strHtmlTabla2 .= '<td colspan="2" class="tg-f062" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;background-color:#f38630;text-align:center">' . $arrNivelRP2[$contAm] . '</td>';
  	//$strHtmlTabla2 .= '<td class="tg-bghc" style="font-weight:bold;background-color:#32cb00;text-align:center">ACEPTABLE</td>';
  	$strHtmlTabla2 .= '</tr>';
  	$contAm = $contAm + 1;
  }

	$strHtmlTabla2 .= '</table>';



	//Armado de la tabla #3, con planes de prevencion y mitigacion
	$strHtmlTabla3 = '';

	//array planes mitigacion prevencion	
	

	//armado de la tabla #4, descripcion operativa del usuario

	$strHtmlTabla4 = '';
	$strHtmlTabla4 .= '<table class="tg" style="border-collapse:collapse;border-spacing:0;border-color:#ccc;">';
	$strHtmlTabla4 .= '	<tr>';
	$strHtmlTabla4 .= '		<th class="tg-hgcj" style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;" colspan="6">Reporte Operativo</th>';
	$strHtmlTabla4 .= '	</tr>';
	$strHtmlTabla4 .= '	<tr>';
	$strHtmlTabla4 .= '		<td class="tg-e3zv" style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;font-weight:bold;text-align:center" colspan="6"><p>' . $strDescripcionPaso2 . '</p></td>';
	$strHtmlTabla4 .= '	</tr>';
	$strHtmlTabla4 .= '</table>';	

	//Armado de la tabla principal que contiene a todas las demas tablas
	$strHtmlTablaGeneral = "";
	$strHtmlTablaGeneral .= ' <table>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla1;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla2;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	// $strHtmlTablaGeneral .= '	<tr>';
	// $strHtmlTablaGeneral .= '		<td>';
	// $strHtmlTablaGeneral .= $strHtmlTabla3;
	// $strHtmlTablaGeneral .= '		</td>';
	// $strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla4;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '</table>';
		// echo $strHtmlTablaGeneral;
	//insertamos el reporte
    if($idPtoEval == ""){
        $idReporte = $db_funciones->insertarReporteSra($FechaEval, 
        $strHtmlTablaGeneral, $idUsuarioEvaluador, $tipoObjeto, $nombreObjeto, $idEvento,$strDescripcionPaso2);
    }else{
        $idReporte = $db_funciones->insertarReporteSra($FechaEval, 
        $strHtmlTablaGeneral, $idUsuarioEvaluador, $tipoObjeto, $nombreObjeto,$idPtoEval,$strDescripcionPaso2);
    }	
			$strusr = $_SESSION["Usuario"];
			$db_funciones->Bitacora($strusr, 'Creacion de reporte SRA con identificador "' . $idReporte . '"');
	echo $idReporte;
}

function getCssNivelRiesgo($idNivelRiesgo){
	switch($idNivelRiesgo){
		case 1:
				//insignificante
		return "tg-8o5d";
		case 2:
				//bajo
		return "tg-v88f";
		case 3:
				//medio
		return "tg-3ope";
		case 4:
				//alto
		return "tg-yg2k";
		case 5:
				//critico
		return "tg-lkh4";
		case 6:
				//nulo
		return "tg-lkh3";
		default:
		return "";
	}
}

//Obtener informacion de un pais
if($strMetodo == "obtenerInfoPais")
	obtenerInfoPais();

function obtenerInfoPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idPais = $_POST["AjxPais"];
	$idRegion;
	$cadena="";
	try {
			$result = $db_funciones->getInfoPais($idPais);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$idRegion=$row[2];
					$cadena=$row[0].','.$row[1].','.$row[2];				
				}

			$result = $db_funciones->getInfoRegion($idRegion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$cadena=$cadena.','.$row[0].','.$row[1];				
				}								
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

}

//Obtener informacion de una region
if($strMetodo == "obtenerInfoRegion")
	obtenerInfoRegion();

function obtenerInfoRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idRegion = $_POST["AjxRegion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoRegion($idRegion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de una amenaza
if($strMetodo == "obtenerInfoAmenaza")
	obtenerInfoAmenaza();

function obtenerInfoAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idAmenaza = $_POST["AjxAmenaza"];
	$cadena="";
	try {
			$result = $db_funciones->getAmenazas($idAmenaza);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de un plan de prevencion
if($strMetodo == "obtenerInfoPrevencion")
	obtenerInfoPrevencion();

function obtenerInfoPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idPrevencion = $_POST["AjxPrevencion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoPrevencion($idPrevencion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de un plan de mitigacion
if($strMetodo == "obtenerInfoMitigacion")
	obtenerInfoMitigacion();

function obtenerInfoMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idMitigacion = $_POST["AjxMitigacion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoMitigacion($idMitigacion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//eliminar Evento 
if($strMetodo == "eliminarEvento")
	eliminarEvento();

function eliminarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idEvento = $_POST["AjxEvento"];


	$result=$db_funciones->eliminarEvento($idEvento);


}

//eliminar Plan de Prevencion 
if($strMetodo == "eliminarPlanPrevencion")
	eliminarPlanPrevencion();

function eliminarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idPlan = $_POST["AjxPlan"];


	$result=$db_funciones->eliminarPlanPrevencion($idPlan);


}

//eliminar Plan de Mitigacion 
if($strMetodo == "eliminarPlanMitigacion")
	eliminarPlanMitigacion();

function eliminarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idPlan = $_POST["AjxPlan"];


	$result=$db_funciones->eliminarPlanMitigacion($idPlan);

}

//Agregar Evento
if($strMetodo == "agregarEvento")
	agregarEvento();

function agregarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreEvento = $_POST["AjxNombre"];
	$localidad = $_POST['AjxLocalidad'];
	$descripcion = $_POST["AjxDescripcion"];
	$latitud = $_POST["AjxLatitud"];
	$longitud = $_POST["AjxLongitud"];		
	$fecha = $_POST["AjxFecha"];

	try {

		$bandera=$db_funciones->verificarExistenciaEvento($nombreEvento);
				if($bandera==true){

					echo 'Ya existe un Evento con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarEvento($nombreEvento, $localidad, $descripcion, $latitud, $longitud, $fecha);

				echo "Evento: ".$nombreEvento." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Agregar Plan de Mitigacion
if($strMetodo == "agregarPlanMitigacion")
	agregarPlanMitigacion();

function agregarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = str_replace("'","''",$_POST["AjxNombre"]);
	$descripcion = str_replace("'","''",$_POST["AjxDescripcion"]);

	try {

		$bandera=$db_funciones->verificarExistenciaPlanMitigacion($nombrePlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarPlanMitigacion($nombrePlan, $descripcion);

				echo "Plan: ".$nombrePlan." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Agregar Plan de Prevencion
if($strMetodo == "agregarPlanPrevencion")
	agregarPlanPrevencion();

function agregarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = str_replace("'","''",$_POST["AjxNombre"]);
	$descripcion = str_replace("'","''",$_POST["AjxDescripcion"]);

	try {

		$bandera=$db_funciones->verificarExistenciaPlanPrevencion($nombrePlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarPlanPrevencion($nombrePlan, $descripcion);

				echo "Plan: ".$nombrePlan." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Amenaza
if($strMetodo == "modificarAmenaza")
	modificarAmenaza();

function modificarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreAmenaza = $_POST["AjxNombre"];
	$descripcion = $_POST["AjxDescripcion"];
	$idAmenaza = $_POST["AjxAmenaza"];

	try {

		$bandera=$db_funciones->verificarExistenciaAmenazaUpdate($nombreAmenaza, $idAmenaza);
				if($bandera==true){

					echo 'Ya existe una Amenaza con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarAmenaza($nombreAmenaza, $descripcion, $idAmenaza);

				echo "Amenaza: ".$nombreAmenaza." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Modificar Pais
if($strMetodo == "modificarPais")
	modificarPais();

function modificarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePais = $_POST["AjxNombre"];
	$idPais = $_POST["AjxPais"];
	$idRegion = $_POST["AjxRegion"];

	try {

		$bandera=$db_funciones->verificarExistenciaPaisUpdate($nombrePais, $idPais);
				if($bandera==true){

					echo 'Ya existe una Pais con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPais($nombrePais, $idRegion, $idPais);

				echo "Pais: ".$nombrePais." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Modificar Region
if($strMetodo == "modificarRegion")
	modificarRegion();

function modificarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreRegion = $_POST["AjxNombre"];
	$idRegion = $_POST["AjxRegion"];

	try {

		$bandera=$db_funciones->verificarExistenciaRegionUpdate($nombreRegion, $idRegion);
				if($bandera==true){

					echo 'Ya existe una Region con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarRegion($nombreRegion, $idRegion);

				echo "Region: ".$nombreRegion." actualizada existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Plan de Mitigacion
if($strMetodo == "modificarPlanMitigacion")
	modificarPlanMitigacion();

function modificarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idPlan = $_POST["AjxPlan"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanMitigacionUpdate($nombrePlan, $idPlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPlanMitigacion($nombrePlan, $descripcion, $idPlan);

				echo "Plan: ".$nombrePlan." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



//Modificar Plan de Prevencion
if($strMetodo == "modificarPlanPrevencion")
	modificarPlanPrevencion();

function modificarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = str_replace("'","''",$_POST["AjxNombre"]);
	$descripcion = str_replace("'","''",$_POST['AjxDescripcion']);
	$idPlan = $_POST["AjxPlan"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanPrevencionUpdate($nombrePlan, $idPlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPlanPrevencion($nombrePlan, $descripcion, $idPlan);

				echo "Plan: ".$nombrePlan." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Evento
if($strMetodo == "modificarEvento")
	modificarEvento();

function modificarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreEvento = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idEvento = $_POST["AjxEvento"];
	$localidad = $_POST["AjxLocalidad"];	
	$fecha = $_POST["AjxFecha"];
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	

	try {

		$bandera=$db_funciones->verificarExistenciaEventoUpdate($nombreEvento, $idEvento);
				if($bandera==true){

					echo 'Ya existe un Evento con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarEvento($nombreEvento, $descripcion, $localidad, $latitud, $longitud, $fecha, $idEvento);

				echo "Evento: ".$nombreEvento." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



//Modificar Pto Evaluacion
if($strMetodo == "modificarPtoEvaluacion")
	modificarPtoEvaluacion();

function modificarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePto = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idPto = $_POST["AjxPto"];
	$idPais = $_POST["AjxPais"];
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	

	try {

		$bandera=$db_funciones->verificarExistenciaPtoEvaluacionUpdate($nombrePto, $idPais, $idPto);
				if($bandera==true){

					echo 'Ya existe un Punto con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPtoEvaluacion($nombrePto, $descripcion, $latitud, $longitud, $idPais, $idPto);

				echo "Punto: ".$nombrePto." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Modificar MiInfo
if($strMetodo == "modificarMiInfo")
	modificarMiInfo();

function modificarMiInfo(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombre = $_POST["AjxNombre"];
	$apellido = $_POST["AjxApellido"];
	$correo = $_POST["AjxCorreo"];
	$pass = $_POST["AjxPassword"];
	$passActual = $_POST["AjxPassActual"];
	$idUsuario = $_POST["AjxUsuario"];

	try {

		if($passActual == $_SESSION["passwordUsuario"]){
				if(validarVacio($pass)==false){
						$result = $db_funciones->modificarUsuario($nombre, $apellido, $correo, $pass, $idUsuario);

						echo "Usuario: ".$correo." actualizado existosamente";
				}
				else{
						$result = $db_funciones->modificarUsuarioNoPass($nombre, $apellido, $correo, $idUsuario);
						echo "Usuario: ".$correo." actualizado existosamente";			
				}
		}		
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Auth
if($strMetodo == "Auth")
	Login();

function Login(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$usuario = $_POST["usu"];
	$pass = str_replace("'", "''",$_POST['pass']);
	$tipo = $_POST["tipo"];


	try{

	if($db_funciones->ValidarLogin($usuario, $pass, $tipo)){
		//el id se setea en la consulta de la validacion del login

		$_SESSION["Usuario"] = $usuario;
		$_SESSION["TipoUsuario"] = $tipo;
		$db_funciones->Bitacora($usuario, 'Login de usuario "' . $usuario . '" ');		
		echo true;
	}		
	}catch (Exception $e) {		
		$db_funciones->Bitacora('Sistema FAST', 'Error de Login. intentado con usuario "' . $usuario . '" ');		
		echo $e->getMessage();
	}
}

//Modificar InfoUsuario
if($strMetodo == "modificarInfoUsuario")
	modificarInfoUsuario();

function modificarInfoUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombre = str_replace("'", "''", $_POST["AjxNombre"]);
	$apellido = str_replace("'", "''",$_POST["AjxApellido"]);
	$pass = str_replace("'", "''",$_POST["AjxPassword"]);
	$idUsuario = str_replace("'", "''",$_POST["AjxUsuario"]);

	try {

				$result = $db_funciones->modificarInfoUsuario($nombre, $apellido, $pass, $idUsuario);
				echo "Usuario actualizado existosamente!";
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
if($strMetodo == "SendEMail")
SendNewMail();

function SendNewMail(){
$headers = "De: adminVM@vm.com \r\n";
        // $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";        
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$Correos = $_POST["mails"];
	$Estilos = $_POST['estilos'];
	$idReporte = $_POST["idRepo"];
    $strHtml = "";
	try {
        $result = $db_funciones->getHtmlReporteSRA($idReporte);
    while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
        $strHtml = $row[0];
        break;
    }

    // $strHtml = $strHtml.replace("<html>", "");
    // $strHtml = "<html> <style>" . $Estilos . "</style> " . $strHtml;

    $db_funciones->EnviarCorreo($Correos, "Reporte SRA - Visión Mundial", $strHtml);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

//get eventos por pais
if($strMetodo == "getEventos")
    getPuntosEvaluacionxPais();

function getEventos(){    
    $strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluaci&oacute;n</option>";    
    include_once "funciones.php";
    $db_funciones = new Funciones();
    $result = $db_funciones->ConsultarEvento(-1);
    while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
        $strHtml .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";     
    }
    echo $strHtml;
}


if($strMetodo == "sendGMail")
    sendGMail();

function sendGMail(){
	//Parametros: 
	// AjxTipoReporte: tipo de reporte [1: csr, 2: crr, 3: sra, 4: hiss-cam	]
	// AjxIDReporte: Id del reporte a enviar
	// mails: Lista de mails destinatarios, separados por coma.
	// Asunto: Asunto del correo.	
	include_once "funciones.php";
	$db_funciones = new Funciones();
	try {
		$idReporte = "";
		$destinatarios = "";
		$Asunto = "";
		$tipoReporte = -1;

	// 1: csr, 2: crr, 3: sra, 4: hiss-cam	
		if(isset($_POST["AjxTipoReporte"])){
			$tipoReporte = $_POST["AjxTipoReporte"];
		}else{
			echo "No se ha podido enviar su correo.";
			return;
		}

		if(isset($_POST["AjxIDReporte"])){
			$idReporte=$_POST["AjxIDReporte"];
		}else{
			echo "No se ha podido enviar su correo.";
			return;
		}

		if(isset($_POST["mails"])){
			$destinatarios = $_POST["mails"];
		}else{
			echo "No se ha podido enviar su correo.";
			return;
		}

		if(isset($_POST["Asunto"])){
			$Asunto = $_POST["Asunto"];
		}else{
			echo "No se ha podido enviar su correo.";
			return;
		}

		$strHtmlReporte = "";
		switch ($tipoReporte) {
			case 1:
			// CSR
			$result=$db_funciones->getReporteCsr($idReporte);
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				$strHtmlReporte=$row[2];				
				break;
			}
			break;
			case 2:
			// CRR
			$result = $db_funciones->getHtmlReporteCRR($idReporte);
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				$strHtmlReporte=$row[0];				
				break;
			}			
			break;
			case 3:
			// SRA
			$result = $db_funciones->getHtmlReporteSRA($idReporte);
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				$strHtmlReporte=$row[0];				
				break;
			}			
			break;

			case 4: 
			//HISS-CAM
			$result = $db_funciones->getHtmlReporteHISSCAM($idReporte);
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				$strHtmlReporte=$row[0];				
				break;
			}			
			break;		
		}

		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$arrDestinatarios = explode(",",$destinatarios);

		foreach ($arrDestinatarios as $Correo) {
			mail($Correo, $Asunto, $strHtmlReporte, $headers);
		} 
		echo "Su correo se ha enviado exitosamente.";
	} catch (Exception $e) {
		echo "No se ha podido enviar su correo.";
	}							
}



if($strMetodo == "ReporteHissCam")
	CrearReporteHissCam();
function CrearReporteHissCam(){

	include_once "funciones.php";
	$db_funciones = new Funciones();

	$strNombreDepto = $_POST["nombreDepto"];
	$strFechaReporte =$_POST["FechaReporte"];
	$strTema =$_POST["Tema"];
	$strPaisRegion =$_POST["PaisRegion"];
	$strEjercitoOtro =$_POST["EjercitoOtro"];
	$strStatusQuo =$_POST["StatusQuo"];
	$strCambioProp =$_POST["CambioProp"];
	$strResumenEspec =$_POST["ResumenEspec"];
	$strRespH1 =$_POST["RespH1"];
	$strSiNoH1 =$_POST["SiNoH1"];
	$strBanderaH1 =$_POST["BanderaH1"];
	$strRespI0 =$_POST["RespI0"];
	$strSiNoI0 =$_POST["SiNoI0"];
	$strBanderaI0 =$_POST["BanderaI0"];
	$strRespI1 =$_POST["RespI1"];
	$strSiNoI1 =$_POST["SiNoI1"];
	$strBanderaI1 =$_POST["BanderaI1"];
	$strRespI2 =$_POST["RespI2"];
	$strSiNoI2 =$_POST["SiNoI2"];
	$strBanderaI2 =$_POST["BanderaI2"];
	$strRespI3 =$_POST["RespI3"];
	$strSiNoI3 =$_POST["SiNoI3"];
	$strBanderaI3 =$_POST["BanderaI3"];
	$strRespI4 =$_POST["RespI4"];
	$strSiNoI4 =$_POST["SiNoI4"];
	$strBanderaI4 =$_POST["BanderaI4"];
	$strRespI5 =$_POST["RespI5"];
	$strSiNoI5 =$_POST["SiNoI5"];
	$strBanderaI5 =$_POST["BanderaI5"];
	$strRespI6 =$_POST["RespI6"];
	$strSiNoI6 =$_POST["SiNoI6"];
	$strBanderaI6 =$_POST["BanderaI6"];
	$strRespI7 =$_POST["RespI7"];
	$strSiNoI7 =$_POST["SiNoI7"];
	$strBanderaI7 =$_POST["BanderaI7"];
	$strRespI8 =$_POST["RespI8"];
	$strSiNoI8 =$_POST["SiNoI8"];
	$strBanderaI8 =$_POST["BanderaI8"];
	$strRespS0_1 =$_POST["RespS0_1"];
	$strSiNoS0_1 =$_POST["SiNoS0_1"];
	$strBanderaS0_1 =$_POST["BanderaS0_1"];
	$strRespS2_0 =$_POST["RespS2_0"];
	$strSiNoS2_0 =$_POST["SiNoS2_0"];
	$strBanderaS2_0 =$_POST["BanderaS2_0"];
	$strRespS2_1 =$_POST["RespS2_1"];
	$strSiNoS2_1 =$_POST["SiNoS2_1"];
	$strBanderaS2_1 =$_POST["BanderaS2_1"];
	$strRespC =$_POST["RespC"];
	$strSiNoC =$_POST["SiNoC"];
	$strRespA =$_POST["RespA"];
	$strSiNoA =$_POST["SiNoA"];
	$strRespM =$_POST["RespM"];
	$strSiNoM =$_POST["SiNoM"];
	$strCompromiso =$_POST["Compromiso"];
	$strRecomendacion =$_POST["Recomendacion"];
	$strNombreDepaFinal =$_POST["NombreDepaFinal"];
	$strFechaRecibo =$_POST["FechaRecibo"];
	$strDecisionFinal =$_POST["DecisionFinal"];
	$strAprobadoPor =$_POST["AprobadoPor"];	

	date_default_timezone_set('UTC');
	$FechaReporteConvertido = date("d/m/Y", strtotime($strFechaReporte));
	$FechaReciboConvertido = date("d/m/Y", strtotime($strFechaRecibo));

	$BanderaEncoded = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEA3ADcAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAA6ADUDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9FvGXxs8G/D3xZp/h7xHrMWjX19Zy30D3f7uF443RGHmH5d2ZF464qvP+0J8NIIGlk8eeH1QDP/IRiz09N3NeW/tueC9M1Dw74R8Yanb+dY+HdWWHUiOWGnXeLe4Ye6Fopc9vJBr87fjV4Cu/hj481nw5eMXe0l2xy4wJYyMo/wCKkdPevBzHHVsE1KMU4s+44eyPCZ0pwnVcakdbaao+8/F3/BR74e6H4lttK0ax1HxFA8yxSX9uFihXLAZXf8zAZ9MelfVtndR31pBcRHdFMiyKfUEAivwFvpXtVDqzBlORjOeDwa+m9A/bp+LHhPRLGKHWbbUIIYUREvbRW4AAAJXaT09a4qOccutdb9j2MVwfKreOBfw73e/4H6zfWjivyV1L/gpp8YZZDbRjw/bBuPNisH3/AFGZCM/hXt/7Cvxm8d/Gb4xarP4r8S3mq2tppjSJa5WKAO0iKCUUAEgBsZz1NetHMaVScYR3Z8pUyDE0aNStUaSgj79ooor1T5o5z4heD7P4heB9e8M6gm+y1ayms5V74dCuR781+bP7RXhu68W/BfwT4zuhv17QvM8JeIT1b7TauY1dj6tt3c/89BX6kd6+G/2iPD8fhjWPjP4TddmneKNIj8YacCMKLu2Kx3SqPUgQv+debmFFVsNKL6a/cfQZDjJYLMKVSL3dn6PQ/OPV0PklsZ7CtNW8/wAP2bDk7BnHtXQ+EPhL4v8AipLLa+FfD95rMinLNCh2Lj1Y8Z/Gq/ivwLr3w2dtD8S6ZNpOqQctbzAZ2nkEHuD7V8FWpy9lGbXU/dcFiaTxdWkpXbiebXSltSA9DX3b/wAExZEt/ivr8G755dIyB6gSpn/0IV8KXTf8TQEetfSv7GvxGj+Hfxv8PX9w/l2d25sblieNsowMn0DhD+Brvo1FSrUpPufM4rDSxWFxNKG9n+Gp+w9FNRg6hhyDRX6AfiAHtXzP+3J4SiufBmgeLmMkUWhX6wajJAAXOnXQ8i5Az2CuG5/ug19Mdq574geEbTx94J1zw5fIJLXU7OW1dTx95SAfzxUyipKz2KjJxkpReqGeAfBGgeAfDFlpPhyyhs9MjjXy/JAy4I+8W7k9c14v+0b+xto/7QPiC31qbWrrSL6OAQMIo1dHAOQTn69jXVfso+LrvxN8GdMstUcvrnh6WXQNQzwfNtm8sMR/tIEb8a9i/SsamHp1YeznHQ7cPjsRha31ijO0u/qfH3h3/gmL8L7GzP8Aa91q2sXp/wCW/wBo8kD6KoxXN+NP+Ca1hp8b3fgjxBcRXSnctrqIDKcdAHABH619y0c1zzwGHqR5XE7qGeZhh6vtYVNfwOf8CNqjeDdG/tuHyNXW1jW7jznEoUB8Edsg0V0H6UV3RXKrXPEm+eTltcdRRRVEni3w78B6/wCBP2gviDcw2JPgnxJBb6ol15iYj1BR5ckezO4bkCtkDHFe00UUAFFFFABRRRQB/9k=";

	$strHtml = '	
<div id="Reporte" style="overflow-x: scroll; position: relative;padding: .4em 1em;overflow: hidden;display: block;clear: both;border-width: 1px;border-style: solid;background-color: #fff;border-color: #ddd;color: #333;text-shadow: 0 1px 0 #f3f3f3;background-clip: padding-box;border-radius: .3125em;">

				<div style="text-align: center;">
					<h1 style="font-size: 4em; color: #4C4C4C;" >Evaluaci&oacute;n <span style="color: orange;">Hiss-Cam</span> </h1>
				</div>
				<table id="tablaGeneral"  data-mode="reflow" style="border:solid 1px;border-collapse: collapse;padding: 0;width: 100%;display: table;color: #333;text-shadow: 0 1px 0 #f3f3f3;" >
					<thead></thead>
					<tbody>
						<!-- encabezado de la evaluacion -->
						<tr>
							<table data-mode="reflow" style="border:solid 1px;border-collapse: collapse;padding: 0;width: 100%;display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;color: #333;text-shadow: 0 1px 0 #f3f3f3;font-size: 1em;line-height: 1.3;font-family: sans-serif;border-bottom: 1px solid #e6e6e6;border-bottom: 1px solid rgba(0,0,0,.05);">
								<thead></thead>
								<tbody>
									<tr>
										<th class="cabeceraNormal">Nombre y Departamento</th>
										<td>
											<label id="lblNombreYDepto" >' . $strNombreDepto . '</label>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Fecha del reporte</th>
										<td>
											<label id="txtFechaCreacion">' . $FechaReporteConvertido . '</label>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Tema</th>
										<td>
											<label id="txtTema">' . $strTema . '</label>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Pa&iacute;s/Regi&oacute;n</th>
										<td>
											<label id="txtPaisRegion">' . $strPaisRegion . '</label>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Ejercito/Otro actor</th>
										<td>
											<label id="txtEjercito">' . $strEjercitoOtro . '</label>							
										</td>
									</tr>
									<tr>
										<th class="subCabecera">Status quo</th>
										<td>
											<label id="txtStatusQuo">' . $strStatusQuo . '</label>							
										</td>
									</tr>
									<tr>
										<th class="subCabecera">Cambio propuesto</th>
										<td>
											<label id="txtCambioPropuesto">' . $strCambioProp . '</label>							
										</td>
									</tr>
									<tr >
										<th class="cabeceraNormal">Resumen especifico</th>
										<td>
											<label id="txtResumenEspecifico">' . $strResumenEspec . '</label>							
										</td>
									</tr>
								</tbody>
							</table>
							<br><br>
						</tr>
						<!-- parte hiss -->
						<tr>
							<table  data-mode="reflow" style=" width: 100%; border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
								<thead class="cabeceraNormal">
									<td colspan="2">Principio</td>
									<td>Respuesta</td>
									<td>S/N</td>
								</thead>
								<tbody>
									<!-- Humanitaria imperativa -->
									<tr>
										<td style="width:5%;"><h1 style="font-size: 7em; color:orange;">H</h1></td>
										<td style="width:35%">
											<p>											
												<div style="text-align: left;">
													<h3>umanitaria Imperativa</h3>
													Es esta acci&oacute;n:<br>
													>	&iquest;Solamente ocurre en orden de adelantar la imperativa humanitaria para proveer 
													ayuda a esos en necesidad, de acuerdo con los m&aacute;s altos est&aacute;ndares de entrega de ayuda?  
												</div>
											</p>
										</td>
										<td style="width:35%">
											<label id="txtRespuestaH">' . $strRespH1 . '</label>
										</td>
										<td style="width:25%">';

										if($strSiNoH1 == 1){
											$strHtml .= '
											<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '
											<label><b>No</b></label>';
										}

										$strHtml .= '	
											<br>';

										if($strBanderaH1 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}
											$strHtml .= '
										</td>
									</tr>
									<!-- Imparcialidad e independencia -->
									<tr>
										<td><h1 style="font-size: 7em; color:orange;">I</h1></td>
										<td>
											<p>
												<div style="text-align: left;">
													<h3>mparcialidad e Independencia</h3>								
													Est&aacute; esta acci&oacute;n asegurando que:
													<br>> 	&iquest;No discriminamos en base a g&eacute;nero, raza, etnicidad, religi&oacute;n, nacionalidad, afiliaci&oacute;n pol&iacute;tica estatus social?
													<br>>	&iquest;Nuestro alivio es guiado por una evaluaci&oacute;n de necesidades?
													<br>>	&iquest;prioridad es  dada a los casos m&aacute;s urgentes de angustia?
												</div>
											</p>
										</td>
										<td>
											<label  id="txtRespuestaI0">' . $strRespI0 . '</label>
										</td>
										<td>';

										if($strSiNoI0 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI0 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='																							
											</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<p>											
												<div style="text-align: left;">
													>	&iquest;Somos neutrales en la provisi&oacute;n de ayuda (particularmente en el contexto de emergencias complejas)?
												</div>
											</p>
										</td>
										<td>
											<label id="txtRespuestaI1">' . $strRespI1 . '</label>
											</td>
											<td>';

										if($strSiNoI1 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI1 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='												
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<p>											
														<div style="text-align:left;">
															Est&aacute; esta acci&oacute;n asegurando que: <br>
															>	&iquest;nuestro compromiso es hacia la imperativa humanitaria y no a la 
															agenda de gobiernos, grupos pol&iacute;ticos, o fuerzas militares?
														</div>
													</p>
												</td>
												<td>
													<label  id="txtRespuestaI2">' . $strRespI2 . '</label>
												</td>
												<td>';

										if($strSiNoI2 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI2 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='													
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														<p>											
															<div style="text-align:left;">
																>	&iquest;nosotros no actuamos de una manera que entrega nuestra habilidad de advocar? 
															</div>
														</p>
													</td>
													<td>
														<label id="txtRespuestaI3">' . $strRespI3 . '</label>
													</td>
													<td>';

										if($strSiNoI3 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI3 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
														
														</td>
													</tr>
													<tr>
														<td></td>
														<td>
															<p>											
																<div style="text-align:left;">
																	>	&iquest;nosotros no ponemos en peligro la libertad de movimiento del personal humanitario?
																</div>
															</p>
														</td>
														<td>
															<label id="txtRespuestaI4">' . $strRespI4 . '</label>
														</td>
														<td>';

										if($strSiNoI4 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI4 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='													
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<p>											
													<div style="text-align: left;">
														>	&iquest;tenemos la libertad de conducir evaluaciones independientes?
													</div>
												</p>
											</td>
											<td>
												<label id="txtRespuestaI5">' . $strRespI5 . '</label>
											</td>
											<td>';

										if($strSiNoI5 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI5 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='																								
												</td>
											</tr>
										<tr>
											<td></td>
											<td>
												<p>											
													<div style="text-align: left;">
														>	&iquest;tenemos la libertad de seleccionar el personal?
													</div>
												</p>
											</td>
											<td>
												<label id="txtRespuestaI6">' . $strRespI6 . '</label>
											</td>
											<td>';

										if($strSiNoI6 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI6 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<p>											
														<div style="text-align: left;">
															>	&iquest;tenemos la libertad de identificar beneficiarios en base a necesidades? 
														</div>
													</p>
												</td>
												<td>
													<label id="txtRespuestaI7">' . $strRespI7 . '</label>
												</td>
												<td>';

										if($strSiNoI7 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI7 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
													</td>
												</tr>
													<tr>
														<td></td>
														<td>
															<p>											
																<div style="text-align: left;">
																	>	&iquest;tenemos un flujo de informaci&oacute;n libre entre las agencias humanitarias?
																</div>
															</p>
														</td>
														<td>
																<label id="txtRespuestaI8">' . $strRespI8 . '</label>
															</td>
															<td>';

										if($strSiNoI8 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaI8 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
												
												</td>
											</tr>
											<!-- Seguridad y proteccion -->
											<tr>
												<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
												<td>
													<p>
														<div style="text-align: left;">
															<h3>eguridad y Protecci&oacute;n</h3>								
															Mediante una r&aacute;pida evaluaci&oacute;n de "No hacer daño" del contexto, est&aacute; esta acci&oacute;n garantizando que podamos prevenir a lo mejor de nuestra capacidad cualquier tipo de consecuencias no deseadas para: <br> 
															>	&iquest;la seguridad de nuestro personal?<br>
															>	&iquest;la seguridad de nuestros compañeros locales?<br>
															>	&iquest;la seguridad de nuestros beneficiarios?<br>
															>	&iquest;la seguridad de nuestras agencias?<br>
															>	&iquest;el fomento de conflicto?
														</div>
													</p>
												</td>
												<td>
													<label id="txtRespuestaS1">' . $strRespS0_1 . '</label>
												</td>
												<td>';

										if($strSiNoS0_1 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaS0_1 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
													</td>
												</tr>
												<tr>
													<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
													<td>
														<p>
															<div style="text-align: left;">
																<h3>ostenibilidad</h3>								
																Es esta acci&oacute;n: <br>
																>	&iquest;tomando en cuenta una perspectiva de plazo m&aacute;s largo que la inmediata?
															</div>
														</p>
													</td>
													<td>
														<label id="txtRespuestaS2_0">' . $strRespS2_0 . '</label>
													</td>
													<td>';

										if($strSiNoS2_0 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaS2_0 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<p>
													<div style="text-align: left;">
														>	&iquest;alineada estrat&eacute;gicamente con el trabajo de VM en la asistencia de comunidades para vencer la pobreza e injusticia?
													</div>
												</p>
											</td>
											<td>
														<label id="txtRespuestaS2_1">' . $strRespS2_1 . '</label>
													</td>
													<td>';

										if($strSiNoS2_1 == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										if($strBanderaS2_1 == 1){
											$strHtml .= '<label><img src="' . $BanderaEncoded . '" alt="bandera"/></label>';
										}else{
											$strHtml .= '<label></label>';
										}

										$strHtml .='
														</td>
													</tr>
												</tbody>
											</table>
										</tr>

										<!-- parte cam -->
										<tr>
											<table data-mode="reflow" style="border:solid 1px;width: 100%" class="ui-responsive table-stroke ui-table ui-table-">
												<thead class="cabeceraNormal">
													<td colspan="2">Proceso</td>
													<td>Respuesta</td>
													<td>S/N</td>
												</thead>
												<tbody>
													<tr>
														<td style="width: 5%;"><h1 style="font-size: 7em; color:orange;">C</h1></td>
														<td style="width: 35%;">
															<p>
																<div style="text-align: left;">
																	<h3>onvincente prop&oacute;sito</h3>								
																	Es esta acci&oacute;n:<br>
																	>	&iquest;en busca de un prop&oacute;sito importante o convincente? (consideraciones econ&oacute;micas en y de ellos mismos nunca debe constituir esto)
																	<br>>	&iquest;en busca de un resultado deseado especifico?
																	<br>>	&iquest;alineado con las miras estrat&eacute;gicas de VM (incluyendo global, regional, nacional)?
																</div>
															</p>
														</td>
														<td style="width: 35%;">
															<label id="txtRespuestaC">' . $strRespC . '</label>
														</td>
														<td style="width: 25%;">';

										if($strSiNoC == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										$strHtml .='															
														</td>
													</tr>
													<tr>
														<td><h1 style="font-size: 7em; color:orange;">A</h1></td>
														<td>
															<p>											
																<div style="text-align: left;">
																	<h3>propiado, adaptado & adecuadamente informado</h3>								
																	Es esta acci&oacute;n: <br>
																	>	&iquest;apropiado para su prop&oacute;sito (ej. razonable y por evidencia conectado a la mira anterior)?  
																	<br>>	&iquest;adaptado al contexto?
																	<br>>	&iquest;adecuadamente informado por medio de evidencia tal como an&aacute;lisis y evaluaciones de contexto existentes y cualquier informaci&oacute;n nueva disponible?
																</div>
															</p>
														</td>
														<td>
															<label  id="txtRespuestaA">' . $strRespA . '</label>
														</td>
														<td>';

										if($strSiNoA == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										$strHtml .='
														</td>
													</tr>
													<tr>
														<td><h1 style="font-size: 7em; color:orange;">M</h1></td>
														<td>
															<p>
																<div style="text-align: left;">
																	<h3>inimo impacto negativo</h3>								
																	Es esta acci&oacute;n: <br>
																	>	&iquest;el &uacute;ltimo recurso en obtener la meta (ej. todos los otros medios han sido agotados)?
																	<br>>	el menos impactante:<br>
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	&iquest;en la inmediata y largo plazo?<br>
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	&iquest;en accionistas (comunidades, iguales de industria y VM)?
																</div>
															</p>
														</td>
														<td>
															<label id="txtRespuestaM">' . $strRespM . '</label>
														</td>
														<td>';

										if($strSiNoM == 1){
											$strHtml .= '<label><b>S&iacute;</b></label>';
										}else{
											$strHtml .= '<label><b>No</b></label>';
										}

										$strHtml .='
														</td>
													</tr>
												</tbody>
											</table>
										</tr>

										<!-- parte de recomendacion -->
										<tr>
											<table width="100%" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
												<thead>
													<th colspan="2"  class="cabeceraNormal">
														<h2><b>' . $strCompromiso . '</b></h2>
													</th>
												</thead>
												<tbody>
													<tr>									
														<td style="width:20%">
															<h3><b>Recomendaci&oacute;n</b></h3>
														</td>
														<td>
															<label id="txtRecomendacion">' . $strRecomendacion . '</textarea>
														</td>									
													</tr>
												</tbody>
											</table>
										</tr>

																

										<!-- parte decision final y base -->
										<tr>
											<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
												<thead class="cabeceraNormal">
													<th colspan="2">									
														<h3>Decisi&oacute;n final y base</h3>
													</th>
												</thead>
												<tbody>
													<tr>									
														<td style="width: 35%;">
															<b>Nombre y departamento</b>
														</td>
														<td>
															<label id="txtNombreyDepaFinal">' . $strNombreDepaFinal . '</label>
														</td>									
													</tr>
													<tr>									
														<td>
															<b>Fecha de recibo</b>
														</td>
														<td>
															<label id="txtFechaRecibo">' . $FechaReciboConvertido . '</label>
														</td>									
													</tr>
													<tr>									
														<td>
															<b>
																>	&iquest;Acuerdo con evaluaci&oacute;n?<br>
																>	&iquest;&aacute;reas de desacuerdo?<br>
																>	&iquest;El proceso se mueve hacia adelante?<br>
																>	&iquest;Qu&eacute; grupos han sido alertadas?<br>
															</b>
														</td>
														<td>
															<label id="txtDecisionFinalUltima">' . $strDecisionFinal . '</label>
														</td>									
													</tr>
													<tr>									
														<td>
															<b>
																Aprobado por
															</b>
														</td>
														<td>
															<label id="txtAprobadoPor">' . $strAprobadoPor . '</label>
														</td>									
													</tr>
												</tbody>
											</table>
										</tr>										
									</tbody>			
								</table>
							</div>
						</div>';

$strusr = $_SESSION["Usuario"];
		$idReporteHissCam = $db_funciones->insertarReporteHissCam($strNombreDepto,$strFechaReporte,$strTema,$strPaisRegion,$strEjercitoOtro,$strCompromiso,$strHtml);
		$db_funciones->Bitacora($strusr, 'Creacion de reporte HISS-CAM con identificador "' . $idReporteHissCam . '"');
		echo $idReporteHissCam;
}

if($strMetodo == "SendEMailHissCam")
SendNewMailHissCam();

function SendNewMailHissCam(){
$headers = "De: adminVM@vm.com \r\n";
        // $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";        
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$Correos = $_POST["mails"];
	$Estilos = $_POST['estilos'];
	$idReporte = $_POST["idRepo"];
    $strHtml = "";
	try {
        $result = $db_funciones->getHtmlReporteHISSCAM($idReporte);
    while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
        $strHtml = $row[0];
        break;
    }

    // $strHtml = $strHtml.replace("<html>", "");
    // $strHtml = "<html> <style>" . $Estilos . "</style> " . $strHtml;

    $db_funciones->EnviarCorreo($Correos, "Reporte HISS-CAM - Visión Mundial", $strHtml);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
if($strMetodo == "ReporteCRR")
CrearReporteCRR();

function CrearReporteCRR(){
	include_once "funciones.php";
	$db_funciones = new Funciones();

	$strHtml = "";

	$strTipoObjeto = $_POST["PjxTipoObjeto"];
	$strFecha = $_POST["PjxFecha"];
	$strElaboradoPor = $_POST["PjxElaboradoPor"];
	$strIdPais = $_POST["PjxIdPais"];
	$strIdEvento = $_POST["PjxIdEvento"];	
	$strIdPunto = $_POST["PjxIdPunto"];	
	$strPais = $_POST["PjxPais"];
	$strEvento = $_POST["PjxEvento"];
	$strPunto = $_POST["PjxPunto"];
	$strTot1 = $_POST["PjxTot1"];
	$strTot2 = $_POST["PjxTot2"];
	$strTot3 = $_POST["PjxTot3"];
	$strTot4 = $_POST["PjxTot4"];
	$strTot5 = $_POST["PjxTot5"];
	$strTot6 = $_POST["PjxTot6"];
	$strTot7 = $_POST["PjxTot7"];
	$strTotal = $_POST["PjxTot"];
	$strExp1 = $_POST["PjxExp1"];
	$strExp2 = $_POST["PjxExp2"];
	$strExp3 = $_POST["PjxExp3"];
	$strExp4 = $_POST["PjxExp4"];
	$strExp5 = $_POST["PjxExp5"];
	$strExp6 = $_POST["PjxExp6"];
	$strExp7 = $_POST["PjxExp7"];
	$strFila1 = $_POST["PxjFila1"];
	$strFila2 = $_POST["PxjFila2"];
	$strFila3 = $_POST["PxjFila3"];
	$strFila4 = $_POST["PxjFila4"];
	$strFila5 = $_POST["PxjFila5"];
	$strFila6 = $_POST["PxjFila6"];
	$strFila7 = $_POST["PxjFila7"];

	$dcmNivelRiesgo = floatval($strTotal);
	$strNivelRiesgo = "";
	$strRiesgo = "";

	if($dcmNivelRiesgo >= 1 && $dcmNivelRiesgo <= 1.79){
		$strNivelRiesgo = '<td bgcolor="#00FF00">INSIGNIFICANTE</td>';
		$strRiesgo = "INSIGNIFICANTE";
	}else if($dcmNivelRiesgo > 1.79 && $dcmNivelRiesgo <= 2.59){
		$strNivelRiesgo = '<td bgcolor="#E8E118">BAJO</td>';
		$strRiesgo = "BAJO";
	}else if($dcmNivelRiesgo > 2.59 && $dcmNivelRiesgo <= 3.39){
		$strNivelRiesgo = '<td bgcolor="#E88018">MEDIO</td>';
		$strRiesgo = "MEDIO";
	}else if($dcmNivelRiesgo > 3.39 && $dcmNivelRiesgo <= 4.19){
		$strNivelRiesgo = '<td bgcolor="#E81818">ALTO</td>';
		$strRiesgo = "ALTO";
	}else if($dcmNivelRiesgo > 4.19 && $dcmNivelRiesgo <= 5){
		$strNivelRiesgo = '<td bgcolor="#000000" style="color: white;"">CR&Iacute;TICO</td>';
		$strRiesgo = "CRITICO";
	}else{
		$strNivelRiesgo = "<td></td>";
	}

	$strHtml .= '
	<table border="1" cellpadding="2" data-mode="reflow" style="border:solid 1px;border-collapse: collapse;padding: 0;width: 100%;display: table;color: #333;text-shadow: 0 1px 0 #f3f3f3;border-color:orange">
	<tbody>
		<tr>
			';
			if($strTipoObjeto == "0"){
				$strHtml .= "<td><label>Pa&iacute;s</label></td>
			<td>
			" . $strPais . "
			</td>";
			}else if($strTipoObjeto == "1"){
				$strHtml .= "<td><label>Evento</label></td>
				<td>
					" . $strEvento . "
				</td>";
			}else{
				$strHtml .= "<td><label>Punto de evaluaci&oacute;n</label></td>
				<td>
					" . $strPunto . "
				</td>";
			}
		$strHtml .= '						
		</tr>
		<tr>
			<td>Fecha de elaboraci&oacute;n</td>
			<td>' . date("d/m/Y", strtotime($strFecha)) . '</td>
		</tr>
		<tr>
			<td>Elaborador por</td>
			<td>' . $strElaboradoPor . '</td>
		</tr>
	</tbody>
	</table>
	<table border="1" cellpadding="2" data-mode="reflow" style="border:solid 1px;border-collapse: collapse;padding: 0;width: 100%;display: table;color: #333;text-shadow: 0 1px 0 #f3f3f3;border-color:orange">
					<tbody>
						<tr>
							<td colspan="2">Foco</td>
							<td colspan="2">Rating</td>
							<td colspan="4">Descripci&oacute;n del contexto</td>
							<td colspan="2">Opci&oacute;n</td>
							<td>Rating</td>
						</tr>

						<!-- tabla 1 Social y politica -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Social &amp; Pol&iacute;tica</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que son estables y libres de desordenes pol&iacute;ticos, econ&oacute;micos y civiles. Hay insignificante violencia religiosa, de sectores, racial/tribu y pol&iacute;tica. 
								</label>
							</td>';
							if($strFila1 == "tb1_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb1_td0">
									<div class="ui-radio ui-mini" id="tb1_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb1_td0">
									<div class="ui-radio ui-mini" id="tb1_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que son generalmente estables, pero pueden haber tiempos de inestabilidad pol&iacute;tica & econ&oacute;mica y desorden civil. Pueden haber instancias aisladas de violencia religiosa, de sectores, racial/tribu y pol&iacute;tica. 
								</label>
							</td>
							';
							if($strFila1 == "tb1_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb1_td1">
									<div class="ui-radio ui-mini" id="tb1_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb1_td1">
									<div class="ui-radio ui-mini" id="tb1_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses y provincias que experimentan inestabilidad pol&iacute;tica & econ&oacute;mica y desorden civil; hay debilidades significativas en los sistemas y capacidades de Gobierno. Puede haber  un numero de incidentes que involucren violencia religiosa, de sector, racial/tribu y pol&iacute;tica y la situaci&oacute;n puede ser muy vol&aacute;til. 
								</label>
							</td>
							';
							if($strFila1 == "tb1_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb1_td2">
									<div class="ui-radio ui-mini" id="tb1_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb1_td2">
									<div class="ui-radio ui-mini" id="tb1_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que experimentan inestabilidad pol&iacute;tica & econ&oacute;mica  y desorden civil regularmente. Los sistemas pol&iacute;ticos est&aacute;n inherentemente inestables y pueden colapsar en cualquier momento. Incidentes involucrando violencia religiosa, de sector, racial/tribu, pol&iacute;tica y extremismo son comunes y en algunas ocasiones pueden ser blancos los extranjeros. 
								</label>
							</td>
							';
							if($strFila1 == "tb1_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb1_td3">
									<div class="ui-radio ui-mini" id="tb1_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb1_td3">
									<div class="ui-radio ui-mini" id="tb1_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Pa&iacute;s o provincias que son estados fallidos; instituciones pol&iacute;ticas & econ&oacute;micas han colapsado. La violencia por religi&oacute;n, de sector, racial y pol&iacute;tica esta por todos lados y afecta todos los niveles de la sociedad y tiene como blanco directo a extranjeros.  
								</label>
							</td>
							';
							if($strFila1 == "tb1_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb1_td4">
									<div class="ui-radio ui-mini" id="tb1_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb1_td4">
									<div class="ui-radio ui-mini" id="tb1_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp1 . '</label>
							</td>
							<td>
								<label id="lblTbRating1">
									' . $strTot1 . '
								</label>
							</td>
						</tr>
						
						<!-- tabla 2 Crimen y seguridad-->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Crimen &amp; Seguridad</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Hay bajos niveles de crimen violento, pero puede haber niveles variantes de cr&iacute;menes menores en &aacute;reas urbanas o &aacute;reas aisladas. Fuerzas de seguridad local son profesionales, previenen & detectan efectivamente el crimen, y son generalmente libres  de corrupci&oacute;n.
								</label>
							</td>
							';
							if($strFila2 == "tb2_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb2_td0">
									<div class="ui-radio ui-mini" id="tb2_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb2_td0">
									<div class="ui-radio ui-mini" id="tb2_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Hay bajos niveles de violencia, pero hay cr&iacute;menes menores expandidos en ares especificas. Hay grupos de crimen organizados presentes, pero generalmente est&aacute;n controladas por las autoridades. Las fuerzas de seguridad local son profesionales, pero pueden haber bajos niveles de corrupci&oacute;n.   
								</label>
							</td>
							';
							if($strFila2 == "tb2_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb2_td1">
									<div class="ui-radio ui-mini" id="tb2_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb2_td1">
									<div class="ui-radio ui-mini" id="tb2_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Hay altos niveles de cr&iacute;menes violentos que  hacen impacto en extranjeros y la poblaci&oacute;n local.
									Los grupos de crimen organizados son muy activos y controlan un n&uacute;mero de &aacute;reas urbanas. Los fuerzas de seguridad local son eneralmente inadecuadas and puede sufrir de corrupci&oacute;n sistem&aacute;tico. 
								</label>
							</td>
							';
							if($strFila2 == "tb2_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb2_td2">
									<div class="ui-radio ui-mini" id="tb2_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb2_td2">
									<div class="ui-radio ui-mini" id="tb2_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay muy altos niveles de cr&iacute;menes violentos que tienen impacto en extranjeros y en la poblaci&oacute;n local. Grupos del crimen organizado son muy fuertes y pueden operar libremente. Las fuerzas de seguridad local son inadecuadas y hay abusos regulares del proceso legal debido a la corrupci&oacute;n. 
								</label>
							</td>
							';
							if($strFila2 == "tb2_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb2_td3">
									<div class="ui-radio ui-mini" id="tb2_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb2_td3">
									<div class="ui-radio ui-mini" id="tb2_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Hay niveles extremos de crimen violento que tiene impacto en extranjeros y en la poblaci&oacute;n local.
									Grupos de crimen organizado son particularmente fuertes y est&aacute;n en conflicto abierto con fuerzas del gobierno por control. Las fuerzas de seguridad local son m&iacute;nimas o no-existentes y el gobierno no tiene control de la ley & el orden. 

								</label>
							</td>
							';
							if($strFila2 == "tb2_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb2_td4">
									<div class="ui-radio ui-mini" id="tb2_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb2_td4">
									<div class="ui-radio ui-mini" id="tb2_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp2 . '</label>
							</td>
							<td>
								<label id="lblTbRating2">
									' . $strTot2 . '
								</label>
							</td>
						</tr>

						<!-- tabla 3 Conflicto -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Conflicto</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									No hay conflicto armado actual y hay muy poco riesgo de cualquier conflicto futuro. 
								</label>
							</td>
							';
							if($strFila3 == "tb3_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb3_td0">
									<div class="ui-radio ui-mini" id="tb3_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb3_td0">
									<div class="ui-radio ui-mini" id="tb3_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									No hay conflicto armado actual y un bajo riesgo de conflictos futuros. 
								</label>
							</td>
							';
							if($strFila3 == "tb3_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb3_td1">
									<div class="ui-radio ui-mini" id="tb3_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb3_td1">
									<div class="ui-radio ui-mini" id="tb3_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Puede haber disputas o un bajo nivel de insurgencia operando en el pa&iacute;s, hay un riesgo significativo de que el conflicto incremente. Puede haber una amenaza indirecta al personal de ONG de conflictos localizados.
								</label>
							</td>
							';
							if($strFila3 == "tb3_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb3_td2">
									<div class="ui-radio ui-mini" id="tb3_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb3_td2">
									<div class="ui-radio ui-mini" id="tb3_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Un conflicto  interno  localizado o de frontera a frontero puede estar en progreso. Puede haber guerrilla o grupos insurgentes en control de &aacute;reas especificas del pa&iacute;s. Estos grupos son una seria amenaza para la estabilidad del pa&iacute;s. Algunos actores en el conflicto pueden ver a las ONGI’s como blancos leg&iacute;timos. 
								</label>
							</td>
							';
							if($strFila3 == "tb3_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb3_td3">
									<div class="ui-radio ui-mini" id="tb3_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb3_td3">
									<div class="ui-radio ui-mini" id="tb3_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									El pa&iacute;s o &aacute;rea esta en estado o Guerra. La guerrilla y grupos insurgentes est&aacute;n en control de &aacute;reas significativas del pa&iacute;s y estos grupos son una seria amenaza para la estabilidad del pa&iacute;s. El conflicto no discrimina y la amenaza a ONGI’s es critica.

								</label>
							</td>
							';
							if($strFila3 == "tb3_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb3_td4">
									<div class="ui-radio ui-mini" id="tb3_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb3_td4">
									<div class="ui-radio ui-mini" id="tb3_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp3 . '</label>
							</td>
							<td>
								<label id="lblTbRating3">
									' . $strTot3 . '
								</label>
							</td>
						</tr>

						<!-- tabla 4 Terrorismo -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.2</b></div>								
								<div>Terrorismo</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									La actividad de grupos terroristas (o simpatizantes) es insignificante. 
								</label>
							</td>
							';
							if($strFila4 == "tb4_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb4_td0">
									<div class="ui-radio ui-mini" id="tb4_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb4_td0">
									<div class="ui-radio ui-mini" id="tb4_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Puede haber grupos terroristas presentes, pero tienen capacidades operacionales limitadas y los actos de terrorismo son extremadamente raros. 
								</label>
							</td>
							';
							if($strFila4 == "tb4_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb4_td1">
									<div class="ui-radio ui-mini" id="tb4_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb4_td1">
									<div class="ui-radio ui-mini" id="tb4_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Puede haber grupos terroristas con capacidades de operaci&oacute;n significativas y el pa&iacute;s esta propenso a  que ocurran actos de terrorismo espor&aacute;dicos. 
								</label>
							</td>
							';
							if($strFila4 == "tb4_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb4_td2">
									<div class="ui-radio ui-mini" id="tb4_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb4_td2">
									<div class="ui-radio ui-mini" id="tb4_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay grupos terroristas presentes con Fuertes capacidades & alcance operacional; hay una seria amenaza al gobierno y a blancos internacionales. 
								</label>
							</td>
							';
							if($strFila4 == "tb4_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb4_td3">
									<div class="ui-radio ui-mini" id="tb4_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb4_td3">
									<div class="ui-radio ui-mini" id="tb4_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Los grupos terroristas son muy activos con capacidades significativas & alcance operacional; hay una extrema amenaza para el gobierno y blancos internacionales. 

								</label>
							</td>
							';
							if($strFila4 == "tb4_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb4_td4">
									<div class="ui-radio ui-mini" id="tb4_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb4_td4">
									<div class="ui-radio ui-mini" id="tb4_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp4 . '</label>
							</td>
							<td>
								<label id="lblTbRating4">
									' . $strTot4 . '
								</label>
							</td>
						</tr>						

						<!-- tabla 5 Secuestro  -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Secuestro</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Hay poco, o ning&uacute;n, riesgo de secuestro o  toma de rehenes. El panorama es estable.  
								</label>
							</td>
							';
							if($strFila5 == "tb5_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb5_td0">
									<div class="ui-radio ui-mini" id="tb5_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb5_td0">
									<div class="ui-radio ui-mini" id="tb5_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Hay bajo riesgo de secuestro y toma de rehenes. 
								</label>
							</td>
							';
							if($strFila5 == "tb5_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb5_td1">
									<div class="ui-radio ui-mini" id="tb5_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb5_td1">
									<div class="ui-radio ui-mini" id="tb5_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Hay un riesgo significativo de secuestro o toma de rehenes en ciertas &aacute;reas. 
								</label>
							</td>
							';
							if($strFila5 == "tb5_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb5_td2">
									<div class="ui-radio ui-mini" id="tb5_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb5_td2">
									<div class="ui-radio ui-mini" id="tb5_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay un alto riesgo de secuestro o toma de rehenes en todo el pa&iacute;s y las fuerzas de seguridad pueden ser c&oacute;mplices, o estar directamente involucrados.  
								</label>
							</td>
							';
							if($strFila5 == "tb5_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb5_td3">
									<div class="ui-radio ui-mini" id="tb5_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb5_td3">
									<div class="ui-radio ui-mini" id="tb5_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Hay un serio riesgo de secuestro o toma de rehenes en todo el pa&iacute;s y las fuerzas de seguridad pueden ser c&oacute;mplices o estar directamente involucradas. 
								</label>
							</td>
							';
							if($strFila5 == "tb5_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb5_td4">
									<div class="ui-radio ui-mini" id="tb5_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb5_td4">
									<div class="ui-radio ui-mini" id="tb5_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp5 . '</label>
							</td>
							<td>
								<label id="lblTbRating5">
									' . $strTot5 . '
								</label>
							</td>
						</tr>

						<!-- tabla 6 Espacio Humanitario  -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.10</b></div>								
								<div>Espacio Humanitario</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Organizaciones humanitarias pueden operar libremente y entregan una gran gama de programas con apoyo del gobierno y libre de restricciones impuestas por otros actores. 
								</label>
							</td>
							';
							if($strFila6 == "tb6_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb6_td0">
									<div class="ui-radio ui-mini" id="tb6_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb6_td0">
									<div class="ui-radio ui-mini" id="tb6_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Organizaciones humanitarias generalmente pueden operar libremente y entregar una gran gama de programas con algunas restricciones del gobierno u otros actores. 
								</label>
							</td>
							';
							if($strFila6 == "tb6_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb6_td1">
									<div class="ui-radio ui-mini" id="tb6_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb6_td1">
									<div class="ui-radio ui-mini" id="tb6_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Las organizaciones humanitarias est&aacute;n restringidas en algunas &aacute;reas de operaci&oacute;n y puede haber Resistencia a su presencia de secciones de la comunidad. El gobierno u otros actores claves pueden obstruir la operaci&oacute;n de ONGI’s de ciertos pa&iacute;ses.    
								</label>
							</td>
							';
							if($strFila6 == "tb6_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb6_td2">
									<div class="ui-radio ui-mini" id="tb6_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb6_td2">
									<div class="ui-radio ui-mini" id="tb6_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Las operaciones humanitarias est&aacute;n severamente restringidas  y hay hostilidad abierta a la presencia de ONGI’s. Puede haber un blanco directo hacia las ONGI’s por grupos militantes. El gobierno u otros actores pueden obstruir activamente las operaciones de ONGI’s y amenazar con expulsi&oacute;n. 
								</label>
							</td>
							';
							if($strFila6 == "tb6_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb6_td3">
									<div class="ui-radio ui-mini" id="tb6_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb6_td3">
									<div class="ui-radio ui-mini" id="tb6_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Las organizaciones humanitarias  no pueden operar seguramente en el ambiente y las operaciones son generalmente insostenibles.  Hay un blanco directo hacia las ONGI’s por actores en el contexto. El gobierno u otros actores son hostiles para la ONGI’s y las han expulsados de &aacute;reas operacionales. 
								</label>
							</td>
							';
							if($strFila6 == "tb6_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb6_td4">
									<div class="ui-radio ui-mini" id="tb6_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb6_td4">
									<div class="ui-radio ui-mini" id="tb6_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp6 . '</label>
							</td>
							<td>
								<label id="lblTbRating6">
									' . $strTot6 . '
								</label>
							</td>
						</tr>

						<!-- tabla 7 Infraestructura -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.10</b></div>								
								<div>Infraestructura</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son de muy altos est&aacute;ndares y raramente interrumpidos. 
								</label>
							</td>
							';
							if($strFila7 == "tb7_td0"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb7_td0">
									<div class="ui-radio ui-mini" id="tb7_td0">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb7_td0">
									<div class="ui-radio ui-mini" id="tb7_td0">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son de buenos est&aacute;ndares y raramente interrumpidos.
								</label>
							</td>
							';
							if($strFila7 == "tb7_td1"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb7_td1">
									<div class="ui-radio ui-mini" id="tb7_td1">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb7_td1">
									<div class="ui-radio ui-mini" id="tb7_td1">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son interrumpidos regularmente y tienen est&aacute;ndares de seguridad cuestionables.   
								</label>
							</td>
							';
							if($strFila7 == "tb7_td2"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb7_td2">
									<div class="ui-radio ui-mini" id="tb7_td2">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb7_td2">
									<div class="ui-radio ui-mini" id="tb7_td2">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y servicios esenciales  son muy pobres; interrupci&oacute;n y fallo es muy com&uacute;n.  
								</label>
							</td>
							';
							if($strFila7 == "tb7_td3"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb7_td3">
									<div class="ui-radio ui-mini" id="tb7_td3">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb7_td3">
									<div class="ui-radio ui-mini" id="tb7_td3">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y servicios esenciales son severamente degradados o inexistentes.
								</label>
							</td>
							';
							if($strFila7 == "tb7_td4"){
								$strHtml .= '
								<td colspan="2" bgcolor="#00FF00" id="tb7_td4">
									<div class="ui-radio ui-mini" id="tb7_td4">
									</div>
								</td>
								';
							}else{
								$strHtml .= '
								<td colspan="2" id="tb7_td4">
									<div class="ui-radio ui-mini" id="tb7_td4">
									</div>
								</td>
								';
							}
							$strHtml .= '
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<label name="txtTb1Exp" id="txtTb1Exp">' . $strExp7 . '</label>
							</td>
							<td>
								<label id="lblTb1Rating7">
									' . $strTot7 . '
								</label>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									
								</label>
							</td>							
							<td colspan="5" style="background-color:orange; text-align:center; color:#e1e1e1;">
								<label>
									Calificaci&oacute;n de Riesgo del contexto basado en la herramienta/gu&iacute;a de OCS
								</label>
							</td>
							<td>
								<label id="lblTbRatingFinal">
									' . $strTotal . '
								</label>
							</td>
							' . $strNivelRiesgo . '
						</tr>						
					</tbody>
				</table>
	';

	$idReporteCRR = $db_funciones->insertarReporteCRR($strElaboradoPor,$strRiesgo,$strTipoObjeto, $strIdPunto, $strIdEvento, $strIdPais, $strHtml, $strFecha);
	$db_funciones->Bitacora($_SESSION["Usuario"], 'Creacion de reporte CRR con identificador "' . $idReporteCRR . '"');
	echo $idReporteCRR;
	//echo $strElaboradoPor." - ".$strRiesgo." - ".$strTipoObjeto." - ".$strIdPunto." - ".$strIdEvento." - ".$strIdPais." - ".$strHtml." - ".$strFecha;

/*
$strHtml = "";

	$strTipoObjeto = $_POST["PjxTipoObjeto"];
	$strFecha = $_POST["PjxFecha"];
	$strElaboradoPor = $_POST["PjxElaboradoPor"];
	$strIdPais = $_POST["PjxIdPais"];
	$strIdEvento = $_POST["PjxIdEvento"];	
	$strIdPunto = $_POST["PjxIdPunto"];	
	$strPais = $_POST["PjxPais"];
	$strEvento = $_POST["PjxEvento"];
	$strPunto = $_POST["PjxPunto"];
	$strTot1 = $_POST["PjxTot1"];
	$strTot2 = $_POST["PjxTot2"];
	$strTot3 = $_POST["PjxTot3"];
	$strTot4 = $_POST["PjxTot4"];
	$strTot5 = $_POST["PjxTot5"];
	$strTot6 = $_POST["PjxTot6"];
	$strTot7 = $_POST["PjxTot7"];
	$strTotal = $_POST["PjxTot"];
	$strExp1 = $_POST["PjxExp1"];
	$strExp2 = $_POST["PjxExp2"];
	$strExp3 = $_POST["PjxExp3"];
	$strExp4 = $_POST["PjxExp4"];
	$strExp5 = $_POST["PjxExp5"];
	$strExp6 = $_POST["PjxExp6"];
	$strExp7 = $_POST["PjxExp7"];
	$strFila1 = $_POST["PxjFila1"];
	$strFila2 = $_POST["PxjFila2"];
	$strFila3 = $_POST["PxjFila3"];
	$strFila4 = $_POST["PxjFila4"];
	$strFila5 = $_POST["PxjFila5"];
	$strFila6 = $_POST["PxjFila6"];
	$strFila7 = $_POST["PxjFila7"];

	$dcmNivelRiesgo = floatval($strTotal);
	$strNivelRiesgo = "";
	$strRiesgo = "";

	if($dcmNivelRiesgo >= 1 && $dcmNivelRiesgo <= 1.79){
		$strNivelRiesgo = "<td bgcolor='#00FF00'>INSIGNIFICANTE</td>";
		$strRiesgo = "INSIGNIFICANTE";
	}else if($dcmNivelRiesgo > 1.79 && $dcmNivelRiesgo <= 2.59){
		$strNivelRiesgo = "<td bgcolor='#E8E118'>BAJO</td>";
		$strRiesgo = "BAJO";
	}else if($dcmNivelRiesgo > 2.59 && $dcmNivelRiesgo <= 3.39){
		$strNivelRiesgo = "<td bgcolor='#E88018'>MEDIO</td>";
		$strRiesgo = "MEDIO";
	}else if($dcmNivelRiesgo > 3.39 && $dcmNivelRiesgo <= 4.19){
		$strNivelRiesgo = "<td bgcolor='#E81818'>ALTO</td>";
		$strRiesgo = "ALTO";
	}else if($dcmNivelRiesgo > 4.19 && $dcmNivelRiesgo <= 5){
		$strNivelRiesgo = "<td bgcolor='#000000' style='color: white;'>CR&Iacute;TICO</td>";
		$strRiesgo = "CRITICO";
	}else{
		$strNivelRiesgo = "<td></td>";
	}
*/
}



?>