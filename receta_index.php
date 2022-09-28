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
                            <h3 class="box-title">Configurar Recetas</h3>
                            <div class="box-tools">
                                <a class="btn btn-primary btn-sm" data-title = "Agregar" rel="tooltip" 
                                           data-placement="top" data-toggle="modal" data-target="#registrar"> 
                                            <i class="fa fa-plus"></i></a>
                                <a href="receta_print.php" class="btn btn-primary pull-right btn-sm" data-title="Imprimir" rel="tooltip">
                                <i class="fa fa-print"></i></a>
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
                                    <form action="materia_index.php" method="POST" accept-charset="utf-8" class="form-horizontal">
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
                                $receta = consultas::get_datos("select * from v_receta where (rec_cod || art_descri) ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:'')."%'order by rec_cod");
                                if (!empty($receta)){ ?>
                                    <div class="table-responsive">
                                        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Articulo</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($receta as $rec ){ ?>
                                                <tr>
                                                    <td data-title="Codigo"><?php echo $rec ['rec_cod'];?> </td>
                                                    <td data-title="Articulo"><?php echo $rec ['art_descri'];?> </td>
                                                    <td data-title="Estado"><?php echo $rec ['rec_estad'];?> </td>
                                                    <td data-title="Acciones" class="text-center">
                                                    <a href="receta_det.php?vrec_cod=<?php echo $rec['rec_cod'];?>" class="btn btn-warning btn-sm" role="button" data-title="Materias" 
                                                                       rel="tooltip" data-placement="top">
                                                                        <span class="fa fa-briefcase"></span></a>
                                                    <a href="confetapa_det.php?vrec_cod=<?php echo $rec['rec_cod'];?>" class="btn btn-info btn-sm" role="button" data-title="Etapas" 
                                                                       rel="tooltip" data-placement="top"><span class="fa fa-reorder"></span></a>
                                                    <a href="confcali_det.php?vrec_cod=<?php echo $rec['rec_cod'];?>" class="btn btn-success btn-sm" role="button" data-title="Calidad" 
                                                                       rel="tooltip" data-placement="top"><span class="fa fa-cc"></span></a>
                                                    <a onclick="borrar(<?php echo "'".$rec['rec_cod']."_".$rec['art_cod']."_".$rec['art_descri']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                    </td>
                                                        
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
    
                               <?php  } else { ?>
                                <div class="alert alert-info flat">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    No se ha registrado Configuracion...
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
                  <! - MODAL PARA AGREGAR ->
                  <div class = "modal fade" id = "registrar" role = "dialog">
                      <div class = "modal-dialog">
                          <div class = "modal-content">
                              <div class = "modal-header">
                                  <button class = "close" data-dispats = "modal" aria-label = "Cerrar">
                                      <i class = "fa fa-remove"> </i> </button>
                                      <h4 class = "modal-title"> <i class = "fa fa-plus"> </i> Registrador Configuracion </h4>
                              </div>
                              <form action = "receta_control.php" method = "POST" accept-charset = "utf-8" class = "form-horizontal">
                                  <input type = "hidden" name = "accion" value = "1">
                                  <input type = "hidden" name = "vrec_cod" value = "0">
                                  <div class = "modal-body">
                                  <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulos:</label>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <?php $articulos = consultas::get_datos("select * from articulo where tip_art_cod = 1");?>
                                                    <select class="form-control select2" name="vart_cod" required="" id="articulo" >
                                                            <?php if (!empty($articulos)) {                                                         
                                                            foreach ($articulos as $articulo) { ?>
                                                            <option value="<?php echo $articulo['art_cod']?>"><?php echo $articulo['art_descri']?></option>
                                                            <?php }                                                    
                                                            }else{ ?>
                                                            <option value="">Debe insertar al menos un articulo</option>
                                                            <?php }?>
                                                    </select> 
                                                </div>
                                            </div> 
                                  </div>
                                  <div class = "modal-footer">
                                      <button type = "reset" data-dispats = "modal" class = "btn btn-default pull-left"> <i class = "fa fa-remove"> </i> Cerrar </button>
                                      <button type = "submit" class = "btn btn-primary pull-right"> <i class = "fa fa-floppy-o"> </i> Registrador </button>
                                  </div>
                              </form>
                          </div>
                      </div>                      
                  </div>
                  <! - FIN MODAL PARA AGREGAR ->
                  <! - MODAL PARA EDITAR ->
                 <div class="modal fade" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Materia Prima</h4>
                              </div>
                              <form action="materia_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="2">
                                  <input type="hidden" name="vrec_cod" id="cod">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2 col-sm-2">Descripción</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vrec_descri" class="form-control" required="" autofocus="" id="descri"/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
                                      <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Actualizar</button>
                                  </div>
                              </form>
                          </div>
                      </div>                      
                  </div>
                  <! - FIN MODAL PARA EDITAR ->  
                  <! - MODAL PARA BORRAR ->
                  <div class = "modal fade" id = "borrar" role = "dialog">
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
            $ ('. modal'). on ('shown.bs.modal', function () {
               $ (this) .find ('input: text: visible: first'). focus (); 
            });
        </script>    
        <script>
           function editar(datos){
                var dat = datos.split("_");
              $('#cod').val(dat[0]);
                $('#descri').val(dat[1]);
            };
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','receta_control.php?vrec_cod='+dat[0]+'&vart_cod='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar la materia <i><strong>'+dat[2]+'</strong></i>?');
            }
        </script> 
    </body>
</html>
