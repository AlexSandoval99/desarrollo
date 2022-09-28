<?php
require 'clases/conexion.php';

session_start();

$sql = "select sp_receta(".$_REQUEST['accion'].",".$_REQUEST['vrec_cod'].",".$_REQUEST['vart_cod'].") as resul;";


    $resultado= consultas::get_datos($sql);
      
if ($resultado[0]['resul']!= null){
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:receta_index.php");
}else{
  
    $_SESSION['mensaje']='error al procesar ' . $sql;
    header("location:receta_index.php");
}
?>