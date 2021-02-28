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
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Stock</h3>
                                    <div class="box-tools">
                                        <a href="articulo_print.php" class="btn btn-default btn-sm" data-title ="Imprimir" rel="tooltip" data-placement="top" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>                                        
                                        <a href="articulo_add.php" class="btn btn-primary btn-sm pull-right" data-title="Agregar" rel="tooltip" 
                                           data-placement="top">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                                <div class="alert alert-danger" role="alert" id="mensaje">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    <?php echo $_SESSION['mensaje'];
                                                    $_SESSION['mensaje'] ='';
                                                    ?>
                                                </div>
                                                <?php } ?>
                                                <form action="" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                    <div class="box-body">
                                                        <div class="form-group">                                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" 
                                                                       placeholder="Ingrese parametro de búsqueda" autofocus="">
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar..." rel="tooltip" 
                                                                            data-placement="top">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>                                                
                                                <?php $stock = consultas::get_datos("select * from v_stock ");
                                                 if (!empty($stock)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-condensed table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Sucursal</th>
                                                                <th>Deposito</th> 
                                                                <th>Articulo</th>
                                                                <th>Cantidad</th> 
 
                                                               
                                                                <!--<th class="text-center">Acciones</th>--> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>
           
                                                            <?php foreach ($stock as $s) { ?>
                                                            <tr>
                                                                <td data-title="Sucursal"><?php echo $s['suc_descri'];?></td>
                                                                <td data-title="Deposito"><?php echo $s['dep_descri'];?></td>
                                                                <td data-title="Articulo"><?php echo $s['art_descri'];?></td>
                                                            <?php if($s['stoc_cant']>0){ ?>
                                                                <td data-title="Cantidad"><?php echo number_format($s['stoc_cant'], 0, ",", ".");?></td>
                                                            <?php }else { ?>
                                                                    <td data-title="Cantidad"><?php echo 'AGOTADO';?></td> 
                                                                  <?php   } ?>
                                                                
                                                             
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <?php }else{ ?>
                                                <div class="alert alert-info">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se hay stock...
                                                </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
                     <!-- FIN MODAL POR PAGINA-->  
                  <div class="modal fade" id="mymodal" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="add">
                              
                          </div>
                      </div>                      
                  </div>                  
                  <!-- FIN MODAL POR PAGINA--> 
                    
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
        $("#mensaje").delay(4000).slideUp(200,function(){
            $(this).alert('close');
        })
        </script>
         <script>
        function add(cod){
            $.ajax({
                type    : "GET",
                url     : "/taller/stock_trans.php?vdep_cod="+cod ,
                cache   : false,
                beforeSend:function(){
                    $("#add").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#add").html(data)
                }
            })
        };       
        </script> 
    </body>
</html>
