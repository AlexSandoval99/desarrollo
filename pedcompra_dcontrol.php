<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_pedcompra(".$_REQUEST['accion'].",".$_REQUEST['vped_com'].","
        .$_REQUEST['vdep_cod'].",split_part('".$_REQUEST['vart_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vped_cant'])?$_REQUEST['vped_cant']:"0").","
        .(!empty($_REQUEST['vped_precio'])?$_REQUEST['vped_precio']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:pedcompra_det.php?vped_com=".$_REQUEST['vped_com']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:pedcompra_det.php?vped_com=".$_REQUEST['vped_com']);    
}