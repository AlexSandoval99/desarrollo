<?php
require 'clases/conexion.php';

session_start();
//PDO::PARAM_STR;
//PDO::PARAM_STR('vmar_descri');
//mysqli_real_escape_string($_REQUEST);
//$sttmnt = $miPdo->prepare($sql);
//$sttmnt->bindParam('vmar_descri', $region, PDO::PARAM_STR);
//$sttmnt->execute();
$sql = "select sp_etapa(".$_REQUEST['accion'].",".$_REQUEST['vetap_pruducc_cod'].",'". str_replace("'", "''", $_REQUEST['vetap_descri'])."') as resul;";


    $resultado= consultas::get_datos($sql);
      
if ($resultado[0]['resul']!= null){
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:etapa_index.php");
}else{
  
    $_SESSION['mensaje']='error al procesar ' . $sql;
    header("location:etapa_index.php");
}
?>