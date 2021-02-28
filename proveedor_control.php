<?php

require 'clases/conexion.php';
session_start();
$sql = "select sp_proveedor(".$_REQUEST['accion'].",".$_REQUEST['vprv_cod'].",'".$_REQUEST['vprv_ruc']
        ."','".$_REQUEST['vprv_razonsocial']."','".$_REQUEST['vprv_direccion']."','"
        .$_REQUEST['vprv_telefono']."') as resul"; 

$resultado = consultas::get_datos($sql);
if ($resultado[0]['resul']!=NULL){
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:proveedor_index.php");
}else {
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:proveedor_index.php");
}