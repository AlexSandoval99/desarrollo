<?php 
require 'clases/conexion.php';


$consul = consultas::get_datos("select * from v_detmermas where merm_cod=".$_REQUEST['vmerm_cod']);
 $materia = consultas::get_datos("select * from v_mater  where tip_art_cod =".$_REQUEST['vtip_art_cod'] );
 $total
//var_dump($detalles);
 
?>

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i></button>
        
    <h4 class="modal-title"><i class="fa fa-plus"></i> Mermas</h4>
</div>

 <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Articulo</th>
                                                           <th class="text-center">Materia Prima</th>
                                                           <th class="text-center">Cantidad de Materia</th>
                                                           <th >Precio</th>
                                                           <th>Subtotal</th>
                                                        </tr>                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($consul as $cons) { ?>
                                                        <?php foreach ($materia as $det) { ?>
                                                        
                                                        
                                                        
                                                      
                                                        <tr>
                                                             <td class="text-center" data-title="Artiulo"><?php echo $cons['art_descri'];?></td>
                                                            <td class="text-center" data-title="Materia Prima"><?php echo $det['mater_descri'];?></td>
                                                        <td class="text-center" data-title="Cantidad de Materia Prima"><?php echo $cons['cant'];?></td>
                                                        <td class="text-center" data-title="Precio"><?php echo number_format($det['mater_precio'],0,",",".");?></td>
                                                        <td data-title="Cantidad de Materia Prima"><?php $flowers = array($cons['cant']*$det['mater_precio']);                                                               
                                                                //Prints the array
                                                                foreach($flowers as $flower){
                                                                    echo  number_format($flower,0,",","."); "\n";
                                                        }
                                                        }
                                                                ?></td>
                                                         <?php } ?>
                                                        </tr>
                                                             
                                                       
                                                        
                                                    </tbody>
                                                </table>
                                            </div>





  
