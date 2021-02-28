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
                <!--CONTENEDOR PRINCIPAL -->
                <div class="content">
                    <!--FILA-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-1212 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ioon ion-plus"></i>
                                    <h3 class="box-title">Agregar Proveedor</h3>
                                    <div class="box-tools">
                                        <a href="proveedor_index.php" class="btn btn-primary pull-right btn-sm"dat-title="Volver"rel="tooltip"
                                           data-placement="top" >
                                            <i class="fa fa-arrow-left"></i></a>
                                        
                                    </div>
                                </div> <!-- /box-geader -->
                                <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vprv_cod" value="0">

                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">RUC:</label>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="number" class="form-control" name="vprv_ruc" required autofocus>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Razon Social:</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <input type="text" class="form-control" name="vprv_razonsocial" required >
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Direccion:</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <input type="text" class="form-control" name="vprv_direccion" required >
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Telefono:</label>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <input type="number" class="form-control" name="vprv_telefono">
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-floppy-o"></i>
                                                Registrar</button>
                                            
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>                            
                        </div>                      
                    </div>                 
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
        $("#mensaje").delay(4000).slideUp(200, function(){
        $(this).alert('close');
        });
            </script>
    </body>
</html>

