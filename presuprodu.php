<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_pedido_pro "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and ped_estado='PENDIENTE' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vpro_cod">
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione un pedido</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['pro_cod']?>"><?php echo "N°:".$pedido['pro_cod']." - FECHA:".$pedido['ped_fecha'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El Proveedor no tiene pedidos</option>
        <?php }?>
    </select>     
</div>
