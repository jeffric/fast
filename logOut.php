<?php 
// Iniciamos sesión 
session_start(); 

//se guarda en la bitacor
$strusr = $_SESSION["Usuario"];
include_once "funciones.php";
$db_funciones = new Funciones();
$db_funciones->Bitacora($strusr, 'LogOut de usuario "' . $strusr . '"');

// Borramos la variable
unset ($_SESSION["idUsuario"]);
unset($_SESSION["Usuario"]);
unset($_SESSION["TipoUsuario"]);
// Borramos toda la sesión
session_destroy();
header("Location: index.php");
?>