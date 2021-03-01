<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
        <title>Taller</title>
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
                            <h3 class="box-title">Transferencia de Mercadderia</h3>
                            <div class="box-tools">
                                <a href="transferencia_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" 
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
                                    <form action="transferencia_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                $nuevo = consultas::get_datos("select * from v_trans_cabecera where orig_trans =".$_SESSION['id_sucursal']." or dest_trans =".$_SESSION['id_sucursal']." and trans_estado in ('CONFIRMADO','EN TRANSITO','ANULADO') and (suc_orig||suc_dest||trans_cod) ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:'')."%'order by trans_cod desc");
                                if (!empty($nuevo)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Origen</th>
                                                    <th>Destino</th>
                                                    
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($nuevo as $nue ){ ?>
                                                <tr>
                                                    <td data-title="#"><?php echo $nue ['trans_cod'];?> </td>
                                                    <td data-title="Fecha"><?php echo $nue ['trans_fecha'];?> </td>
                                                <td data-title="Origen"> <?php echo $nue['suc_orig'];?>  </td>
                                                    <td data-title="Destino"><?php echo $nue['suc_dest'];?> </td>
                                                    <td data-title="Estado"><?php echo $nue ['trans_estado'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                 <?php if($nue['trans_estado']=='EN TRANSITO' && $nue['dest_trans']== $_SESSION['id_sucursal']){?>
                                                                    <a onclick="confirmar(<?php echo "'".$nue['trans_cod']."_".$nue['trans_fecha']."'"?>)" class="btn btn-success btn-sm" role="button" 
                                                                       data-title="Confirmar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#confirmar"><i class="fa fa-check"></i></a>                                                                    
                                                                    <a href="transferencia_det.php?vtrans_cod=<?php echo $nue['trans_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                    <?php }?>
                                                         <?php if($nue['trans_estado']=='PENDIENTE'&& $nue['orig_trans']== $_SESSION['id_sucursal']){?>
                                                                    <a onclick="enviar(<?php echo "'".$nue['trans_cod']."_".$nue['trans_fecha']."'"?>)" class="btn btn-primary btn-sm" role="button" 
                                                                       data-title="Enviar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#confirmar"><i class="fa fa-paper-plane"></i></a>                                                                    
                                                                    <a href="/transferencia_det.php?vtrans_cod=<?php echo $nue['trans_cod'];?>" class="btn btn-primary btn-sm" role="button" data-title="Detalles" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-list"></span></a>
                                                                    <?php }
                                                                    if($nue['trans_cod'] ){ ?>
                                                                    <a onclick="anula(<?php echo "'".$nue['trans_cod']."_".$nue['trans_fecha']."'"?>)"  class="btn btn-danger btn-sm" role="button" data-title="Anula" 
                                                                       rel="tooltip" data-placement="top" data-toggle="modal" data-target="#anula"> <span class="glyphicon glyphicon-remove"></span></a>  
                                                                    <?php }?>
                                                                    <a href="transferencia_print.php?vtrans_cod=<?php echo $nue['trans_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Imprimir" 
                                                                       rel="tooltip" data-placement="top" target="print">
                                                                        <span class="glyphicon glyphicon-print"></span></a>  
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
                  <div class = "modal fade" id = "anula" role = "dialog">
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
      
        <script>
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
            </script>
            <script>
         function anula(datos){
                var dat = datos.split("_");
                $('#si').attr('href','transferencia_control.php?vtrans_cod='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea anular la transferencia N° <strong>'+dat[0]+'</strong> del la fecha <strong>'+dat[1]+'</strong>?');
            }
            function confirmar(datos){
                var dat = datos.split("_");
                $('#sic').attr('href','transferencia_control.php?vtrans_cod='+dat[0]+'&accion=4');
                $('#confirmacionc').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea confirmar la transferencia N° <strong>'+dat[0]+'</strong> de la fecha <strong>'+dat[1]+'</strong>?');
        }
         function enviar(datos){
                var dat = datos.split("_");
                $('#sic').attr('href','transferencia_control.php?vtrans_cod='+dat[0]+'&accion=5');
                $('#confirmacionc').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea enviar la transferencia N° <strong>'+dat[0]+'</strong> de la fecha <strong>'+dat[1]+'</strong>?');
        }
        </script> 
            
    </body>
</html>

