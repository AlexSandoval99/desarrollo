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
                            <i class="ion ion-plus"></i>
                            <h3 class="box-title">Agregar Orden de Produccion</h3>
                            <div class="box-tools">
                                <a href="ordprodu_index.php" class="btn btn-primary btn-sm pull-right" data-title="Volver" rel="tooltip" 
                                           data-placement="top">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                               
                    </div>
                    </div>
                        <div class="box-body ">
                            <?php if (!empty($_SESSION['mensaje'])){ ?>
                        <div class="alert alert-danger" role="alert" id="mensaje">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <?php echo $_SESSION['mensaje'];
                            $_SESSION['mensaje']='';?>
                        </div>
                        <?php } ?> 
                           <!--buscador-->
                           <form action="ordprodu_control.php" method="POST" accept_charset="utf-8" class="from-horizontal">
                               <input type="hidden" name="accion" value="1">
                               <input type="hidden" name="vordpro_cod" value="0">
                               <div class="box-body">
                                   <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                     <?php $fecha= consultas::get_datos("select current_date as fecha"); ?>
                                    <label>Fecha:</label>
                                    <input type="date" name="vord_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha']; ?>" readonly="">
                            </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                     <label>Cliente:</label>
                                     <div class="input-group">
                                      <?php $cliente = consultas::get_datos("select * from clientes order by cli_cod");?>
                                                    <select class="form-control select2" name="vcli_cod" required="" id="proveedor" onchange="pedidos()" >
                                                        <?php if (!empty($cliente)) {  ?>
                                                        <option value="">Seleccione un Cliente</option>   
                                                        <?php foreach ($cliente as $cli) { ?>
                                                        <option value="<?php echo $cli['cli_cod']?>"><?php echo $cli['cli_nombre']." ".$cli['cli_apellido']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos un cliente</option>
                                                        <?php }?>
                                                    </select>
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#rregistrar" data-title="Agregar Proveedor" rel="tooltip">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                     </span>
                                </div>
                            </div>
                                        
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Empleado:</label>
                                    <input type="text" name="vemp_cod" class="form-control" required="" value="<?php echo $_SESSION['nombres']; ?>" readonly="">
                                       </div>
                                
                              
                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                     <label>Equi. Trabajo:</label>
                                     <div class="input-group">
                                      <?php $equipo = consultas::get_datos("select * from equip_trabaj order by equip_cod");?>
                                                    <select class="form-control select2" name="vequip_cod" required=""  >
                                                        <?php if (!empty($equipo)) {                                                         
                                                        foreach ($equipo as $equi) { ?>
                                                        <option value="<?php echo $equi['equip_cod']?>"><?php echo $equi['equip_nomb']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos un Equipo</option>
                                                        <?php }?>
                                                    </select>
                                    
                                </div>
                            </div>
                                     
                                        <div id="detalles_pedidos"></div>
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
         </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS--> 
                  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
      
        <script>
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
         function pedidos(){
                //alert($('#cliente').val())
                $.ajax({
                   type  : "GET",
                   url   : "/allcant.2.0/ordprodu.php?vcli_cod="+$('#proveedor').val(),
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
