<?php

require 'clases/conexion.php';
session_start();

$sql ="select sp_cliente(".$_REQUEST['accion'].",".(!empty($_REQUEST['vcli_cod'])? $_REQUEST['vcli_cod']:"0")
    .",".(!empty($_REQUEST['vcli_ci'])? $_REQUEST['vcli_ci']:"0").""
        . ",'".(!empty($_REQUEST['vcli_nombre'])?$_REQUEST['vcli_nombre']:"")."','"
        .(!empty($_REQUEST['vcli_apellido'])?$_REQUEST['vcli_apellido']:"")."','"
        .(!empty($_REQUEST['vcli_telefono'])?$_REQUEST['vcli_telefono']:"")."','"
        .(!empty($_REQUEST['vcli_direcc'])?$_REQUEST['vcli_direcc']:"")."') as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:cliente_index.php");    
}
