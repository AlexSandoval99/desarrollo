<?php
 
//echo $_REQUEST ['usuario']. " <br>";
//echo $_REQUEST ['clave'];

require 'clases/conexion.php';
session_start();
$intento = 0;
$sql = "select * from v_usuarios where usu_nick = '".$_REQUEST['usuario']."' "
        . "and usu_clave = md5('".$_REQUEST['clave']."')";

$resultado = consultas ::get_datos($sql);

if ($resultado == null){
    $consulintentos = consultas:: get_datos("select intento from usuarios where usu_nick = '".$_REQUEST['usuario']."'");
    $intentos = intval($consulintentos[0]["intento"]);  
    var_dump($consulintentos, $intentos);
    $intento = $intentos + 1;
    $_SESSION['error'] = 'Usuario o contraseña incorrecto';
    $upd = "update usuarios set intento = " .$intento. "where usu_nick = '".$_REQUEST['usuario']."'";
    $resul = consultas ::get_datos($upd);
    if($intentos >= 1 ){
        $_SESSION['error'] = 'Le queda 1 Intento luego sera bloqueado';
    }
        if($intentos >= 2 ){
            $updi = "update usuarios set usu_clave = md5('123') where usu_nick = '".$_REQUEST['usuario']."'";
        $result = consultas ::get_datos($updi);
        $_SESSION['error'] = 'Acceso Bloqueado';
        }
        
        header("location:index.php");
        
        }else{
    $up = "update usuarios set intento = 0 where usu_nick = '".$_REQUEST['usuario']."'";
    $re = consultas ::get_datos($up);
    $_SESSION['usu_cod']= $resultado[0]['usu_cod'];
    $_SESSION['usu_nick']= $resultado[0]['usu_nick'];
    $_SESSION['usu_foto']= '';
    $_SESSION['emp_cod']= $resultado[0]['emp_cod'];
    $_SESSION['nombres']= $resultado[0]['empleado'];
    $_SESSION['cargo']= $resultado[0]['car_descri'];
    $_SESSION['gru_cod']= $resultado[0]['gru_cod'];
    $_SESSION['grupo']= $resultado[0]['gru_nombre'];
    $_SESSION['id_sucursal']= $resultado[0]['id_sucursal'];
    $_SESSION['sucursal']= $resultado[0]['suc_descri'];
    header("location:menu.php");
    
}

