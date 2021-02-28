<?php
require 'clases/conexion.php';

session_start();

$sql= "select sp_transferencia(".$_REQUEST['accion'].",".$_REQUEST['vtrans_cod'].",'".(!empty($_REQUEST['vorig_trans'])?$_REQUEST['vorig_trans']:"0")."',"
        . "'".(!empty($_REQUEST['vdest_trans'])?$_REQUEST['vdest_trans']:"0")."',".(!empty($_REQUEST['vcant'])?$_REQUEST['vcant']:"0").",".$_SESSION['id_sucursal'].") as resul;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    //$valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:transferencia_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
  header("location:transferencia_index.php");    
}