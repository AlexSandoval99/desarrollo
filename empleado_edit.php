<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>ALL'Cort</title>
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
                             <h3 class="box-title">Editar Empleado</h3>
                            <div class="box-tools">
                                <a href="empleado_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                                <i class="fa fa-arrow-left"></i></a>
                            </div>
                            
                    </div>
                            <form action="empleado_control.php" method="POST" accept_charset="utf-8" class="form-horizontal">
                                <?php $resultado= consultas::get_datos("select * from empleado where emp_cod=".$_GET['vemp_cod']) ?>
                                <div class="box-body">
                                    <input type="hidden" name="accion" value="2">
                                    <input type="hidden" name="vemp_cod" value=" <?php echo $resultado[0]['emp_cod']?> " >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Cargo</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                           <?php $car = consultas::get_datos("select * from cargo order by car_cod");?>
                                                    <select class="form-control select2" name="vcar_cod" required="">
                                                        <?php if (!empty($car)) {                                                         
                                                        foreach ($car as $ca) { ?>
                                                        <option value="<?php echo $ca['car_cod']?>"><?php echo $ca['car_descri']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos una cargo</option>
                                                        <?php }?>
                                                    </select> 
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Nombre</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vemp_nombre" value="<?php echo $resultado[0]['emp_nombre']?>" required="">
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Apellido</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vemp_apellido" value="<?php echo $resultado[0]['emp_apellido']?>" required="">
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Direccion</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vemp_direcc" value="<?php echo $resultado[0]['emp_direcc']?>" required="">
                                            
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Telefono</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vemp_tel" value="<?php echo $resultado[0]['emp_tel']?>" required="">
                                            
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

