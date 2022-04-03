<?php
require 'clases/conexion.php';

session_start();

$sql = "select sp_materia(".$_REQUEST['accion'].",".$_REQUEST['vmater_cod'].",'". str_replace("'", "''", $_REQUEST['vmater_descri'])."') as resul;";


    $resultado= consultas::get_datos($sql);
      
if ($resultado[0]['resul']!= null){
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:materia_index.php");
}else{
  
    $_SESSION['mensaje']='error al procesar ' . $sql;
    header("location:marca_index.php");
}
?>