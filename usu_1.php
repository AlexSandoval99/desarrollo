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
            <?php// require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="cargo_print.php" class="btn btn-default btn-sm" data-title ="Imprimir" rel="tooltip" data-placement="top" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a onclick="add()" class="btn btn-primary btn-sm" data-title = "Agregar" rel="tooltip" 
                                           data-placement="top" data-toggle="modal" data-target="#mymodal"> 
                                            <i class="fa fa-plus"></i></a>                                        
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
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <?php 
                                                $usuarios = consultas::get_datos("select * from v_usuarios order by usu_cod");
                                                if (!empty($usuarios)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Empleado</th>
                                                                <th>Nick</th>
                                                                <th>Grupo</th>
                                                                <th>Sucursal</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($usuarios as $usuario) { ?>
                                                            <tr>
                                                                <td data-title="Empleado"><?php echo $usuario['empleado']?></td>
                                                                <td data-title="Nick"><?php echo $usuario['usu_nick']?></td>
                                                                <td data-title="Grupo"><?php echo $usuario['gru_nombre']?></td>
                                                                <td data-title="Sucursal"><?php echo $usuario['suc_descri']?></td>
                                                                <td data-title="Acciones" class="text-center">
                                                                  <a onclick="edit(<?php echo "'".$usuario['usu_cod']."'"?>)" class="btn btn-warning btn-sm" data-title = "Editar" rel="tooltip" 
                                                                 data-placement="top" data-toggle="modal" data-target="#mymo"> 
                                            <i class="fa fa-edit"></i></a>  
                                                                    <a onclick="borrar(<?php echo "'".$usuario['usu_cod']."_".$usuario['usu_nick']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>                        
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado cargos...
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
                  <?php require 'menu/footer_lte.ctp'; ?><!--PIE DE PAGINA-->  
                  <!-- FIN MODAL POR PAGINA-->  
                  <div class="modal fade" id="mymodal" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                              
                          </div>
                      </div>                      
                  </div>                  
                  <!-- FIN MODAL POR PAGINA--> 
                  <!-- MODAL PARA EDITAR-->
                  <div class="modal fade" id="mymo" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="edit">
                              
                          </div>
                      </div>                      
                  </div>  
                  <!-- FIN MODAL PARA EDITAR-->  
                  <!-- MODAL PARA BORRAR-->
                  <div class="modal fade" id="borrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-danger" id="confirmacion"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="si" role='buttom' class="btn btn-primary">
                                          <span class="glyphicon glyphicon-ok-sign"> SI</span>
                                      </a>
                                  </div>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA BORRAR-->                   
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });            
        </script>
        <script>
            $('.modal').on('shown.bs.modal',function(){
               $(this).find('input:text:visible:first').focus(); 
            });
        </script>    
        <script>
        function add(){
            $.ajax({
                type    : "GET",
                url     : "/lp3/usuarios_add.php",
                cache   : false,
                beforeSend:function(){
                    $("#detalles").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            })
        };            
            function edit(cod,nick,cla){
                $.ajax({
                type    : "GET",
                url     : "/lp3/usuarios_edit.php?vusu_cod="+cod+"&vusu_nick="+nick,
                cache   : false,
                beforeSend:function(){
                    $("#edit").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#edit").html(data)
                }
            })
        };
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','usuarios_control.php?vusu_cod='+dat[0]+'&vusu_nick='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar el usuario <i><strong>'+dat[1]+'</strong></i>?');
            }
        </script>        
    </body>
</html>


