<?php 
require 'clases/conexion.php';

$detalles = consultas::get_datos("select * from v_detalle_cont_produc where cont_producc_cod=".$_REQUEST['vcont_producc_cod']
." and art_cod=".$_REQUEST['vart_cod']." and etap_producc_cod=".$_REQUEST['vetap_producc_cod']);
$detall = consultas::get_datos("select * from v_detalle_cont_produc where cont_producc_cod=".$_REQUEST['vcont_producc_cod']
." and art_cod=".$_REQUEST['vart_cod']."order by etap_producc_cod asc");
//var_dump($detall[0]);
?>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
    <h4 class="modal-title"><i class="fa fa-plus"></i> Editar Detalle del orden</h4>
</div>
<form action="contprodu_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="1">
    <input type="hidden" name="vcont_producc_cod" value="<?php echo $detalles[0]['cont_producc_cod'];?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod'];?>">
    <input type="hidden" name="vetap_producc_cod" value="<?php echo $detalles[0]['etap_producc_cod'];?>">
    <div class="modal-body">
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="input-group">
                <label>Etapa Verificada:</label>
                <br>
                    <?php $proveedor = consultas::get_datos("select * from v_detalle_cont_produc where cont_producc_cod=".$_REQUEST['vcont_producc_cod']
                    ." and art_cod=".$_REQUEST['vart_cod']." and etap_producc_cod=".$_REQUEST['vetap_producc_cod']);?>
                    <?php foreach ($proveedor as $prov) { ?>
                        <td data-title="Etapa"><?php echo $prov['det1'];?>  
                    <span >
                        <input type="checkbox" name="vetapa1"value='t'<?php if ($prov['etapa1']== 't') {?>checked <?php }else{ }?>>
                    </span>
                        </td> <?php } ?>                                                
                    
            </div>
        </div>  
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <label>Cantidad Total:</label>
            <input type="text" value="<?php if($detalles[0]['etap_producc_cod']==1){ echo $detalles[0]['cant'];}else{echo $detall[0]['residuo'];}?>" disabled>
        </div>
        <div class="col-lg-6 col-sm-5 col-md-5 col-xs-5">
            <label>OBS:</label>
                <br>
                <input type="text" class="form-control" name="vdetall" value="<?php if (!empty($prov['detall'])) { echo $prov['detall']?><?php }else{ }?>" required="">
        </div> 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <label>Cantidad Controlada:</label>
            <td><input type="number" name="vresiduo" value="<?php if($detalles[0]['etap_producc_cod']==1){ echo $detalles[0]['residuo'];}else{echo $detalles[0]['residuo'];}?>"></td>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Actualizar</button>
    </div>
</form>
        <!-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                     <label>Etapa 2:</label>
                                     <div class="input-group">
                                      <?php $proveedor = consultas::get_datos("select * from etapas_producc where art_cod =".$_REQUEST['vart_cod']."order by etap_pruducc_cod");?>
                                                    <select class="form-control select2" name="vdet2">
                                                        <?php if (!empty($proveedor)) {  ?> 
                                                          <option value="">Seleccione una Etapa</option>  
                                                        <?php foreach ($proveedor as $prov) { ?>
                                                        <option value="<?php echo $prov['etap_descri']?>"><?php echo $prov['etap_descri']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos una Etapa</option>
                                                        <?php }?>
                                                       
                                                    </select>
                                     <span class="input-group-btn">
                                         <input type="checkbox" name="vetapa2"value='t'>
                                     </span>
                                </div>
                            </div> 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                     <label>Etapa 3:</label>
                                     <div class="input-group">
                                      <?php $proveedor = consultas::get_datos("select * from etapas_producc where art_cod =".$_REQUEST['vart_cod']."order by etap_pruducc_cod");?>
                                                    <select class="form-control select2" name="vdet3" >
                                                     <?php if (!empty($proveedor)) {  ?> 
                                                          <option value="">Seleccione una Etapa</option>  
                                                        <?php foreach ($proveedor as $prov) { ?>
                                                        <option value="<?php echo $prov['etap_descri']?>"><?php echo $prov['etap_descri']?></option>
                                                        <?php }                                                    
                                                        }else{ ?>
                                                        <option value="">Debe insertar al menos una Etapa</option>
                                                        <?php }?>
                                                       
                                                    </select>
                                     <span class="input-group-btn">
                                         <input type="checkbox" name="vetapa3"value='t'>
                                     </span>
                                </div>
                            </div>
        <br>
        <br>
        <br> -->
         
         
