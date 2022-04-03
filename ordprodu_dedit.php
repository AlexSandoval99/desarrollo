<?php 
require 'clases/conexion.php';

$detalles = consultas::get_datos("select * from v_det_orden_mater where ordpro_cod=".$_REQUEST['vordpro_cod']);
$consul = consultas::get_datos("select * from v_det_orden where ordpro_cod=".$_REQUEST['vordpro_cod']);
//var_dump($consul);
?>

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
        
    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar la Materia Prima</h4>
</div>
<?php if (!empty($detalles)) {?>
 <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Articulo</th>
                                                           <th>Materia Prima</th>
                                                           <th>Cantidad de Materia</th>
                                                           <th>Accion</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($detalles as $det) { ?>
                                                        <tr>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <td data-title="Materia Prima"><?php echo $det['mater_descri'];?></td>
                                                            <td data-title="Cantidad de Materia Prima"><?php echo $det['cant'];?></td>
                                                             <td data-title="Acciones">

                                                                    <a onclick="borrar(<?php echo "'".$det['ordpro_cod']."_".$det['art_descri']." ".$det['mater_descri']."_".$det['art_cod']."_".$det['mater_cod']."'"?>)"
                                                                       class="btn btn-danger btn-sm" data-title="Borrar" rel="tooltip" 
                                                                       data-toggle="modal" data-dismiss="modal" data-target="#borrar">
                                                                    <i class="fa fa-trash"></i></a>                                                                    
                                                            </td>
                                                            
                                                        </tr>
                                                             
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>





     <?php }else{ ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                El pedido aún no posee detalles...
                                            </div>
                                            <?php } ?>
<form action="ordprodu_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="1">
    <input type="hidden" name="vordpro_cod" value="<?php echo $consul[0]['ordpro_cod'];?>">
<!--    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod'];?>">-->

<!--    <input type="hidden" name="vart_cod" value="<?php //echo $detalles[0]['art_cod'];?>">
    <input type="hidden" name="vdep_cod" value="<?php //echo $detalles[0]['dep_cod'];?>">-->
    <div class="modal-body">
          <div class="form-group">
              
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Articulo:</label>

                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php $articulo = consultas::get_datos("select art_descri, art_cod from v_det_orden where ordpro_cod=".$_REQUEST['vordpro_cod']);?>
                                                                <select class="form-control select2" name="vart_cod" required="">
                                                                    <?php if (!empty($articulo)) {                                                         
                                                                    foreach ($articulo as $arti) { ?>
                                                                    <option value="<?php echo $arti['art_cod']?>"><?php echo $arti['art_descri']?></option>
                                                                    <?php }                                                    
                                                                    }else{ ?>
                                                                    <option value="">Debe insertar al menos un articulo</option>
                                                                    <?php }?>
                                                                </select> 
                                                        </div>
        </div> 
        <div class="form-group">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2">Materia Prima:</label>
                                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <?php $materia = consultas::get_datos("select * from mater_prim ");?>
                                                                <select class="form-control select2" name="vmater_cod" required="">
                                                                    <?php if (!empty($materia)) {                                                         
                                                                    foreach ($materia as $materia) { ?>
                                                                    <option value="<?php echo $materia['mater_cod']?>"><?php echo $materia['mater_descri']?></option>
                                                                    <?php }                                                    
                                                                    }else{ ?>
                                                                    <option value="">Debe insertar al menos un deposito</option>
                                                                    <?php }?>
                                                                </select> 
                                                        </div>
                                                    </div>
       
        <div class="form-group">
            <label class="control-label col-lg-2 col-md-2 col-sm-2">Cantidad:</label>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <input type="number" class="form-control" name="vcant" min="1" value="<?php echo $detalles[0]['cant'];?>"/>
            </div>
        </div>
        
    </div>

    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</button>
    </div>
</form>

<script>
function borrar(datos){
            var dat = datos.split('_');
                $('#si').attr('href','ordprodu_dcontrol.php?vordpro_cod='+dat[0]+'&vart_cod='+dat[2]+'&vmater_cod='+dat[3]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea quitar el articulo <strong>'+dat[1]+'</strong> del orden N° <strong>'+dat[0]+'</strong>?');
        }
</script>
