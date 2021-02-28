<?php
require 'clases/conexion.php';

session_start();
$sql= "select sp_ordcompra(".$_REQUEST['accion'].",".$_REQUEST['vord_com'].",".$_SESSION['emp_cod'].","
        .(!empty($_REQUEST['vprv_cod'])?$_REQUEST['vprv_cod']:"0").",".$_SESSION['id_sucursal']
        .",".(!empty($_REQUEST['vped_com'])?$_REQUEST['vped_com']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL) {
    $valor = explode("*",$resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:ordcompra_index.php");    
}

