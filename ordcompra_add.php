<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/taller/favicon.ico">
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
                            <i class="ion ion-plus"></i>
                            <h3 class="box-title">Agregar Orden de Compra</h3>
                            <div class="box-tools">
                                <a href="ordventas_index.php" class="btn btn-primary btn-sm pull-right" data-title="Volver" rel="tooltip" 
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
                           <form action="ordcompra_control.php" method="POST" accept_charset="utf-8" class="from-horizontal">
                               <input type="hidden" name="accion" value="1">
                               <input type="hidden" name="vord_com" value="0">
                               <div class="box-body">
                                   <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                     <?php $fecha= consultas::get_datos("select current_date as fecha"); ?>
                                    <label>Fecha:</label>
                                    <input type="date" name="vord_fecha" class="form-control" required="" value="<?php echo $fecha[0]['fecha']; ?>" readonly="">
                            </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                     <label>Proveedor:</label>
                                     <div class="input-group">
                                      <?php $proveedor = consultas::get_datos("select * from proveedor order by prv_cod");?>
                                                    <select class="form-control select2" name="vprv_cod" required=""  id="prove" onchange="ped()">
                                                        <?php if (!empty($proveedor)) {                                                         
                                                        foreach ($proveedor as $prov) { ?>
                                                        <option value="<?php echo $prov['prv_cod']?>"><?php echo $prov['prv_ruc']." ".$prov['prv_razonsocial']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos un proveedor</option>
                                                        <?php }?>
                                                    </select>
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#rregistrar" data-title="Agregar Proveedor" rel="tooltip">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                     </span>
                                </div>
                            </div>
                                   <div id="pedidos"></div>    
                        </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Empleado:</label>
                                    <input type="text" name="vempleado" class="form-control" required="" value="<?php echo $_SESSION['nombres']; ?>" readonly="">
                                       </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Sucursal:</label>
                                    <input type="text" name="vsucursal" class="form-control" required="" value="<?php echo $_SESSION['sucursal']; ?>" readonly="">
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
         </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS--> 
                  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
      
        <script>
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
            </script>
            <script>
                  function ped(){
                //alert($('#cliente').val())
                $.ajax({
                   type  : "GET",
                   url   : "/pedidos.php?vprv_cod="+$('#prove').val(),
                   cache : false,
                   beforeSend:function(){
                     $('#pedidos').html('<img src="img/ajax-loader.gif"/><strong> Cargando...</strong>');  
                   },
                   success:function(data){
                       $('#pedidos').html(data); 
                   }
                });
            }
        </script> 
    </body>
</html>
