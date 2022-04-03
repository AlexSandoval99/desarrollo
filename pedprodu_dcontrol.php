<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_det_pedprodu(".$_REQUEST['accion'].",".$_REQUEST['vpro_cod'].","
        ."split_part('".$_REQUEST['vart_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vped_cant'])?$_REQUEST['vped_cant']:"0").","
        .(!empty($_REQUEST['vped_precio'])?$_REQUEST['vped_precio']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:pedprodu_det.php?vpro_cod=".$_REQUEST['vpro_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:pedprodu_det.php?vpro_cod=".$_REQUEST['vpro_cod']);   
}