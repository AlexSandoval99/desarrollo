<?php 
require 'clases/conexion.php';
session_start();
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="ion ion-person-add"></i> Agregar Usuario</h4>
</div>
<form action="usuarios_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="1">
    <input type="hidden" name="vusu_cod" value="0">
    <div class="modal-body">
    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Empleado:</label>
        <div class="col-lg-8 col-md-8">
                <?php $empleados = consultas::get_datos("select * from empleado where emp_cod not in(select emp_cod from usuarios) order by emp_nombre");?>
                <select class="form-control select2" name="vemp_cod" required="">
                    <?php if (!empty($empleados)) {                                                         
                    foreach ($empleados as $empleado) { ?>
                    <option value="<?php echo $empleado['emp_cod']?>"><?php echo $empleado['emp_nombre']." ".$empleado['emp_apellido']?></option>
                    <?php }                                                    
                    }else{ ?>
                    <option value="">No se encontraron empleados sin usuario</option>
                    <?php }?>
                </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Grupo:</label>
        <div class="col-lg-6 col-md-6">
                <?php $grupos = consultas::get_datos("select * from grupos order by gru_nombre");?>
                <select class="form-control select2" name="vgru_cod" required="">
                    <?php if (!empty($grupos)) {                                                         
                    foreach ($grupos as $grupo) { ?>
                    <option value="<?php echo $grupo['gru_cod']?>"><?php echo $grupo['gru_nombre']?></option>
                    <?php }                                                    
                    }else{ ?>
                    <option value="">Debe insertar al menos un grupo</option>
                    <?php }?>
                </select> 
        </div>
    </div>
         <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Sucursal:</label>
        <div class="col-lg-6 col-md-6">
                <?php $sucursal = consultas::get_datos("select * from sucursal order by suc_descri");?>
                <select class="form-control select2" name="vsuc_descri" required="">
                    <?php if (!empty($sucursal)) {                                                         
                    foreach ($sucursal as $sucur) { ?>
                    <option value="<?php echo $sucur['id_sucursal']?>"><?php echo $sucur['suc_descri']?></option>
                    <?php }                                                    
                    }else{ ?>
                    <option value="">Debe insertar al menos una sucursal</option>
                    <?php }?>
                </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2 col-md-2 col-sm-2">Alias/Nick:</label>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <input type="text" class="form-control" name="vusu_nick" minlength="4"/>
        </div>
    </div>
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Contraseña:</label>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="password" class="form-control" name="vusu_clave" minlength="4"/>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Crear</button>
    </div>
</form>
