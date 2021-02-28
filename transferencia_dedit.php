<?php 
require 'clases/conexion.php';

$detalles = consultas::get_datos("select * from v_detalle_trans where trans_cod=".$_REQUEST['vtrans_cod']
        ." and art_cod=".$_REQUEST['vart_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
//var_dump($detalles);
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="fa fa-plus"></i> Editar Detalle del Transferencia</h4>
</div>
<form action="transferencia_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vtrans_cod" value="<?php echo $detalles[0]['trans_cod'];?>">
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
            <div class="col-lg-6 col-md-6 col-sm-6">
                <input type="text" class="form-control" name="vart_descri" value="<?php echo $detalles[0]['art_descri'];?>" readonly="">
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <input type="number" class="form-control" name="vtrns_cant" min="1" value="<?php echo $detalles[0]['trns_cant'];?>"/>
            </div>
        </div>
         
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Actualizar</button>
    </div>
</form>
