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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Depositos</h3>
                                    <div class="box-tools">
                                        <a href="deposito_print.php" class="btn btn-default btn-sm" data-title ="Imprimir" rel="tooltip" data-placement="top" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>                                        
                                        <a href="deposito_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" 
                                           data-placement="top">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                                <div class="alert alert-danger" role="alert" id="mensaje">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    <?php echo $_SESSION['mensaje'];
                                                    $_SESSION['mensaje'] ='';
                                                    ?>
                                                </div>
                                                <?php } ?>
                                                <form action="" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                    <div class="box-body">
                                                        <div class="form-group">                                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Ingrese parametro de búsqueda" autofocus="">
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar..." rel="tooltip" 
                                                                            data-placement="top">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>                                                
                                                <?php $deposito = consultas::get_datos("select * from v_deposito "
                                                        . "where (suc_descri||dep_descri) ilike '%".(isset($_REQUEST['buscar'])? $_REQUEST['buscar']:'')."%' order by dep_cod");
                                                 if (!empty($deposito)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Deposito</th> 
                                                                <th>Sucursal</th> 
                                                                
                                                                <th class="text-center">Acciones</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($deposito as $dep) { ?>
                                                            <tr>
                                                                <td data-title="Articulo"><?php echo $dep['dep_descri'];?></td>
                                                                <td data-title="Marca"><?php echo $dep['suc_descri'];?></td>
                                                                
                                                                <td class="text-center">
                                                                    <a href="deposito_edit.php?vdep_cod=<?php echo $dep['dep_cod'];?>" class="btn btn-warning btn-sm" data-title="Editar" 
                                                                        rel="tooltip" data-placement="top" role="button">
                                                                        <i class="fa fa-edit"></i>   
                                                                    </a>
                                                                     <a onclick="borrar(<?php echo "'".$dep['dep_cod']."_".$dep['dep_descri']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>                                                                    
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <?php }else{ ?>
                                                <div class="alert alert-info">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado deposito...
                                                </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
                   <! - MODAL PARA BORRAR ->
                  <div class = "modal fade" id = "borrar" role = "dialog">
                      <div class = "modal-dialog">
                          <div class = "modal-content">
                              <div class = "modal-header">
                                  <button class = "close" data-dismiss = "modal" aria-label = "Cerrar">
                                      <i class = "fa fa-remove"> </i> </button>
                                      <h4 class = "modal-title custom_align" id = "Heading"> Atencion !!! </h4>
                              </div>
                               <div class = "modal-body">
                                   <div class = "alert alert-danger" id = "confirmacion"> </div>
                                  </div>
                                  <div class = "modal-footer">
                                      <button data-dismiss = "modal" class = "btn btn-default"> <i class = "fa fa-remove"> </i> NO </button>
                                      <a id="si" role='buttom' class="btn btn-primary">
                                          <span class = "glyphicon glyphicon-ok-sign"> SI </span>
                                      </a>
                                  </div>
                          </div>
                      </div>                      
                  </div>
                  <! - FIN MODAL PARA BORRAR ->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
        $("#mensaje").delay(4000).slideUp(200,function(){
            $(this).alert('close');
        })
        </script>
        <script>
         function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','deposito_control.php?vdep_cod='+dat[0]+'&vdep_descri='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar el cargo <i><strong>'+dat[1]+'</strong></i>?');
            }
        </script> 
    </body>
</html>
