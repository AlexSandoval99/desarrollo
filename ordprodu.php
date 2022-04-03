<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $pedidos = consultas::get_datos("select * from v_presu_produ "
            . "where cli_cod =".$_REQUEST['vcli_cod']." and presupro_estado='CONFIRMADO' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vpresuprod_cod">
        <?php if (!empty($pedidos)) { ?>                                                     
        <option value="">Seleccione un presupuesto</option>
        <?php foreach ($pedidos as $pedido) { ?>
        <option value="<?php echo $pedido['presuprod_cod']?>"><?php echo "N°:".$pedido['presuprod_cod']." - FECHA:".$pedido['presu_fecha'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El Cliente no tiene presupuesto</option>
        <?php }?>
    </select>     
</div>
