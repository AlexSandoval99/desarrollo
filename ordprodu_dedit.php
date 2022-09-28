<?php 
require 'clases/conexion.php';
 //var_dump($_REQUEST['vordpro_cod']);
?>

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
        
    <h4 class="modal-title"></i>Materia Prima</h4>
</div>

<form action="ordprodu_dcontrol.php" method="POST" accept-charset="utf-8" class="form-horizontal">
    <div class="modal-body">
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Materia Prima</th>
                                <th>Cantidad de Materia</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $materia = consultas::get_datos("select art_cod, mater_cod, mater_descri,cant_mater from v_det_orden where ordpro_cod= ".$_REQUEST['vordpro_cod']." and art_cod= ".$_REQUEST['vart_cod']." group by art_cod, mater_cod, mater_descri,cant_mater");?>
                    
                        <?php foreach ($materia as $materi) 
                        { ?>
                        <tr>
                            <th><option value="<?php echo $materi['mater_cod']?>"><?php echo $materi['mater_descri']?></option></th>
                            <th><?php echo $materi['cant_mater']?></th>
                        </tr>
                        <?php } ?>
                    </select> 
                </div>
            </div>
        </div>
                        </tbody>
                    </table>
    </div>

    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
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
