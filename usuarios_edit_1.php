<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>LP3</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
        session_start();/*Reanudar sesion*/
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
           
                
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
 <!--contenedor principal-->
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-warning">
                    <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                             <h3 class="box-title">Editar usuario</h3>
                            <div class="box-tools">
                                <a href="empleado_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                                <i class="fa fa-arrow-left"></i></a>
                            </div>
                            
                    </div>
                           <form action="usuarios_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
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
             <?php $usuario = consultas::get_datos("select * from v_usuarios ");?>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Nick</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vusu_nick" value="<?php echo $usuario[0]['vusu_nick']?>" required="">
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Password</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="password" class="form-control" name="vusu_clave" value="<?php echo $usuario[0]['vusu_clave']?>" required="">
                                            
                                        </div>
                                    </div> 
                                    
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-warning pull-right">
                                    <span class="glyphicon glyphicon-edit"></span> Modificar
                                    </button>
                                </div> 
                                </div>
                      </form>
                
             </div>
           </div>
         </div>
            </div>
      </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        
    </body>
</html>

