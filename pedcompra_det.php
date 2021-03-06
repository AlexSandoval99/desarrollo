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
                                    <i class="fa fa-plus"></i> <h3 class="box-title">Agregar Detalle Pedido</h3>
                                    <div class="box-tools">
                                        <a href="pedcompra_index.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i></a>
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
                                    <?php $compra = consultas::get_datos("select * from v_pedido_cabcompra where ped_com = ".$_REQUEST['vped_com']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                            <th>Proveedor</th>
                                                            <th>Total</th>
                                                            <th>Estado</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compra as $com) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $com['ped_com'];?></td>
                                                            <td data-title="Fecha"><?php echo $com['ped_fecha'];?></td>
                                                            <td data-title="Proveedor"><?php echo $com['proveedor'];?></td>
                                                            <td data-title="Total"><?php echo $com['ped_total'];?></td>
                                                            <td data-title="Estado"><?php echo $com['ped_estado'];?></td>
                                                        </tr>
                                                             
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TABLA DETALLE PEDIDOS-->
                                    <?php $compradet = consultas::get_datos("select * from v_detalle_pedcompra where ped_com = ".$_REQUEST['vped_com']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <?php if (!empty($compradet)) {?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i><h3 class="box-title">Detalle Pedido Items</h3>                                        
                                            </div>                                            
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripci??n</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Impuesto</th>
                                                            <th>Subtotal</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compradet as $det) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['ped_com'];?></td>
                                                            <td data-title="Descripci??n"><?php echo $det['art_descri']." ".$det['mar_descri'];?></td>
                                                            <td data-title="Cantidad"><?php echo $det['ped_cant'];?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['ped_precio'],0,",",".");?></td>
                                                            <td data-title="Impuesto"><?php echo $det['tipo_descri'];?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['subtotal'],0,",",".");?></td>
                                                            <td data-title="Acciones">
                                                                <a onclick="editar(<?php echo $det['ped_com']?>,<?php echo $det['art_cod']?>,<?php echo $det['dep_cod']?>)" class="btn btn-warning btn-sm" 
                                                                   data-title="Editar" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                    <i class="fa fa-edit"></i></a>
                                                                    <a onclick="borrar(<?php echo "'".$det['ped_com']."_".$det['art_cod']."_".$det['dep_cod']."_".$det['art_descri']."'"?>)" class="btn btn-danger btn-sm" data-title="Borrar" rel="tooltip" 
                                                                       data-toggle="modal" data-target="#borrar">
                                                                    <i class="fa fa-trash"></i></a>                                                                    
                                                            </td>
                                                        </tr>
                                                             
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                El pedido a??n no posee detalles...
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div> 
                                    <!-- FIN TABLA DETALLE PEDIDOS-->
                                    <!-- FORMULARIO PARA AGREGAR-->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="pedcompra_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="accion" value="1">
                                                    <input type="hidden" name="vped_com" value="<?php echo $compra[0]['ped_com'];?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Deposito:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php $depositos = consultas::get_datos("select * from deposito where id_sucursal =".$_SESSION['id_sucursal']);?>
                                                                <select class="form-control select2" name="vdep_cod" required="">
                                                                    <?php if (!empty($depositos)) {                                                         
                                                                    foreach ($depositos as $deposito) { ?>
                                                                    <option value="<?php echo $deposito['dep_cod']?>"><?php echo $deposito['dep_descri']?></option>
                                                                    <?php }                                                    
                                                                    }else{ ?>
                                                                    <option value="">Debe insertar al menos un deposito</option>
                                                                    <?php }?>
                                                                </select> 
                                                        </div>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulos:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php $articulos = consultas::get_datos("select * from v_articulo order by art_descri");?>
                                                            <select class="form-control select2" name="vart_cod" required="" id="articulo" onchange="precio()">
                                                                    <?php if (!empty($articulos)) {                                                         
                                                                    foreach ($articulos as $articulo) { ?>
                                                                    <option value="<?php echo $articulo['art_cod']."_".$articulo['art_precioc']?>"><?php echo $articulo['art_descri']." ".$articulo['mar_descri']?></option>
                                                                    <?php }                                                    
                                                                    }else{ ?>
                                                                    <option value="">Debe insertar al menos un articulo</option>
                                                                    <?php }?>
                                                                </select> 
                                                        </div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <input type="number" class="form-control" name="vped_cant" min="1" value="1"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Precio:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vped_precio" min="1" value="1" id="cprecio"/>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-plus"></i> Agregar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
                                      <h4 class="modal-title custom_align" id="Heading">Atenci??n!!!</h4>
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
            $('#cprecio').val(valor[1]);
        }    
            
        function borrar(datos){
            var dat = datos.split('_');
                $('#si').attr('href','pedcompra_dcontrol.php?vped_com='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea quitar el articulo <strong>'+dat[3]+'</strong> del pedido N?? <strong>'+dat[0]+'</strong>?');
        }
        function editar(ped,art,dep){
            $.ajax({
                type    : "GET",
                url     : "/taller/pedcompra_dedit.php?vped_com="+ped+"&vart_cod="+art+"&vdep_cod="+dep,
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


