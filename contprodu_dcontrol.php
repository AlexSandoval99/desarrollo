<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_controprodu(".$_REQUEST['accion'].",".$_REQUEST['vcont_producc_cod'].",".(!empty($_REQUEST['vart_cod'])?$_REQUEST['vart_cod']:"0").",'"
        .(!empty($_REQUEST['vdetall'])?$_REQUEST['vdetall']:" ")."','"
        .(!empty($_REQUEST['vetapa1'])?$_REQUEST['vetapa1']:'f')."',".(!empty($_REQUEST['vetap_producc_cod'])?$_REQUEST['vetap_producc_cod']:"0").",".
        (!empty($_REQUEST['vresiduo'])?$_REQUEST['vresiduo']:"0").") as resul";
//var_dump($sql);


 $resultado= consultas::get_datos($sql);

 if ($resultado[0]['resul']!=null) {
     $_SESSION['mensaje']=$resultado[0]['resul'];
     header("location:contprodu_det.php?vcont_producc_cod=".$_REQUEST['vcont_producc_cod']);
 }else{
     $_SESSION['mensaje']="Error al procesar \n".$sql;
     header("location:contprodu_det.php?vcont_producc_cod=".$_REQUEST['vcont_producc_cod']);   
 }