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
                                    <?php $compra = consultas::get_datos("select cont_producc_cod,fecha,clientes,empleado,estado_produccion  from v_cont_produccion where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']."group by cont_producc_cod,fecha,clientes,empleado,estado_produccion");?>
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
                                    <div class="ibox-content pb-0">
                        <form method="GET">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tabs-container">
                                            <ul class="nav nav-tabs fs-3">
                                                        <li class="active"><a data-toggle="tab" href="#seccion1" onclick="ChangeTab1();"><h5>Primera Etapa </h5></a></li>
                                                        <li class=""><a data-toggle="tab" href="#seccion2" onclick="ChangeTab2();"><h5>Segunda Etapa </h5></a></li>
                                                        <li class=""><a data-toggle="tab" href="#seccion3" onclick="ChangeTab3();"><h5>Tercera Etapa </h5></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="seccion1">
                                                    <div class="panel-body table-responsive" id="div_sec1">
                                                    <?php $compradet = consultas::get_datos("select cont_producc_cod,art_cod,art_descri,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa from v_detalle_cont_produc where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']. " and numero_etapa = 1 group by cont_producc_cod,art_cod,art_descri,etapa1,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa order by art_cod asc");?>
                                                    <div class="row">
                                                        </div>
                                                        <table class="table table-stripped" >
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Artiulo</th>
                                                                <th>Etapa</th>
                                                                <th>OBS:</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>

                                                        <tr>
                                                        <?php foreach ($compradet as $det) { ?>
                                                            <td data-title="#"><?php echo $det['cont_producc_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <td > <input  type="checkbox"<?php if ($det['etapa1']== 't') {?>checked <?php }else{ }?> disabled=""> <?php echo $det['det1']?></td>
                                                                <td data-title="OBS:"><?php echo $det['detall'];?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                                <a onclick="editar(<?php echo $det['cont_producc_cod']?>,<?php echo $det['art_cod']?>,<?php echo $det['etap_producc_cod']?>)" class="btn btn-success btn-sm"
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
                                                </div>
                                            </div> 
                                            <!-- fin tabs -->
                                        <!-- inicio tabs -->
                                        <div class="tab-content">
                                            <div class="tab-pane" id="seccion2">
                                                <div class="panel-body table-responsive" id="div_sec2">
                                                <?php $compras = consultas::get_datos("select cont_producc_cod,art_cod,art_descri,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa from v_detalle_cont_produc where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']. " and numero_etapa = 2 group by cont_producc_cod,art_cod,art_descri,etapa1,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa order by art_cod asc");?>
                                                    <div class="row">
                                                        </div>
                                                        <table class="table table-stripped" data-limit-navigation="8" data-sort="true" data-paging="true" data-filter=#filter1>
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Artiulo</th>
                                                                <th>Etapa</th>
                                                                <th>OBS:</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>

                                                        <tr>
                                                        <?php foreach ($compras as $det) { ?>
                                                            <td data-title="#"><?php echo $det['cont_producc_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <td > <input  type="checkbox"<?php if ($det['etapa1']== 't') {?>checked <?php }else{ }?> disabled=""> <?php echo $det['det1']?></td>
                                                                <td data-title="OBS:"><?php echo $det['detall'];?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                                <a onclick="editar(<?php echo $det['cont_producc_cod']?>,<?php echo $det['art_cod']?>,<?php echo $det['etap_producc_cod']?>)" class="btn btn-success btn-sm"
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
                                                </div>
                                            </div> 
                                        <!-- fin tabs -->
                                        <!-- inicio tabs -->
                                        <div class="tab-content">                                              
                                            <div class="tab-pane" id="seccion3">
                                                <div class="panel-body table-responsive" id="div_sec3">
                                                    <?php $compra3 = consultas::get_datos("select cont_producc_cod,art_cod,art_descri,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa from v_detalle_cont_produc where cont_producc_cod = ".$_REQUEST['vcont_producc_cod']. " and numero_etapa = 3 group by cont_producc_cod,art_cod,art_descri,etapa1,etapa1,etapa2,etapa3,det1,cant,etap_producc_cod,detall,etap_descri,residuo,numero_etapa order by art_cod asc");?>
                                                    <div class="row">
                                                        </div>
                                                        <table class="table table-stripped" data-limit-navigation="8" data-sort="true" data-paging="true" data-filter=#filter1>
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Articulos</th>
                                                                <th>Etapa</th>
                                                                <th>OBS:</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>

                                                        <tr>
                                                        <?php foreach ($compra3 as $det) { ?>
                                                            <td data-title="#"><?php echo $det['cont_producc_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <td > <input  type="checkbox"<?php if ($det['etapa1']== 't') {?>checked <?php }else{ }?> disabled=""> <?php echo $det['det1']?></td>
                                                                <td data-title="OBS:"><?php echo $det['detall'];?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                                <a onclick="editar(<?php echo $det['cont_producc_cod']?>,<?php echo $det['art_cod']?>,<?php echo $det['etap_producc_cod']?>)" class="btn btn-success btn-sm"
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
                                                </div>
                                            </div>         
                                        <!-- fin tabs -->
                                        </div>
                                    </div>
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
              function etap(){
            var valor = $('#etapa').val().split('_');
          
        } 
        function borrar(datos){
            var dat = datos.split('_');
                $('#si').attr('href','ordcompras_dcontrol.php?vord_com='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea quitar el articulo <strong>'+dat[3]+'</strong> del orden N° <strong>'+dat[0]+'</strong>?');
        }
        
         function editar(ped,art,eta){
            $.ajax({
                type    : "GET",
                url     : "/allcant.2.0/contprodu_dedit.php?vcont_producc_cod="+ped+"&vart_cod="+art+"&vetap_producc_cod="+eta,
                cache   : false,
                beforeSend:function(){
                    $("#detalles").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            })
        }
        function ChangeTab1()
        {
                $('#div_sec1').show();
                $('#div_sec3').hide();
                $('#div_sec2').hide();
                
        }
        function ChangeTab2()
        {
                $('#div_sec2').show();
                $('#div_sec1').hide();
                $('#div_sec3').hide();
                
        }
        
        function ChangeTab3()
        {
                $('#div_sec3').show();
                $('#div_sec1').hide();
                $('#div_sec2').hide();
                
        }
        </script>
        
    </body>
    
</html>


