<?php
require 'clases/conexion.php';

session_start();
$sql= "select sp_contprodu(".$_REQUEST['accion'].",".$_REQUEST['vcont_producc_cod'].",".$_SESSION['emp_cod'].",".$_SESSION['id_sucursal']
        .",".(!empty($_REQUEST['vordpro_cod'])?$_REQUEST['vordpro_cod']:"0").",".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").") as resul";
//var_dump($sql);
$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL) {
    $valor = explode("*",$resultado[0]['resul']);
    $_SESSION['mensaje']=$valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:contprodu_index.php");      
}