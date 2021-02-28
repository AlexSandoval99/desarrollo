<?php 
require 'clases/conexion.php';
session_start();
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="fa fa-paper-plane"></i> Transferencia de Mercaderia</h4>
</div>
<form action="usuarios_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="1">
    <input type="hidden" name="vdep_cod" value="0">
    <div class="modal-body">
    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Origen:</label>
        <div class="col-lg-8 col-md-8">
                <?php $dep = consultas::get_datos("select * from deposito order by dep_descri");?>
                <select class="form-control select2" name="vdep_cod" required="">
                    <?php if (!empty($dep)) {                                                         
                    foreach ($dep as $d) { ?>
                    <option value="<?php echo $d['dep_cod']?>"><?php echo $d['dep_descri']?></option>
                    <?php }                                                    
                    }else{ ?>
                    <option value="">No se encontraron depositos</option>
                    <?php }?>
                </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Destino:</label>
        <div class="col-lg-8 col-md-8">
                   <?php $dep = consultas::get_datos("select * from deposito order by dep_descri");?>
                <select class="form-control select2" name="vdep_cod" required="" >
                    <?php if (!empty($dep)) {                                                         
                    foreach ($dep as $d) { ?>
                    <option value="<?php echo $d['dep_cod']?>"><?php echo $d['dep_descri']?></option>
                    <?php }                                                    
                    }else{ ?>
                    <option value="">No se encontraron depositos</option>
                    <?php }?>
                </select> 
        </div>
    </div>
        <div class="form-group">
         <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
         <div class="col-lg-2 col-md-2 col-sm-2">
       <input type="number" class="form-control" name="vstoc_cant" min="1" value="1"/>
      </div>
      </div>
    
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Crear</button>
    </div>
</form>
