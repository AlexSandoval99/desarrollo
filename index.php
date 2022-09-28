<!DOCTYPE html>
<?php session_start();
if($_SESSION){
    session_destroy();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso</title>
        <meta name="viewport" content="width=device-width, initialscale=1, maximum-scale=1, user-scalable=no">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        <style>
            body{
               
                padding-top: 40px;
                padding-bottom: 40px;
                background: url(img/Fondos.jpg)
            }
            .login{
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
             
            }
            #sha{
                max-width: 330px;
                -webkit-box-shadow: 0px 0px 18px 0px rgba(48,50,50,0.48);
                -moz-box-shadow:  0px 0px 18px 0px rgba(48,50,50,0.48);
                box-shadow:  0px 0px 18px 0px rgba(48,50,50,0.48);
                border-radius: 5%;
              
            }
            #avatar{
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                border-radius: 5%;
               
            }
           
        </style>
    </head>
    <body>
        <div class="container well" id="sha">
            <div class="row">
                 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
                     <img src="img/avatar.png" class="img-responsive" id="avatar">
                </div>
             </div>
            <form class="login" action="acceso.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="usuario" required="" autofocus=""placeholder="Ingrese un usuario"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="clave" required="" autofocus=""placeholder="Ingrese su clave"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Iniciar Sesion
                </button>
                <div class="checkbox" >
                    <label class="checkbox">
                        <input type="checkbox" value="1" name="recuerdame"/>No cerrar Sesion
                    </label>
                    <p class="help-block"><a href="#">No puede acceder a su cuenta?</a></p>
                </div>
                <?php if (!empty($_SESSION ['error'])) {?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign">
                        <?php echo $_SESSION['error'];?>
                    </span>
                
                </div>
                <?php }?>
            </form>
            
        </div>
       <!-- archivo js-->
       <script src="js/jquery-1.12.2.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
       </body>
</html>
