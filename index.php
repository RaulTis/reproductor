<?php
ob_start();
session_start();

if(isset($_GET['nik'])){
  if($_GET['nik']=="nuevo"){
     header("Location: usuarioForm.php");
     return;
  }
}

if(isset($_POST['pasa']) && $_POST['pasa']=='123$123'){
       require_once('claseUsuario.php');
       $usuarios=new Usuarios;
       foreach($_POST as $variable=>$valor){
          $swap=$variable;
          $$variable=$valor;
       }
 
       $login=$usuarios->buscarUsuario($txtUsuario,sha1($txtContrasena));
       $row = $login[0];
        $_SESSION['estatus']=$row['estatus'];
       if($row['estatus']=='activo'){
          $_SESSION['autorizado']='abcd4567$';
		      $_SESSION['idUsuario']=$row['usu_id'][0];
          $_SESSION['usuario']=$row['usu_usuario'];
          
          header("Location:formInicio.php");
          ob_end_flush();
       }
       else{
          header("Location: index.php");
          ob_end_flush();
       }
    }
    
    
    


if(isset($_SESSION['estatus'])) {
   if($_SESSION['estatus']=='error'){

   }
   else{
         header("Location: formInicio.php");
         ob_end_flush();
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="img/escudo.ico">
 
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
 
	<link rel="stylesheet" href="css/estilos.css">
 
	<title>Registro de Radio Frecuencias</title>
</head>

<body>
        <div class="container-fluid">
         <nav class="navbar navbar">
           <div class="navbar-header"> 
           
           </div>
         </nav>
        </div>
		
		<section class="container">
     <div id="contenido">
       <div class="row">
         <div class="col-sm-offset-3 col-sm-6">
           <div class="panel panel-footer">
             <div class="panel-heading">
               <h3 class="panel-title">
                   Acceso
                   <i class="fa fa-key fa-2x pull-right"></i>
                   <br>
                   <small>Introduzca usuario y password</small>
               </h3>
             </div>
             <div class="panel-body">
                <div class="alert alert-warning error" role="alert" id="mensaje"
                     style="display:none;">
                     <strong>Datos de ingreso no validos</strong>, solo usuarios autorizados
                </div>
                <form action="" method="post" id="login">
                   <div class="form-group">
                      <label for="usuario" class="sr-only">Usuario</label>
                      <div class="input-group">
                         <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                         </span>
                         <input type="text" id="txtUsuario" name="txtUsuario"
                                class="form-control input-lg" placeholder="Nombre de Usuario">
                      </div>
                   </div>
                   <div class="form-group">
                       <label for="password" class="sr-only">
                          Contraseña
                       </label>
                       <div class="input-group">
                          <span class="input-group-addon">
                             <i class="fa fa-lock"></i>
                          </span>
                          <input type="password" id="txtContrasena" name="txtContrasena"
                                 class="form-control input-sm" placeholder="Contraseña">
                       </div>
                       <input type="hidden" id="pasa" name="pasa" value="123$123">
                   </div>
                   <div class="row">
                       <center>
                          <div class="input-group">
                             <button class="btn btn-primary btn-lg" id="entrar">
                                 <i class="fa fa-unlock"></i>&nbsp;
                                    Entrar
                             </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             
                             <button class="btn btn-warning btn-lg" id="registrarse">
                               <a href="index.php?nik=nuevo">
                                 <i class="fa fa-address-card"></i>
                                    Registrarse
                                 </a>
                             </button>
                           
                          </div>
                       </center>
                   </div>
                </form>
             </div>
             <div class="panel-footer">
                <h6>
                  <?php
                       if(isset($_SESSION['estatus']))
                          if($_SESSION['estatus']=='error'){
                              echo '<b style="color:white;background-color:red;">El usuarios no esta registrados</b>';
                          }  
                   ?>
                </h6>
             </div>
           </div>
         </div>
       </div>
     </div>
  </section>
		
		<footer class="center">
    <!-- ?php
        if(isset($_SESSION['autorizado']) && $_SESSION['autorizado']=='abcd4567$'){?>
            <strong>Bienvenido/a:< ?php echo $_SESSION['usu_usuario']; ?></strong>
           < ?php
        } else { ?>
           <strong>No esta registrado/a</strong>
           < ?php
        } ? -->
    </footer>
  
    <script src="jquery/jquery-1.11.1.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrapValidator.min.js"></script>
    <script src="js/validar.js"></script>
 
</body>
</html>