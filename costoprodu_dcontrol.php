<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_ordcompra(".$_REQUEST['accion'].",".$_REQUEST['vord_com'].","
        .$_REQUEST['vdep_cod'].",split_part('".$_REQUEST['vart_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vord_cant'])?$_REQUEST['vord_cant']:"0").","
        .(!empty($_REQUEST['vord_precio'])?$_REQUEST['vord_precio']:"0").") as resul";


//INSERT INTO detalle_ordcompra(ord_com, dep_cod, art_cod, ord_cant, ord_precio)
$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:ordcompras_det.php?vord_com=".$_REQUEST['vord_com']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:ordcompras_det.php?vord_com=".$_REQUEST['vord_com']);   
}