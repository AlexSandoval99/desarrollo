<?php
require 'clases/conexion.php';
session_start();

$sql = "select sp_usuarios(".$_REQUEST['accion'].",".$_REQUEST['vusu_cod'].",'".$_REQUEST['vusu_nick']."','".(!empty($_REQUEST['vusu_clave'])?$_REQUEST['vusu_clave']:"")."',"
        . "".(!empty($_REQUEST['vemp_cod'])?$_REQUEST['vemp_cod']:"0").", ".(!empty($_REQUEST['vgru_cod'])?$_REQUEST['vgru_cod']:"0").",".(!empty($_REQUEST['vsuc_descri'])?$_REQUEST['vsuc_descri']:"1").") as resul";

//echo $sql;

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:usuarios_index.php");
}else{
    $_SESSION['mensaje']="Error al procesar\n".$sql;
    header("location:usuarios_index.php");    
}

