<?php 
require 'clases/conexion.php';

$detalles = consultas::get_datos("select * from v_detalle_pedcompra where ped_com=".$_REQUEST['vped_com']
        ." and art_cod=".$_REQUEST['vart_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
//var_dump($detalles);
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Detalle de Pedido</h4>
</div>
<form action="ordcompra_dcontrol" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="1">
    <input type="hidden" name="vord_com" value="<?php echo $_REQUEST['vord_com'];?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod'];?>">
    <input type="hidden" name="vdep_cod" value="<?php echo $detalles[0]['dep_cod'];?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Deposito:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" class="form-control" name="vdep_descri" value="<?php echo $detalles[0]['dep_descri'];?>" readonly="">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulos:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" class="form-control" name="vart_descri" value="<?php echo $detalles[0]['art_descri'];?>" readonly="">
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <input type="number" class="form-control" name="vord_cant" min="1" value="<?php echo $detalles[0]['ped_cant'];?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Precio:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="number" class="form-control" name="vord_precio" min="1" value="<?php echo $detalles[0]['ped_precio'];?>"/>
            </div>
        </div> 
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Agregar</button>
    </div>
</form>
