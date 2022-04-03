<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller/favicon.ico">
        <title>taller</title>
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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Presupuesto de Produccion</h3>
                            <div class="box-tools">
                                <a href="presuprodu_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" 
                                           data-placement="top">
                                            <i class="fa fa-plus"></i>
                                        </a>
                               
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
                           <!--buscador-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <form action="presuprodu_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                         <div class="input-group custom-search-form">
                                         <input type="search" class="form-control" name="buscar" placeholder="Buscar..." autofocus=""/>
                                         <span class="input-group-btn">
                                         <button type="submit" class="btn btn-primary" data-title="Buscar" data_placement="Bottom" rel="tooltip">
                                         <span class="fa fa-search"></span>
                                         </button>
                                         </span>
                                         </div>
                                                </div>
                                           </div>
                                        </div>
                                    </form>
                                <?php
                                $compra = consultas::get_datos("select * from v_presu_produ where id_sucursal =".$_SESSION['id_sucursal']." and "
                                        . "(cli_cod||clientes) ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:'')."%'order by presuprod_cod desc");
                                if (!empty($compra)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cliente</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                    <th>Sucursal</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($compra as $com ){ ?>
                                                <tr>
                                                    <td data-title="#"><?php echo $com ['presuprod_cod'];?> </td>
                                                    <td data-title="Cliente"><?php echo $com ['clientes'];?> </td>
                                                    <td data-title="Total"><?php echo number_format($com ['presu_total'],0,",",".");?> </td>
                                                    <td data-title="Fecha"><?php echo $com ['presu_fecha'];?> </td>
                                                      <td data-title="Sucursal"><?php echo $com ['suc_descri'];?> </td>
                                                    <td data-title="Estado"><?php echo $com ['presupro_estado'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                         <?php if($com['presupro_estado']=='PENDIENTE'){?>
                                                                    <a onclick="confirmar(<?php echo "'".$com['presuprod_cod']."_".$com['presu_fecha']."'"?>)" class="btn btn-success btn-sm" role="button" 
                                                                       data-title="Confirmar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#confirmar"><i class="fa fa-check"></i></a>                                                                    
                                                                       <a href="presuprodu_det.php?vpresuprod_cod=<?php echo $com['presuprod_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                    <?php ?>
                                                <?php //if ($com['presupro_estado']=="PENDIENTE"){ ?>
                                                          <!--<a href="presuprodu_det.php?vpresuprod_cod=//<?php// echo $com['presuprod_cod'];?>" class="btn btn-success btn-sm" role="button" data-title="Detalles"--> 
                                                                       <!--rel="tooltip" data-placement="top">-->
                                                                        <!--<span class="glyphicon glyphicon-list"></span></a>-->
                                                      <a href= "presuprodu_edit?vpresuprod_cod=<?php echo $com['presuprod_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                        <a onclick="anular(<?php echo "'".$com['presuprod_cod']."_".$com['clientes']."'"; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#anular">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                         <?php  }  ?>
                                                                       <a href="pedprodu_print?vpro_cod=<?php echo $com['presuprod_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Imprimir" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-print"></span>
                                                        </a>
                                                    </td>
                                                        
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
    
                               <?php  } else { ?>
                                <div class="alert alert-info flat">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    No se ha registrado presupuestos...
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
                  <div class = "modal fade" id = "anular" role = "dialog">
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
                  <! - FIN MODAL PARA BORRAR ->
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
      
        <script>
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
            </script>
            <script>
         function anular(datos){
                var dat = datos.split("_");
                $('#si').attr('href','presuprodu_control.php?vpresuprod_cod='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular el pedido N° <strong>'+dat[0]+'</strong> del proveedor <strong>'+dat[1]+'</strong>?');
            }
              function confirmar(datos){
                var dat = datos.split("_");
                $('#sic').attr('href','presuprodu_control.php?vpresuprod_cod='+dat[0]+'&accion=4');
                $('#confirmacionc').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea confirmarel presupuesto N° <strong>'+dat[0]+'</strong> de la fecha <strong>'+dat[1]+'</strong>?');
        }
        </script> 
            
    </body>
</html>

