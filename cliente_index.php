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
                            <i class="fa fa-users"></i>
                            <h3 class="box-title">Clientes</h3>
                            <div class="box-tools">
                                <a href="cliente_add.php" class="btn btn-primary pull-right btn-sm" data-title="Agregar" rel="tooltip" data-placement="top">
                                <i class="fa fa-plus"></i></a>
                                  <a href="cliente_print.php" class="btn btn-primary pull-right btn-sm" data-title="Imprimir" rel="tooltip">
                                <i class="fa fa-print"></i></a>
                    </div>
                    </div>
                        <div class="box-body no-padding">
                            <?php if (!empty($_SESSION['mensaje'])){ ?>
                        <div class="alert alert-danger" role="alert" id="mensaje">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <?php echo $_SESSION['mensaje'];
                            $_SESSION['mensaje']='';?>
                        </div>
                          <?php } ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
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
                                                <?php $clientes = consultas::get_datos("select * from clientes "
                                                        . "where (cli_cod||cli_nombre||cli_apellido||cli_ci) ilike '%".(isset($_REQUEST['buscar'])? $_REQUEST['buscar']:'')."%' order by cli_cod");
                                if (!empty($clientes)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>CI N°</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Telefono</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($clientes as $cli ){ ?>
                                                <tr>
                                                    <td data-title="CI n°"><?php echo $cli ['cli_ci'];?> </td>
                                                    <td data-title="Nombres"><?php echo $cli ['cli_nombre'];?> </td>
                                                    <td data-title="Apellidos"><?php echo $cli ['cli_apellido'];?> </td>
                                                    <td data-title="Telefono"><?php echo $cli ['cli_telefono'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                        <a href= "cliente_edit?vcli_cod=<?php echo $cli['cli_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                          <a onclick="borrar(<?php echo "'".$cli['cli_cod']."_".$cli['cli_nombre']."_".$cli['cli_apellido']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                    </td>
                                                        
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
    
                               <?php  } else { ?>
                                <div class="alert alert-info flat">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    No se ha registrado Clientes...
                                </div> 
                                <?php }?>
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
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
            </script>
            <script>
         function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','cliente_control.php?vcli_cod='+dat[0]+'&vcli_nombre='+dat[1]+'&vcli_apellido='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar al cliente <strong>'+dat[1]+' '+dat[2]+' </strong>?');
            }
        </script>
    </body>
</html>


