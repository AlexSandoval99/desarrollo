<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_compra(".$_REQUEST['accion'].",".$_REQUEST['vcom_cod'].",".$_SESSION['emp_cod']
        .",".(!empty($_REQUEST['vprv_cod'])?$_REQUEST['vprv_cod']:"0").","
        . "'".(!empty($_REQUEST['vtipo_compra'])?$_REQUEST['vtipo_compra']:" ")."',"
        .(!empty($_REQUEST['vcan_cuota'])?$_REQUEST['vcan_cuota']:"0").","
        .(!empty($_REQUEST['vcom_plazo'])?$_REQUEST['vcom_plazo']:"0").",".$_SESSION['id_sucursal']
        .",".(!empty($_REQUEST['vord_com'])?$_REQUEST['vord_com']:"0").") as resul";

//echo $sql;

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL) {
    $valor = explode("*",$resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:compra_index.php");    
}

