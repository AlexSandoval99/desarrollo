<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_ordmater(".$_REQUEST['accion'].",".$_REQUEST['vordpro_cod']
        .",".(!empty($_REQUEST['vmater_cod'])?$_REQUEST['vmater_cod']:"0").", "
        .(!empty($_REQUEST['vart_cod'])?$_REQUEST['vart_cod']:"0").","
        .(!empty($_REQUEST['vcant'])?$_REQUEST['vcant']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:ordprodu_det.php?vordpro_cod=".$_REQUEST['vordpro_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:ordprodu_det.php?vordpro_cod=".$_REQUEST['vordpro_cod']);    
} 