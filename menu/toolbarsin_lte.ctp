<?php require ("clases/conexion.php"); ?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php if(!empty($_SESSION['usu_foto'])){ echo $_SESSION['usu_foto'];}else{ echo "img/avatar.png";}?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['usu_nick'];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Men&uacute; principal</li>
            <li><a href="/lp3/index.php"><span class="glyphicon glyphicon-home"></span> <strong>Inicio</strong></a></li>

    <?php
//Obtener el nombre de los modulos
    /*$modulos=consultas::get_datos("select distinct on(mod_nombre)* from modulos a
            join paginas b on a.mod_cod=b.mod_cod
            order by mod_nombre");*/
    $modulos=consultas::get_datos("select * from modulos 
        order by mod_cod");    
   
     foreach ($modulos as $modulo) { ?>                        
            <li class="treeview">
                <a href="">
                    <i class="ion ion-clipboard"></i><span><?php echo $modulo['mod_nombre']?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
        <?php
//Obtener las paginas de acuerdo al modulo
    $paginas=consultas::get_datos("select * from paginas a 
join modulos b on a.mod_cod=b.mod_cod where mod_nombre='".$modulo['mod_nombre']."' 
order by pag_nombre");        
        
        ?>                
                <ul class="treeview-menu">
                    <?php foreach ($paginas as $pagina) { ?>                    
                    <li><a href="<?php echo $pagina['pag_direc']?>"><i class="fa fa-circle-o"></i> <?php echo $pagina['pag_nombre']?></a></li>
                    <?php };?>
                </ul>
            </li>            
 <?php } ?>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>