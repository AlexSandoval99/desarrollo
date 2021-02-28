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
                            <i class="fa fa-list"></i>
                            <h3 class="box-title">Informe de Sucursal</h3>
                            <div class="box-tools">
                               
                    </div>
                    </div>
                        <div class="box-body ">
                          <div class="row">
                              <?php $opcion = (isset($_REQUEST['opcion'])?$_REQUEST['opcion']:"2"); ?>
                              <div class="col-lg-12 col-md-12 col-xs-12">
                                  <form action='sucursal_print.php' method="GET" accept-charset="UTF-8" class="form-horizontal">
                                      <input type="hidden" name="opcion" value="<?php echo $opcion ?>"/>
                                      <div class="box-body" >
                                      <div class="col-lg-4 col-md-4 col-xs-4" >
                                          <div class="panel panel-primary">
                                              <div class="panel-heading">
                                                  <strong>Opciones</strong>
                                              </div>
                                              <div class="panel-body">
                                                  <div class="list-group">
                                                      <a href="sucursal_rpt.php?opcion=1" class="list-group-item">Por Codigo</a>
                                                      <a href="sucursal_rpt.php?opcion=2" class="list-group-item">Por Descripcion</a>

                                                  </div>
                                                       
                                              </div>
                                              
                                          </div>
                                          
                                      </div>
                                          <div class="col-lg-8 col-md-8 col-xs-8" >
                                          <div class="panel panel-primary">
                                              <div class="panel-heading">
                                                  <strong>Filtros</strong>
                                              </div>
                                              <div class="panel-body">
                                                  <?php if ($opcion==1){
                                                       $sucur = consultas::get_datos('select * from sucursal order by id_sucursal'); 
                                                  }else{
                                                       $sucur = consultas::get_datos('select * from sucursal order by suc_descri');
                                                  } ?>
                                            
                                                  <div class="form-group">
                                                      <label class="control-label col-lg-2 col-md-2">Desde:</label>
                                                      <div class="col-lg-6 col-md-6 col-xs-6" > 
                                                          <select class="form-control select2" name="vdesde">
                                                           <?php foreach ($sucur as $suc) { ?>
                                                              <option value="<?php echo ($opcion==1)?$suc['id_sucursal']:$suc['suc_descri']; ?>">
                                                                 
                                                                    <?php echo($opcion==1)?$suc['id_sucursal']:$suc['suc_descri'];?></option>   
                                                              <?php }?>
                                                              
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class = "form-group">
                                                      <label class="control-label col-lg-2 col-md-2">Hasta :</label>
                                                      <div class="col-lg-6 col-md-6 col-xs-6" > 
                                                          <select class="form-control select2" name="vhasta">
                                                         <?php foreach ($sucur as $suc) { ?>
                                                              <option value="<?php echo ($opcion==1)?$suc['id_sucursal']:$suc['suc_descri']; ?>">
                                                                 
                                                                    <?php echo ($opcion==1)?$suc['id_sucursal']:$suc['suc_descri'];?></option>   
                                                              <?php }?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                              
                                          </div>
                                          
                                      </div>
                                          </div>
                                         
                                      <div class="box-footer">
                                          <button type="submit" class="btn btn-primary pull-right" >
                                              <i class="fa fa-print">Listar</i></button>
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
        $("#mensaje").delay(4000).slideUp(200, function (){
            $(this).alert('close');
        });
            </script>
            <script>
            $ ('. modal'). on ('shown.bs.modal', function () {
               $ (this) .find ('input: text: visible: first'). focus (); 
            });
        </script>    
       
    </body>
</html>

si
