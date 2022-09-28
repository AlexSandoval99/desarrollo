<?php


require 'clases/conexion.php';

$sql = "select * from v_usuarios where usu_nick = '".$_REQUEST['usuario']."' and usu_clave = md5('".$_REQUEST['clave']."')";

$resultado = consultas::get_datos($sql);

session_start();

if ($resultado[0]['usu_cod']==null) {
    header("location:menu.php");
}else{
    $new_sql = "select sp_cambiar_contraseña(". 1 .",".$_REQUEST['vusu_cod'].",'".$_REQUEST['new_clave']."') as resul";

    $resultado = consultas::get_datos($new_sql);
    
    if ($resultado[0]['resul']!=null) {
        $_SESSION['mensaje'] = $resultado[0]['resul'];
        header("location:menu.php");
    }else{
        $_SESSION['mensaje'] = "Error:".$sql;
        header("location:menu.php");    
    }

    header("location:menu.php");
}