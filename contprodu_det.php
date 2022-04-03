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
                                    <i class="fa fa-plus"></i> <h3 class="box-title">Agregar Detalle Al Control de Produccion</h3>
                                    <div class="box-tools">
                                        <a href="contprodu_index.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i></a>
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
                                    <?php $compra = consultas::get_datos("select * from v_cont_produccion where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                             <th>Cliente</th>
                                                            <th>Estado</th>
                                                            <th>Empleado</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compra as $com) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $com['cont_producc_cod'];?></td>
                                                            <td data-title="Fecha"><?php echo $com['fecha'];?></td>
                                                            <td data-title="Clientes"><?php echo $com['clientes'];?></td>
                                                            <td data-title="Estado"><?php echo $com['estado_produccion'];?></td>
                                                            <td data-title="Empleado"><?php echo $com['empleado'];?></td>
                                                        </tr>
                                                             
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TABLA DETALLE PEDIDOS-->
                                    
                                    <?php $compradet = consultas::get_datos("select * from v_detalle_cont_produc where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']);?>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <?php if (!empty($compradet)) {?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i><h3 class="box-title">Detalle Control Produccion</h3>                                        
                                            </div>                                            
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                     <?php foreach ($compradet as $det) { ?>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Artiulo</th>
                                                              <?php if ($det['etapa1'] == 't' or $det['etapa2'] == 't' or $det['etapa3']== 't' ) {?>
                                                            <th>Etapa 1</th>
                                                            <th>Etapa 2</th>
                                                            <th>Etapa 3</th>
                                                            <th>OBS:</th>
                                                            <?php }else if (!empty($det['detall'])) { ?>
                                                            <th>OBS:</th> <?php }else{ } ?>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                      
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['cont_producc_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <?php if ($det['etapa1'] == 't' or $det['etapa2'] == 't' or $det['etapa3']== 't' ) {?>
                                                            <td > <input  type="checkbox"<?php if ($det['etapa1']== 't') {?>checked <?php }else{ }?> disabled=""> <?php echo $det['det1']?></td>
                                                        <td> <input type="checkbox" <?php if ($det['etapa2']== 't') {?>checked <?php }else{ }?>disabled=""><?php echo $det['det2']?></td>
                                                        <td> <input type="checkbox" <?php if ($det['etapa3']== 't') {?>checked <?php }else{ }?>disabled="" >  <?php echo $det['det3']?></td>
                                                        <td data-title="OBS:"><?php echo $det['detall'];?></td>
                                                     <?php  } else if (!empty($det['detall'])) {?>
                                                        <td data-title="OBS:"><?php echo $det['detall'];?></td>
                                                        <?php }else { }?>
                                                            <td data-title="Acciones" class="text-center">
                                                                <a onclick="editar(<?php echo $det['cont_producc_cod']?>,<?php echo $det['art_cod']?>)" class="btn btn-success btn-sm" 
                                                                   data-title="Detalle" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                    <i class="glyphicon glyphicon-list"></i> </a>
                                                               
                                                                    <a onclick="borrar(<?php echo "'".$det['cont_producc_cod']."_".$det['art_cod'].$det['art_descri']."'"?>)" class="btn btn-danger btn-sm" data-title="Borrar" rel="tooltip" 
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
                                                El pedido aún no posee detalles...
                                            </div>
                                            <?php } ?>
<!--                                            <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <form action="contprodu_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="accion" value="1">
                                                    <input type="hidden" name="vcont_producc_cod" value="<?php// echo $compra[0]['cont_producc_cod'];?>"> 
                                                            
                                                    </div>
                                                    <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-plus"></i> Agregar
                                                    </button>
                                                </div>
                                                     </form>
                                                         </div>
                                                    </div>-->
                                            
                                        </div>
                                    </div> 
                                    <!-- FIN TABLA DETALLE PEDIDOS-->
                                    <!-- FORMULARIO PARA AGREGAR-->
<!--                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="contprodu_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="accion" value="1">
                                                    <input type="hidden" name="vcont_producc_cod" value="<?php// echo $compra[0]['cont_producc_cod'];?>"> 
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulos:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php// $articulos = consultas::get_datos("select * from v_articulo order by art_descri");?>
                                                            <select class="form-control select2" name="vart_cod" required="" id="articulo" onchange="precio()">
                                                                    <?php// if (!empty($articulos)) {                                                         
                                                                   // foreach// ($articulos as $articulo) { ?>
                                                                    <option value="<?php// echo $articulo['art_cod']."_".$articulo['art_preciov']?>"><?php //echo $articulo['art_descri']." ".$articulo['mar_descri']?></option>
                                                                    <?php// }                                                    
                                                                    //}else//{ ?>
                                                                    <option value="">Debe insertar al menos un articulo</option>
                                                                    <?php// }?>
                                                                </select> 
                                                        </div>
                                                    </div> 
                                                     <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Etapa 1:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php// $articulos = consultas::get_datos("select * from etapas_producc where tip_art_cod =".$det['tip_art_cod']);?>
                                                            <select class="form-control select2" name="vetap_pruducc_cod" required="" id="etapa" onchange="etap()">
                                                                    <?php// if (!empty($articulos)) {                                                         
                                                                    //foreach ($articulos as $articulo) { ?>
                                                                    <option value="<?php//echo $articulo['etap_pruducc_cod']?>"><?php// echo $articulo['etap_descri']?></option>
                                                                    <?php// }                                                    
                                                                    //}else{ ?>
                                                                    <option value="">Debe insertar al menos un articulo</option>
                                                                    <?php// }?>
                                                                </select> 
                                                        </div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Precio:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vord_precio" min="1" value="1" id="vprecio"/>
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
                                   </div>-->
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
              function etap(){
            var valor = $('#etapa').val().split('_');
          
        } 
        function borrar(datos){
            var dat = datos.split('_');
                $('#si').attr('href','ordcompras_dcontrol.php?vord_com='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea quitar el articulo <strong>'+dat[3]+'</strong> del orden N° <strong>'+dat[0]+'</strong>?');
        }
         function editar(ped,art){
            $.ajax({
                type    : "GET",
                url     : "/allcant.2.0/contprodu_dedit.php?vcont_producc_cod="+ped+"&vart_cod="+art,
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


