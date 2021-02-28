<?php

require 'clases/conexion.php';
session_start();

$sql ="select sp_empleado(".$_REQUEST['accion'].",".(!empty($_REQUEST['vemp_cod'])? $_REQUEST['vemp_cod']:"0")
    .",".(!empty($_REQUEST['vcar_cod'])?$_REQUEST['vcar_cod']:"0").",'"
        .(!empty($_REQUEST['vemp_nombre'])?$_REQUEST['vemp_nombre']:"")."','"
        .(!empty($_REQUEST['vemp_apellido'])?$_REQUEST['vemp_apellido']:"")."','"
        .(!empty($_REQUEST['vemp_direcc'])?$_REQUEST['vemp_direcc']:"")."','"
        .(!empty($_REQUEST['vemp_tel'])?$_REQUEST['vemp_tel']:"")."') as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*", $resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:empleado_index.php");    
}
