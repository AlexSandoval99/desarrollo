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
                            <h3 class="box-title">Editar Deposito</h3>
                            <div class="box-tools">
                                <a href="deposito_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                                <i class="fa fa-arrow-left"></i></a>
                            </div>
                            
                    </div>
                            <form action="deposito_control.php" method="POST" accept_charset="utf-8" class="form-horizontal">
                                <?php $resultado= consultas::get_datos("select * from deposito where dep_cod=".$_GET['vdep_cod']) ?>
                                <div class="box-body">
                                    <input type="hidden" name="accion" value="2">
                                    <input type="hidden" name="vdep_cod" value=" <?php echo $resultado[0]['dep_cod']?> " >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >Descripcion</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" name="vdep_descri" value="<?php echo $resultado[0]['dep_descri']?>" required="">
                                            
                                        </div>
                                    </div> 
                                        <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Sucursal</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                           <?php $sucu = consultas::get_datos("select * from sucursal order by id_sucursal");?>
                                                    <select class="form-control select2" name="vid_sucursal" required="">
                                                        <?php if (!empty($sucu)) {                                                         
                                                        foreach ($sucu as $suc) { ?>
                                                        <option value="<?php echo $suc['id_sucursal']?>"><?php echo $suc['suc_descri']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos una sucursal</option>
                                                        <?php }?>
                                                    </select> 
                                            
                                        </div>
                                    </div> 
                                    
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-warning pull-right">
                                    <span class="glyphicon glyphicon-edit"></span> Modificar
                                    </button>
                                </div> 
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

