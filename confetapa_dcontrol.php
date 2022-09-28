<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_det_confetapa(".$_REQUEST['accion'].",".$_REQUEST['vrec_cod']."
,split_part('".$_REQUEST['vetap_pruducc_cod']."','_',1)::integer) as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:confetapa_det.php?vrec_cod=".$_REQUEST['vrec_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:confetapa_det.php?vrec_cod=".$_REQUEST['vrec_cod']);   
}