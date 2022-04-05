<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_presup(".$_REQUEST['accion'].",".$_REQUEST['vpresuprod_cod']
        .",split_part('".$_REQUEST['vart_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vpresup_cant'])?$_REQUEST['vpresup_cant']:"0").","
        .(!empty($_REQUEST['vprecio_presu'])?$_REQUEST['vprecio_presu']:"0").") as resul";


//INSERT INTO detalle_ordcompra(ord_com, dep_cod, art_cod, ord_cant, ord_precio)
$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:presuprodu_det.php?vpresuprod_cod=".$_REQUEST['vpresuprod_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:presuprodu_det.php?vpresuprod_cod=".$_REQUEST['vpresuprod_cod']);   
}