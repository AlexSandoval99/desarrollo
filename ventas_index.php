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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-money"></i>
                                    <h3 class="box-title">Ventas</h3>
                                    <div class="box-tools">
                                        <a href="ventas_add.php" class="btn btn-primary btn-sm" data-title = "Agregar" 
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
                                            <form method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                                $ventas = consultas::get_datos("select * from v_ventas where id_sucursal =".$_SESSION['id_sucursal']." and"
                                                        . "(ven_cod||clientes) ilike '%".(isset($_REQUEST['buscar'])? $_REQUEST['buscar']:'')."%' order by ven_cod desc limit 5");
                                                if (!empty($ventas)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Fecha</th>
                                                                <th>Cliente</th>
                                                                <th>Condición</th>
                                                                <th>Total</th>
                                                                <th>Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($ventas as $venta) { ?>
                                                            <tr>
                                                                <td data-title="#"><?php echo $venta['ven_cod'];?></td>
                                                                <td data-title="Fecha"><?php echo $venta['ven_fecha'];?></td>
                                                                <td data-title="Cliente"><?php echo $venta['clientes'];?></td>
                                                                <td data-title="Condición"><?php echo $venta['tipo_venta'];?></td>
                                                                <td data-title="Total"><?php echo number_format($venta['ven_total'],0,",",".");?></td>
                                                                <td data-title="Estado"><?php echo $venta['ven_estado'];?></td>
                                                                <td data-title="Acciones" class="text-center">
                                                                    <?php if($venta['ven_estado']=='PENDIENTE'){?>
                                                                    <a onclick="confirmar(<?php echo "'".$venta['ven_cod']."_".$venta['clientes']."'"?>)" class="btn btn-success btn-sm" role="button" 
                                                                       data-title="Confirmar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#confirmar"><i class="fa fa-check"></i></a>                                                                    
                                                                    <a href="ventas_det.php?vven_cod=<?php echo $venta['ven_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                    <?php }
                                                                    if($venta['ven_estado']!=='ANULADO'){ ?>
                                                                    <a onclick="anular(<?php echo "'".$venta['ven_cod']."_".$venta['clientes']."'"?>)"  class="btn btn-danger btn-sm" role="button" data-title="Anular" 
                                                                       rel="tooltip" data-placement="top" data-toggle="modal" data-target="#anular"> <span class="glyphicon glyphicon-remove"></span></a>  
                                                                    <?php }?>
                                                                    <a href="ventas_print.php?vven_cod=<?php echo $venta['ven_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Imprimir" 
                                                                       rel="tooltip" data-placement="top" target="print">
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
                                                No se han registrado ventas...
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
                  <!-- MODAL PARA ANULAR-->
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
                  <!-- FIN MODAL PARA ANULAR--> 
                  <!-- MODAL PARA CONFIRMAR-->
                  <div class="modal fade" id="confirmar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-success" id="confirmacionc"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="sic" role='buttom' class="btn btn-primary">
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
                $('#si').attr('href','ventas_control.php?vven_cod='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular la Venta N° <strong>'+dat[0]+'</strong> del cliente <strong>'+dat[1]+'</strong>?');
        };
        function confirmar(datos){
                var dat = datos.split("_");
                $('#sic').attr('href','ventas_control.php?vven_cod='+dat[0]+'&accion=2');
                $('#confirmacionc').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea confirmar la Venta N° <strong>'+dat[0]+'</strong> del cliente <strong>'+dat[1]+'</strong>?');
        }        
    </script>
    </body>
</html>


