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
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Ventas</h3>
                                    <div class="box-tools">
                                        <a href="ventas_index.php" class="btn btn-primary btn-sm" data-title = "Volver" 
                                           rel="tooltip" data-placement="top"> 
                                            <i class="fa fa-arrow-left"></i></a>                                        
                                    </div>
                                </div>
                                <!-- AQUI VA EL CONTENIDO DE LA TABLA-->
                                <div class="box-body">
                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje']=''; ?>
                                </div>
                                <?php }?>           
                                    <form action="ventas_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vven_cod" value="0">
                                        <div class="box-body">
                                            <div class="form-group has-feedback">
                                                <?php $fecha = consultas::get_datos("select to_char(current_date,'dd/mm/yyyy') as fecha_actual");?>
                                                <label class="control-label col-lg-2 col-md-2 col-xs-2">Fecha:</label>
                                                <div class="col-lg-4 col-md-4 col-xs-10">
                                                    <input type="text" class="form-control" name="vven_fecha" readonly="" value="<?php echo $fecha[0]['fecha_actual']?>">
                                                    <i class="fa fa-calendar form-control-feedback"></i>
                                                </div>
                                                <label class="control-label col-lg-2 col-md-2 col-xs-2">Condición</label>
                                                <div class="col-lg-4 col-md-4 col-xs-10">
                                                    <select class="form-control select2" name="vtipo_venta" required="" id="tipo_venta" onchange="tipoventa()">
                                                        <option value="CONTADO">CONTADO</option>
                                                        <option value="CREDITO">CREDITO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-2">Cliente</label>
                                                <div class="col-lg-6 col-md-6 col-xs-10">
                                                    <div class="input-group">
                                                        <?php $clientes = consultas::get_datos("select * from clientes order by cli_cod");?>
                                                        <select class="form-control select2" name="vcli_cod" required="" id="cliente" onchange="pedidos()">
                                                            <?php if (!empty($clientes)) {                                                         
                                                            foreach ($clientes as $cliente) { ?>
                                                            <option value="<?php echo $cliente['cli_cod']?>"><?php echo $cliente['cli_nombre']." ".$cliente['cli_apellido'];?></option>
                                                            <?php }                                                    
                                                            }else{ ?>
                                                            <option value="">Debe insertar al menos un cliente</option>
                                                            <?php }?>
                                                        </select> 
                                                       <span class="input-group-btn">
                                         <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#clientes" data-title="Agregar Cliente" rel="tooltip">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                     </span>
                                                    </div>                                                     
                                                </div>
                                                <div id="detalles_pedidos"></div>
                                            </div>
                                            <div class="form-group tipo" style="display: none;">
                                                <label class="control-label col-lg-2 col-md-2">Cant. Cuotas</label>
                                                <div class="col-lg-4 col-md-4">
                                                    <input type="number" class="form-control" name="vcan_cuota" id="cuotas" min="1" max="36" readonly="" value="1"/>
                                                </div>
                                                <label class="control-label col-lg-2 col-md-2">Intervalo:</label>
                                                <div class="col-lg-4 col-md-4">
                                                    <input type="number" class="form-control" name="vven_plazo" id="intervalo" min="0" max="90" readonly="" value="0"/>
                                                </div>                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-2">Empleado</label>
                                                <div class="col-lg-4 col-md-4">
                                                    <input type="text" class="form-control" name="vempleado" readonly="" value="<?php echo $_SESSION['nombres'];?>"/>
                                                </div>
                                                <label class="control-label col-lg-2 col-md-2">Sucursal:</label>
                                                <div class="col-lg-4 col-md-4">
                                                    <input type="text" class="form-control" name="vsucursal" readonly="" value="<?php echo $_SESSION['sucursal'];?>"/>
                                                </div>                                                
                                            </div>                                            
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fa fa-floppy-o"></i> Registrar
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                            <!-- MODAL PARA AGREGAR-->
                  <div class="modal fade" id="clientes" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title"><i class="fa fa-plus"></i> Registrar Cliente</h4>
                              </div>
                              <form action="ventas_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vcli_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2 col-sm-2">N° C.I</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vcli_ci" class="form-control" required="" autofocus=""/>
                                            
                                          </div>
                                          <label class="control-label col-lg-2 col-sm-2">Nombre </label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vcli_ci" class="form-control" required="" autofocus=""/>
                                            
                                          </div>
                                          <label class="control-label col-lg-2 col-sm-2">Apellido</label>
                                          <div class="col-lg-10 col-sm-10">
                                               <input type="text" name="vcli_apellido" class="form-control" required="" autofocus=""/>
                                          </div>
                                          <label class="control-label col-lg-2 col-sm-2">Telefono</label>
                                          <div class="col-lg-10 col-sm-10">
                                               <input type="text" name="vcli_telefono" class="form-control" required="" autofocus=""/>
                                          </div>
                                          <label class="control-label col-lg-2 col-sm-2">Direccion</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vcli_direcc" class="form-control" required="" autofocus=""/> 
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });
        </script>
        <script>
            function tipoventa(){
                //alert($('#tipo_venta').val())
                if($('#tipo_venta').val()==="CONTADO"){
                    $('.tipo').hide();
                    $('#cuotas').prop("readonly",false);
                    $('#cuotas').val(1);
                    $('#intervalo').prop("readonly",false);                    
                    $('#intervalo').val(0);
                }else{
                    $('.tipo').show();
                    $('#cuotas').prop("readonly",false);
                    $('#intervalo').prop("readonly",false);
                }
            };
            function pedidos(){
                //alert($('#cliente').val())
                $.ajax({
                   type  : "GET",
                   url   : "/taller/ventas_pedidos.php?vcli_cod="+$('#cliente').val(),
                   cache : false,
                   beforeSend:function(){
                     $('#detalles_pedidos').html('<img src="img/ajax-loader.gif"/><strong> Cargando...</strong>');  
                   },
                   success:function(data){
                       $('#detalles_pedidos').html(data); 
                   }
                });
            }
        </script>        
    </body>
</html>


