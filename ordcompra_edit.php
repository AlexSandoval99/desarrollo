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
                        
                        
                        <div class="box box-warning">
                    <div class="box-header">
                            <i class="ion ion-edit"></i>
                            <h3 class="box-title">Editar Orden de Compra</h3>
                            <div class="box-tools">
                                <a href="ordcompra_index.php" class="btn btn-primary btn-sm pull-right" data-title="Volver" rel="tooltip" 
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
                               <?php $compras = consultas::get_datos("select * from v_orden_cabcompra where ord_com =".$_REQUEST['vord_com'] ); ?>
                               <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vord_com" value="<?php echo $compras[0]['ord_com']; ?>">
                               <div class="box-body">
                                   <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Fecha:</label>
                                    <input type="text" name="vord_fecha" class="form-control" required="" value="<?php echo $compras[0]['ord_fecha'];?> " readonly="">
                            </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                     <label>Clientes:</label>
                                     <div class="input-group">
                                     <?php $proveedor = consultas::get_datos("select * from proveedor order by prv_cod=".$compras[0]['prv_cod']."desc");?>
                                                    <select class="form-control select2" name="vprv_cod" required="">
                                                        <?php if (!empty($proveedor)) {                                                         
                                                        foreach ($proveedor as $prov) { ?>
                                                        <option value="<?php echo $prov['prv_cod']?>"><?php echo $prov['prv_ruc']." ".$prov['prv_razonsocial']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos un proveedor</option>
                                                        <?php }?>
                                                    </select>
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#rregistrar" data-title="Agregar Cliente" rel="tooltip">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                     </span>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Empleado:</label>
                                    <input type="text" name="vempleado" class="form-control" required="" value="<?php echo $compras[0]['empleado']; ?>" readonly="">
                                       </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                    <label>Sucursal:</label>
                                    <input type="text" name="vsucursal" class="form-control" required="" value="<?php echo $compras[0]['suc_descri']; ?>" readonly="">
                                       </div>
                               </div> 
                               </div>
                               <div class="box-footer">
                                   <button type="submit" class="btn btn-warning pull-right">
                                       
                                       <i class="fa fa-edit"></i> Actualizar
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
            
    </body>
</html>
