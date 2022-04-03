<?php 
require 'clases/conexion.php';

$detalles = consultas::get_datos("select * from v_det_pedmat where pedm_cod=".$_REQUEST['vpedm_cod']
        ." and mater_cod=".$_REQUEST['vmater_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
//var_dump($detalles);
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="fa fa-plus"></i> Editar Detalle del Pedido</h4>
</div>
<form action="pedmater_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vpedm_cod" value="<?php echo $detalles[0]['pedm_cod'];?>">
    <input type="hidden" name="vmater_cod" value="<?php echo $detalles[0]['mater_cod'];?>">
    <input type="hidden" name="vdep_cod" value="<?php echo $detalles[0]['dep_cod'];?>">
    <div class="modal-body">
        
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Materia Prima:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" class="form-control" name="vmater_descri" value="<?php echo $detalles[0]['mater_descri'];?>" readonly="">
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <input type="number" class="form-control" name="vdet_cant" min="1" value="<?php echo $detalles[0]['det_cant'];?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Deposito:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" class="form-control" name="vdep_descri" value="<?php echo $detalles[0]['dep_descri'];?>" readonly="">
            </div>
        </div>  
        
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Actualizar</button>
    </div>
</form>
