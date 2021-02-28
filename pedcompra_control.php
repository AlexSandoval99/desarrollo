<?php
require 'clases/conexion.php';

session_start();

$sql= "select sp_pedcompra(".$_REQUEST['accion'].",".$_REQUEST['vped_com'].",".$_SESSION['emp_cod'].","
        .(!empty($_REQUEST['vprv_cod'])?$_REQUEST['vprv_cod']:"0").",".$_SESSION['id_sucursal'].") as resul;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    //$valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:pedcompra_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:pedcompra_index.php");    
}