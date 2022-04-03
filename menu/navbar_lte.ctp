<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Menu emergente derecho -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php if(!empty($_SESSION['usu_foto'])){ echo $_SESSION['usu_foto'];}else{ echo "img/alex.jpg";}?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $_SESSION['usu_nick'];?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- Imagen de Usuario -->
                    <li class="user-header">
                        <img src="<?php if(!empty($_SESSION['usu_foto'])){ echo $_SESSION['usu_foto'];}else{ echo "img/alex.jpg";}?>" class="img-circle" alt="User Image">
                        <p>
                            <?php echo $_SESSION['nombres'];?>
                            <small>Cargo: <?php if(!empty($_SESSION['cargo'])){ echo $_SESSION['cargo'];}else{ echo "No especificado";}?></small>
                        </p>
                    </li>

                    <!-- acciones dentro del menu emergente-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="/menu.php" class="btn btn-default">Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="localhost/allcant.2.0/" class="btn btn-default">Salir</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>