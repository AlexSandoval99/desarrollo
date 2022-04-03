<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller/favicon.ico">
        <title>TALLER</title>
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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-plus"></i>
                                        <h3 class="box-title">Agregar Pedido de Materia Prima</h3>
                                    <div class="box-tools">
                                        <a href="pedmater_index.php" class="btn btn-primary btn-sm" data-title = "Volver" 
                                           rel="tooltip" data-placement="top"> 
                                            <i class="fa fa-arrow-left"></i></a>                                        
                                    </div>
                                </div>
                                <!-- AQUI VA EL CONTENIDO DE LA TABLA-->
                                <div class="box-body">
                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje']=''; ?>
                                </div>
                                <?php }?>           
                                    <form action="pedmater_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vpedm_cod" value="0">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                                    <?php $fecha = consultas::get_datos("select current_date as fecha");?>
                                                    <label>Fecha:</label>
                                                    <input type="date" name="vped_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha'];?>" readonly="">
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                                            
                                                    <label>Empleado:</label>
                                                    <input type="text" name="vempleado" class="form-control" required="" value="<?php echo $_SESSION['nombres'];?>" readonly="">
                                                </div> 
                                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                                            
                                                    <label>Sucursal:</label>
                                                    <input type="text" name="vsucursal" class="form-control" required="" value="<?php echo $_SESSION['sucursal'];?>" readonly="">
                                                </div>                                         
                                            </div>                                            
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-floppy-o"></i> Registrar
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });
        </script>
    </body>
</html>


