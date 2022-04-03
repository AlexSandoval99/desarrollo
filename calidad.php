<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_cont_produccion "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and estado_produccion='PENDIENTE' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vcont_producc_cod">
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione un Control de Produccion</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['cont_producc_cod']?>"><?php echo "N°:".$pedido['cont_producc_cod']." - FECHA:".$pedido['fecha']." - ELABORADO POR:".$pedido['empleado'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El no tiene nada elaborado</option>
        <?php }?>
    </select>     
</div>
