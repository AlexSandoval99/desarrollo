<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_ord_pro "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and orden_estad='PENDIENTE' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vordpro_cod">
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione una Orden</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['ordpro_cod']?>"><?php echo "N°:".$pedido['ordpro_cod']." - FECHA:".$pedido['orden_fecha'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El no tiene</option>
        <?php }?>
    </select>     
</div>
