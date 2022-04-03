<?php
require 'clases/conexion.php';

session_start();
$sql= "select sp_orden_produ(".$_REQUEST['accion'].",".$_REQUEST['vordpro_cod'].
        ",".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").",".$_SESSION['emp_cod']
         .",".$_SESSION['id_sucursal']
        .",".(!empty($_REQUEST['vequip_cod'])?$_REQUEST['vequip_cod']:"0").",".(!empty($_REQUEST['vpresuprod_cod'])?$_REQUEST['vpresuprod_cod']:"0").") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:ordprodu_index.php".$valor[1]);
} else {
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:ordprodu_index.php");
}