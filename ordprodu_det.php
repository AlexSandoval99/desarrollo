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
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-plus"></i> <h3 class="box-title">Agregar Detalle A La Orden</h3>
                                    <div class="box-tools">
                                        <a href="ordprodu_index.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <div class="box-body">
                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje']=''; ?>
                                </div>
                                <?php }?>                                    
                                    <?php $compra = consultas::get_datos("select * from v_ord_pro where ordpro_cod = ".$_REQUEST['vordpro_cod']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                            <th>Cliente</th>
                                                            <th>Sucursal</th>
                                                            <th>Estado</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compra as $com) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $com['ordpro_cod'];?></td>
                                                            <td data-title="Fecha"><?php echo $com['orden_fecha'];?></td>
                                                            <td data-title="Cliente"><?php echo $com['clientes'];?></td>
                                                            <td data-title="Sucursal"><?php echo $com['suc_descri'];?></td>
                                                            <td data-title="Estado"><?php echo $com['orden_estad'];?></td>
                                                        </tr>
                                                             
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TABLA DETALLE PEDIDOS-->
                                    <?php $compradet = consultas::get_datos("select * from v_det_orden where ordpro_cod = ".$_REQUEST['vordpro_cod']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <?php if (!empty($compradet)) {?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i><h3 class="box-title">Detalle Presupuesto Items</h3>                                        
                                            </div>                                            
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Articulo</th>
                                                            <th>Cantidad de Articulo</th>
                                                            <th >Acciones</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compradet as $det) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['ordpro_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri']." ".$det['mar_descri'];?></td>
                                                            <td data-title="Cantidad de Articulo"><?php echo $det['ord_cant'];?></td>
                                                            <td data-title="Acciones">
<!--                                                                <a onclick="editar(<?php //echo $det['ordpro_cod']?>,<?php echo $det['art_cod']?>)" class="btn btn-success btn-sm" 
                                                                   data-title="Detalle" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                    <i class="glyphicon glyphicon-list"></i></a>-->
                                                                    <a onclick="borrar(<?php echo "'".$det['ordpro_cod']."_".$det['art_descri']." ".$det['mar_descri']."'"?>)" class="btn btn-danger btn-sm" data-title="Borrar" rel="tooltip" 
                                                                       data-toggle="modal" data-target="#borrar" data-backdrop="false"  data-dismiss="modal">
                                                                    <i class="fa fa-trash"></i></a>                                                                    
                                                            </td>
                                                            
                                                        </tr>
                                                             
                                                        <?php }?>
                                                        <a onclick="editar(<?php echo $det['ordpro_cod']?>,<?php echo $det['art_cod']?>)" class="btn btn-success btn-sm" 
                                                                   data-title="Detalle" rel="tooltip" data-toggle="modal" data-target="#editar">AGREGAR MATERIA PRIMA
                                                                    <i class="glyphicon glyphicon-list"></i> </a> 
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                El pedido aún no posee detalles...
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div> 
                                    <!-- FIN TABLA DETALLE PEDIDOS-->
                                    <!-- FORMULARIO PARA AGREGAR-->
                                 
                                    <!-- FIN FORMULARIO PARA AGREGAR-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                  <!-- MODAL PARA BORRAR-->
                  <div class="modal fade" id="borrar" role="dialog">
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
                  <!-- FIN MODAL PARA EDITAR-->  
                  <div class="modal fade" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                              
                          </div>
                      </div>                      
                  </div>                  
                  <!-- FIN MODAL PARA EDITAR-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });
            
        </script>        
        <script>
        precio();    
        function precio(){
            var valor = $('#articulo').val().split('_');
            $('#vprecio').val(valor[1]);
        }    
            
        function borrar(datos){
            var dat = datos.split('_');
                $('#si').attr('href','ordprodu_dcontrol.php?vordpro_cod='+dat[0]+'&vart_cod='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea quitar el articulus <strong>'+dat[1]+'</strong> del orden N° <strong>'+dat[0]+'</strong>?');
    
        }
        
        function editar(ped,art){
            $.ajax({
                type    : "GET",
                url     : "/allcant.2.0/ordprodu_dedit.php?vordpro_cod="+ped+"&vart_cod="+art,
                cache   : false,
                beforeSend:function(){
                    $("#detalles").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            })
        };
        </script>
    </body>
</html>


