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
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Pedidos de Materia Prima</h3>
                                    <div class="box-tools"> 
                                        <a href="pedmater_add.php" class="btn btn-primary btn-sm" data-title = "Agregar" 
                                           rel="tooltip" data-placement="top"> 
                                            <i class="fa fa-plus"></i></a>                                        
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
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="pedmater_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                            <?php
                                               /* $valor ='';
                                                if (isset($_REQUEST['buscar'])) {
                                                    $valor = $_REQUEST['buscar'];
                                                }*/
                                                $pedidos = consultas::get_datos("select * from v_pedido_mater where id_sucursal =".$_SESSION['id_sucursal']." and"
                                                        . "(emp_cod||empleado) ilike '%".(isset($_REQUEST['buscar'])? $_REQUEST['buscar']:'')."%' order by pedm_cod desc ");
                                                if (!empty($pedidos)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Fecha</th>
                                                                <th>Empleado</th>
                                                                <th>Estado</th>
        
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>proveedor
                                                            <?php foreach ($pedidos as $pedido) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $pedido['pedm_cod'];?></td>
                                                                <td data-title="Fecha"><?php echo $pedido['ped_fecha'];?></td>
                                                                <td data-title="Empleado"><?php echo $pedido['empleado'];?></td>
                                                                <td data-title="Estado"><?php echo $pedido['ped_estado'];?></td>
                                                                <td data-title="Acciones" class="text-center">
                                                                    <?php if($pedido['ped_estado']=="PENDIENTE"){?>
                                                                    <a href="pedmater_det.php?vpedm_cod=<?php echo $pedido['pedm_cod'];?>" class="btn btn-success btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                             
                                                                        <a onclick="anular(<?php echo "'".$pedido['pedm_cod']."_".$pedido['empleado']."'"?>)"  class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" 
                                                                        data-toggle="modal" data-target="#anular">
                                                                        <span class="glyphicon glyphicon-remove"></span></a>  
                                                                    <?php }?>
                                                                    <a href="pedmaer_print.php?vpedm_cod=<?php echo $pedido['pedm_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Imprimir" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-print"></span></a>                                                                          
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado pedido de Materia Prima...
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
                  <!-- MODAL PARA BORRAR-->
                  <div class="modal fade" id="anular" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-danger" id="confirmacion"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="si" role='buttom' class="btn btn-primary">
                                          <span class="glyphicon glyphicon-ok-sign"> SI</span>
                                      </a>
                                  </div>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA BORRAR-->                   
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });
        </script>
    <script>
        function anular(datos){
                var dat = datos.split("_");
                $('#si').attr('href','pedmater_control.php?vpedm_cod='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular el pedido N° <strong>'+dat[0]+'</strong> ?');
        }
    </script>
    </body>
</html>


