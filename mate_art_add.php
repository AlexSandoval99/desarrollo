<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>ALL'Cort</title>
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
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Materias a Articulos</h3>
                                    <div class="box-tools">
                                        <a href="mate_art_index.php" class="btn btn-primary btn-sm pull-right" data-title="Volver" rel="tooltip" 
                                           data-placement="top">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="mate_art_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vart_cod" value="0">
                                        
                                        <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulos:</label>
                                                        <a href="menu/header_lte.ctp"></a>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php $articulos = consultas::get_datos("select * from v_articulo order by art_descri");?>
                                                            <select class="form-control select2" name="vart_cod" required="" id="articulo">
                                                                    <?php if (!empty($articulos)) {                                                         
                                                                    foreach ($articulos as $articulo) { ?>
                                                                    <option value="<?php echo $articulo['art_cod']?>"><?php echo $articulo['art_descri']." ".$articulo['mar_descri']?></option>
                                                                    <?php }                                                    
                                                                    }else{ ?>
                                                                    <option value="">Debe insertar al menos un articulo</option>
                                                                    <?php }?>
                                                                </select> 
                                                        </div>
                                                    </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Materia Prima:</label>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="input-group">
                                                    <?php $marcas = consultas::get_datos("select * from mater_prim order by mater_cod");?>
                                                    <select class="form-control select2" name="vmar_cod" required="">
                                                        <?php if (!empty($marcas)) {                                                         
                                                        foreach ($marcas as $marca) { ?>
                                                        <option value="<?php echo $marca['mater_cod']?>"><?php echo $marca['mater_descri']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos una marca</option>
                                                        <?php }?>
                                                    </select> 
                                                  
                                                </div>
                                            </div>
                                        </div>
                  
                                                                          
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary pull-right"> 
                                                <i class="fa fa-floppy-o"></i>
                                                Registrar</button>
                                        </div>
                                    </div>                                      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                  <!-- MODAL PARA AGREGAR-->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title"><i class="fa fa-plus"></i> Registrar Marca</h4>
                              </div>
                              <form action="mate_art_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vmar_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2 col-sm-2">Descripción</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vart_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
                                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Registrar</button>
                                  </div>
                              </form>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA AGREGAR--> 
<!--                   MODAL PARA AGREGAR impuesto
                  <div class="modal fade" id="impuesto" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title"><i class="fa fa-plus"></i> Registrar Impuesto</h4>
                              </div>
                              <form action="articulo_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="5">
                                  <input type="hidden" name="vtipo_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2 col-sm-2">Descripción</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vart_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                           <label class="control-label col-lg-2 col-sm-2">Porcentaje</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vtipo_porcen" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
                                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Registrar</button>
                                  </div>
                              </form>
                          </div>
                      </div>                      
                  </div>
                   FIN MODAL PARA AGREGAR -->
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


