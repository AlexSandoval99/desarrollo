<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_cargo(".$_REQUEST['accion'].",".$_REQUEST['vcar_cod']
        .",'".$_REQUEST['vcar_descri']."') as resul;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL){
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:cargo_index.php");
}else {
    $_SESSION['mensaje'] = "Error al procesar \n".$sql;
    header("location:cargo_index.php");
}