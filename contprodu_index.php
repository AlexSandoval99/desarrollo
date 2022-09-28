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
                        <h3 class="box-title">Control de Produccion</h3>
                        <div class="box-tools">
                            <a href="contprodu_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" data-placement="top">
                                <i class="fa fa-plus"></i></a>
                        </div>
                        </div>
                        <div class="box-body no-padding">
                        <?php if (!empty($_SESSION['mensaje'])){ ?>
                        <div class="alert alert-danger" role="alert" id="mensaje">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <?php echo $_SESSION['mensaje'];
                            $_SESSION['mensaje']='';?>
                        <?php } ?> 
                        </div>
                           <!--buscador-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <form action="contprodu_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                $compra = consultas::get_datos("select * from v_cont_produccion where id_sucursal =".$_SESSION['id_sucursal']." and "
                                        . "(empleado) ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:'')."%'order by cont_producc_cod desc");
                                if (!empty($compra)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Cliente</th>
                                                    <th>Sucursal</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($compra as $com ){ ?>
                                                <tr>
                                                    <td data-title="#"><?php echo $com ['cont_producc_cod'];?> </td>
                                                    <td data-title="Fecha"><?php echo $com ['fecha'];?> </td>
                                                    <td data-title="Cliente"><?php echo $com ['clientes'];?> </td>
                                                    <td data-title="Sucursal"><?php echo $com ['suc_descri'];?> </td>
                                                    <td data-title="Estado"><?php echo $com ['estado_produccion'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                <?php if ($com['estado_produccion']=="PENDIENTE"){ ?>
                                                          <a href="contprodu_det.php?vcont_producc_cod=<?php echo $com['cont_producc_cod'];?>" class="btn btn-success btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                      <a href= "contprodu_edit?vcont_producc_cod=<?php echo $com['cont_producc_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                        <a onclick="anular(<?php echo "'".$com['cont_producc_cod']."_".$com['empleado']."'"; ?>)" class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#anular">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                         <?php  }  ?>
                                                        <a href="contprodu_print.php?vcont_producc_cod=<?php echo $com['cont_producc_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Imprimir" rel="tooltip" data-placement="top">
                                                            <span class="glyphicon glyphicon-print"></span>
                                                        </a>
                                                        
                                                        <?php $compras = consultas::get_datos("select cont_producc_cod,residuo,cant,etapa1 from v_cont_produccion1 where cont_producc_cod =".$com['cont_producc_cod']."and residuo < cant group by cont_producc_cod,residuo,cant,etapa1 limit 1");
                                                         if($compras > 0)
                                                         {
                                                            foreach ($compras as $comp ){ ?>
                                                                <?php if ($comp['residuo'] < $comp['cant'] && $comp['etapa1'] == 't' )  {?>
                                                                <a onclick="OP(<?php echo "'".$comp['cont_producc_cod']."'"?>)" class="btn btn-primary btn-sm" data-title="Generar OP" rel="tooltip" 
                                                                    data-toggle="modal" data-target="#OP">
                                                                <i class="fa fa-edit"></i></a>  
                                                                <?php }?>
                                                    <?php }?>
                                                         
                                                        <?php }?>
                                                    </td>
                                                        
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
    
                               <?php  } else { ?>
                                <div class="alert alert-info flat">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    No se ha registrado pedidos de compras...
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
                  <div class="modal fade" id="OP" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-danger" id="ok"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="yes" role='buttom' class="btn btn-primary">
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
                $('#si').attr('href','contprodu_control.php?vcont_producc_cod='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular el pedido N° <strong>'+dat[0]+'</strong> del proveedor <strong>'+dat[1]+'</strong>?');
            }
            function OP(datos){
            var dat = datos.split('_');
                $('#yes').attr('href','ordprodu_add.php?vord_com='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
                $('#ok').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea generar una orden de Produccion?');
        }
        </script> 
            
    </body>
</html>

