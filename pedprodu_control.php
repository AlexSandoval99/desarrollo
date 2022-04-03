<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_ped_produ(" . $_REQUEST['accion'] . "," . $_REQUEST['vpro_cod']
        . "," . $_SESSION['emp_cod'].",". $_SESSION['id_sucursal'] .
        ",".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0"). ") as resul;";

//echo $sql;
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:pedprodu_index.php".$valor[1]);
} else {
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:pedprodu_index.php");
}

