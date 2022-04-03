<?php
require 'clases/conexion.php';

session_start();
$sql= "select sp_cost_prod(".$_REQUEST['accion'].",".$_REQUEST['vcost_prod_cod'].",".$_SESSION['emp_cod'].","
       .$_SESSION['id_sucursal']. ",".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").",".(!empty($_REQUEST['vpresuprod_cod'])?$_REQUEST['vpresuprod_cod']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL) {
    $valor = explode("*",$resultado[0]['resul']);
     $_SESSION['mensaje'] = $valor[0];
    header("location:costoprodu_index.php".$valor[1]);  
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:compr_index.php");    
}