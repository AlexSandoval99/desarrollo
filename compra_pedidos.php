<?php
require 'clases/conexion.php';
session_start();
?>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <?php $orden = consultas::get_datos("select * from v_orden_cabcompra "
            . "where prv_cod =".$_REQUEST['vprv_cod']." and ord_estado='PENDIENTE' "
            . "and id_sucursal=".$_SESSION['id_sucursal']);
    ?>
    <select class="form-control select2" name="vord_com" required="">
        <?php if (!empty($orden)) { ?>                                                     
        <option value="">Seleccione una orden</option>
        <?php foreach ($orden as $ordens) { ?>
        <option value="<?php echo $ordens['ord_com']?>"><?php echo "N°:".$ordens['ord_com']." - FECHA:".$ordens['ord_fecha'];?></option>
        <?php }                                                    
        }else{ ?>
        <option value="">El Proveedor no tiene orden</option>
        <?php }?>
    </select>     
</div>
