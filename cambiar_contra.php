<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS BOOTSTRAP-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        label {
            color: white;
        }
        body,
        html {
            background: url(img/14.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .login {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        #sha {
            max-width: 340px;
            -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            border-radius: 6%;
        }

        #avatar {
            width: 96px;
            height: 96px;
            margin: 0px auto 10px;
            display: block;
            border-radius: 50%;
        }
    </style>
    <?php
    session_start();/*Reanudar sesion*/
    ?>
</head>

<body>
    <div class="container well" id="sha">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if (!empty($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role='alert' id="mensaje">
                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                        <?php echo $_SESSION['error'];?>
                    </div>                    
                <?php } ?>
                <img src="img/avatar.png" class="img-responsive" id="avatar" />
            </div>
        </div>
        <form class="login" action="cambiar_contra_control.php" method="post" accept-charset="utf-8">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" readonly="" name="emp_name" value="<?php echo $_SESSION['nombres'];?>" />
                <input type="text" hidden name="usuario" value="<?php echo $_SESSION['usu_nick'];?>">
                <input type="text" hidden name="vusu_cod" value="<?php echo $_SESSION['usu_cod'];?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" placeholder="Ingrese su contraseña actual" name="clave" class="form-control"  autofocus="" required="" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" placeholder="Ingrese su nueva contraseña" name="new_clave"  id="new_clave" class="form-control" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" placeholder="Confirme su nueva contraseña" name="new_clave2" id="new_clave2" onchange="confirmarcontraseña();" class="form-control"  />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <button class="btn btn-primary btn-md btn-block">Cambiar Contraseña</button>
            <button class="btn btn-primary btn-md btn-block"> <a href="menu.php"></a>Volver</button>
        </form>
    </div>

    <!-- JS BOOTSTRAP Y JQUERY-->
    <script src="js/jquery-1.12.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#mensaje").delay(4000).slideUp(200, function() {
        $(this).alert('close');
        });
        function confirmarcontraseña(){
            var pass  = $('#new_clave').val();
            var pass2 = $('#new_clave2').val();

            if(pass != pass2){
                alert('Las contraseñas no coinciden');
                $('#new_clave').val('');
                $('#new_clave2').val('');
                $('#new_clave').focus();
            }

        }
    </script>
</body>

</html>