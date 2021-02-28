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
        session_start(); /* Reanudar sesion */
        require 'menu/css_lte.ctp';
        ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
<?php require 'menu/toolbar_lte.ctp'; ?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-list"></i>
                                    <h3 class="box-title">Informe de Orden de Compras</h3>
                                    <div class="box-tools">
                                    </div>
                                </div>
                                <!-- AQUI VA EL CONTENIDO DE LA TABLA-->
                                <div class="box-body">
                                    <div class="row">
                                        <?php $opcion = (isset($_REQUEST['opcion'])?$_REQUEST['opcion']:"2");?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="ordcompra_print.php" method="GET" accept-charset="utf-8" class="form-horizontal">
                                                <input type="hidden" name="opcion" value="<?php echo $opcion;?>"/>
                                                <div class="box-body" >
                                                    <div class="col-sm-4 col-lg-4">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                <strong>Opciones</strong>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="list-group">
                                                                    <a href="ordcompra_rpt.php?opcion=1" class="list-group-item">Por Fecha</a>
                                                                    <a href="ordcompra_rpt.php?opcion=2" class="list-group-item">Por Proveedor</a>
                                                                    <a href="ordcompra_rpt.php?opcion=3" class="list-group-item">Por Articulo</a>
                                                                    <a href="ordcompra_rpt.php?opcion=4" class="list-group-item">Por Empleado</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-lg-8">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                <strong>Filtros</strong>
                                                            </div>
                                                            <div class="panel-body">                                                                
                                                                <?php
                                                                        switch ($opcion) {
                                                                            case 1:  ?>
                                                                            <div class="form-group has-feedback">
                                                                                <label class="control-label col-lg-2 col-md-2">Desde:</label>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <input type="date" class="form-control" name="vdesde" autofocus=""/>
                                                                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group has-feedback">
                                                                                <label class="control-label col-lg-2 col-md-2">Hasta:</label>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <input type="date" class="form-control" name="vhasta" autofocus=""/>
                                                                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                                                                </div>
                                                                            </div>                                                                        

                                                                <?php       break;
                                                                            case 2: 
                                                                                $proveedor = consultas::get_datos("select * from proveedor where prv_cod in(select prv_cod from orden_cabcompra)");
                                                                            ?> 
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-2 col-md-2">Proveedor:</label>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <select class="form-control select2" name="vproveedor">
                                                                                        <?php foreach ($proveedor as $p) { ?>
                                                                                        <option value="<?php echo $p['prv_cod'];?>">
                                                                                        <?php echo $p['prv_razonsocial']?></option>
                                                                                        <?php }?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>                                                                
                                                                <?php       break;
                                                                            case 3:
                                                                                $articulos = consultas::get_datos("select * from v_articulo where art_cod in(select art_cod from detalle_ordcompra)");
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-2 col-md-2">Articulos:</label>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <select class="form-control select2" name="varticulo">
                                                                                        <?php foreach ($articulos as $a) { ?>
                                                                                        <option value="<?php echo $a['art_cod'];?>">
                                                                                        <?php echo $a['art_descri']." ".$a['mar_descri'];?></option>
                                                                                        <?php }?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>                                                                  
                                                                <?php       break;
                                                                            case 4:
                                                                                $empleados = consultas::get_datos("select * from empleado where emp_cod in(select emp_cod from orden_cabcompra)");
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-lg-2 col-md-2">Empleados:</label>
                                                                                <div class="col-lg-6 col-md-6">
                                                                                    <select class="form-control select2" name="vempleado">
                                                                                        <?php foreach ($empleados as $e) { ?>
                                                                                        <option value="<?php echo $e['emp_cod'];?>">
                                                                                        <?php echo $e['emp_nombre']." ".$e['emp_apellido'];?></option>
                                                                                        <?php }?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>                                                                 
                                                                <?php            break;
                                                                        }
                                                                ?>                                                                                                                                                                                              
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div> 
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-print"></i> Listar
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
            </div>
        <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
        </div>                  
<?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
    </body>
</html>


