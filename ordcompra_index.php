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
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Orden de Compra</h3>
                            <div class="box-tools">
                                <a href="ordcompra_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" 
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
                                    <form action="ordcompra_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                $compra = consultas::get_datos("select * from v_orden_cabcompra where id_sucursal =".$_SESSION['id_sucursal']." and "
                                        . "(ord_com||proveedor) ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:'')."%'order by ord_com desc");
                                if (!empty($compra)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Proveedor</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($compra as $com ){ ?>
                                                <tr>
                                                    <td data-title="#"><?php echo $com ['ord_com'];?> </td>
                                                    <td data-title="Fecha"><?php echo $com ['ord_fecha'];?> </td>
                                                    <td data-title="Proveedor"><?php echo $com ['proveedor'];?> </td>
                                                    <td data-title="Total"><?php echo number_format($com ['ord_total'],0,",",".");?> </td>
                                                    <td data-title="Estado"><?php echo $com ['ord_estado'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                <?php if ($com['ord_estado']=="PENDIENTE"){ ?>
                                                          <a href="ordcompra_det.php?vord_com=<?php echo $com['ord_com'];?>" class="btn btn-success btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                      <a href= "ordcompra_edit?vord_com=<?php echo $com['ord_com'];?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                        <a onclick="anular(<?php echo "'".$com['ord_com']."_".$com['proveedor']."'"; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#anular">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                         <?php  }  ?>
                                                        <a href="ordcompra_print.php?vord_com=<?php echo $com['ord_com'];?>" class="btn btn-primary btn-sm" role="button" data-title="Imprimir" rel="tooltip" data-placement="top">
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
                                    No se ha registrado Ordenes de compras...
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
                $('#si').attr('href','ordcompra_control.php?vord_com='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular el Orden N° <strong>'+dat[0]+'</strong> del proveedor <strong>'+dat[1]+'</strong>?');
            }
        </script> 
            
    </body>
</html>

