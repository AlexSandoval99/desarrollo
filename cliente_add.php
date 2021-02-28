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
                        <div class="box box-primary">
                    <div class="box-header">
                            <i class="ion ion-plus"></i>
                            <h3 class="box-title">Agregar Clientes</h3>
                            <div class="box-tools">
                                <a href="cliente_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                                <i class="fa fa-arrow-left"></i></a>
                            </div>
                    </div>
                            <form action="cliente_control.php" method="POST" accept_charset="utf-8" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vcli_cod" value="0">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" >CI N°</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="number" class="form-control" name="vcli_ci" required="" autofocus="">
                                            
                                        </div>
                                    </div> 
                                        <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Nombres</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                            <input type="text" class="form-control" name="vcli_nombre" required="">
                                            
                                        </div>
                                    </div> 
                                     <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Apellidos</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                            <input type="text" class="form-control" name="vcli_apellido" required="">
                                            
                                        </div>
                                     </div>
                                    <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Telefono</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                            <input type="number" class="form-control" name="vcli_telefono" >
                                            
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class=" control-label col-lg-2 col-md-2 col-sm-2">Direccion</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                                            <textarea name="vcli_direcc" class="form-control" rows="2"> </textarea>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">
                                    <span class="glyphicon glyphicon-floppy-saved"></span> Registrar
                                    </button>
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

