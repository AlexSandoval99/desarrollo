<?php

require 'clases/conexion.php';
session_start();

$sql ="select sp_deposito(".$_REQUEST['accion'].",".(!empty($_REQUEST['vdep_cod'])? $_REQUEST['vdep_cod']:"0")
    .",'".(!empty($_REQUEST['vdep_descri'])?$_REQUEST['vdep_descri']:"")."',"
        .(!empty($_REQUEST['vid_sucursal'])?$_REQUEST['vid_sucursal']:"0").") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:deposito_index.php");    
}
