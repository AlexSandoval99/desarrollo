<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_pedido_cabventa "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and estado='PENDIENTE' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vped_cod" >
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione un pedido</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['ped_cod']?>"><?php echo "N°:".$pedido['ped_cod']." - FECHA:".$pedido['ped_fecha'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El cliente no tiene pedidos</option>
        <?php }?>
    </select>     
</div>
