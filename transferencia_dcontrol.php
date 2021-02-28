<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_trans(".$_REQUEST['accion'].",".$_REQUEST['vtrans_cod'].",".(!empty($_REQUEST['vdep_cod'])?$_REQUEST['vdep_cod']:"0").",".(!empty($_REQUEST['vdepdes_cod'])?$_REQUEST['vdepdes_cod']:'NULL').",split_part('".(!empty($_REQUEST['vart_cod'])?$_REQUEST['vart_cod']:"0")."','_',1)::integer,"
        .(!empty($_REQUEST['vtrns_cant'])?$_REQUEST['vtrns_cant']:"0").") as resul";
//var_dump($sql);
$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:transferencia_det.php?vtrans_cod=".$_REQUEST['vtrans_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:transferencia_det.php?vtrans_cod=".$_REQUEST['vtrans_cod']);    
}