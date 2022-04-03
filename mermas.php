<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_detalle_cont_calidad "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and detall='Rechazado' ");
    ?>
    <select class="form-control select2" name="vcont_calid_cod">
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione un control</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['cont_calid_cod']?>"><?php echo "N°: ".$pedido['cont_calid_cod']." - ARTICULO : ".$pedido['art_descri']." - FECHA: ".$pedido['fech_calid'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El Cliente no tiene rechazados</option>
        <?php }?>
    </select>     
</div>
