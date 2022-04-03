<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_detalle_controcalid(".$_REQUEST['accion'].",".$_REQUEST['vcont_calid_cod'].",".(!empty($_REQUEST['vart_cod'])?$_REQUEST['vart_cod']:"0").",'"
        .(!empty($_REQUEST['vdetall'])?$_REQUEST['vdetall']:" ")."','"
        .(!empty($_REQUEST['vcalidad1'])?$_REQUEST['vcalidad1']:'f')."','".(!empty($_REQUEST['vcalidad2'])?$_REQUEST['vcalidad2']:'f')."','".(!empty($_REQUEST['vcalidad3'])?$_REQUEST['vcalidad3']:'f')."','"
        .(!empty($_REQUEST['vdet1'])?$_REQUEST['vdet1']:" ")."','"
        .(!empty($_REQUEST['vdet2'])?$_REQUEST['vdet2']:" ")."','"
        .(!empty($_REQUEST['vdet3'])?$_REQUEST['vdet3']:" ")."') as resul";
//var_dump($sql);


$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:calidad_det.php?vcont_calid_cod=".$_REQUEST['vcont_calid_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:calidad_det.php?vcont_calid_cod=".$_REQUEST['vcont_calid_cod']);   
}