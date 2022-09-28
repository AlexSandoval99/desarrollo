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
                        <div class="box box-primary">
                    <div class="box-header">
                            <i class="ion ion-plus"></i>
                            <h3 class="box-title">Agregar Etapa de Produccion</h3>
                            <div class="box-tools">
                                <a href="etapa_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                                <i class="fa fa-arrow-left"></i></a>
                            </div>
                    </div>
                            <form action="etapa_control.php" method="POST" accept_charset="utf-8" class="from-horizontal">
                                <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vetap_pruducc_cod" value="0">
                                <div class="box-body">
                                    <div class="from-group">
                                        <label class="col-lg-2" control-label>Descripcion</label>
                                        <div class="col-lg-8 col-md-6">
                                            <input type="text" class="from-control"  name="vetap_descri" required="" autofocus="">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">
                                    <span class="glyphicon glyphicon-floppy-saved"></span> Registrar
                                    </button>
                                </div>  
                                    
                            </form>
                            <?php $mar= mysqli_escape_string($link, $_POST["vetap_descri"]) ?>
             </div>
           </div>
         </div>
            </div>
      </div>
                  <?php require 'menu/footer_lte.ctp';             mysqli_real_escape_string($escapestr)?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        
    </body>
</html>


