<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_det_pedmat(".$_REQUEST['accion'].",".$_REQUEST['vpedm_cod'].
        ",split_part('".$_REQUEST['vmater_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vdet_cant'])?$_REQUEST['vdet_cant']:"0").","
        .$_REQUEST['vdep_cod'].") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:pedmater_det.php?vpedm_cod=".$_REQUEST['vpedm_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:pedmater_det.php?vpedm_cod=".$_REQUEST['vpedm_cod']);   
}