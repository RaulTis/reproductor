<?php
ob_start();
 session_start();
 require_once('claseReproductor.php');
 
 
 //if(isset($_SESSION['autorizado']) && $_SESSION['autorizado']=='abcd4567$')
 if(!isset($_POST['save']))
		{
      if($_GET['nik']=='nuevo'){
            setlocale(LC_TIME,"es_MX");
            $id		     = -1;
            $fecha		  = strftime("%Y-%m-%d") ;
					       $hora    	= strftime("%H:%M");
				       	$idUsuario= $_SESSION['idUsuario'];
					       $titulo	  = '';
					       $url		    = '';
     }
     else{
       $reproductor=new Reproductor;
       $resultado=$reproductor->editarReproduccion($_GET['nik']);
     
       foreach($resultado as $row){
         $id		     = $row["rep_id"];
         $fecha		  = $row["rep_fecha"];
					    $hora    	= $row["rep_hora"];
					    $idUsuario= $row["rep_idUsuario"];
    					$titulo	  = $row["rep_titulo"];
					    $url		    = $row["rep_url"];
       }
    }
  }
  else{
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos del Personal</title>

	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content { margin-top: 80px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="content"  style="position: relative; top: -50px;">
			<h3>Transmicion de Radio</h3>
			<hr />
			<?php
				if(isset($_POST['save'])){
					$id		     = $_POST["rep_id"];
     $fecha		  = $_POST["rep_fecha"];
					$hora	    = $_POST["rep_hora"];
					$idUsuario =$_SESSION["idUsuario"];
					$titulo	  = $_POST["rep_titulo"];
					$url		    = $_POST["rep_url"];
    
     $reproductor=new Reproductor;
     $resultado2=$reproductor->modificarReproductor($id,$fecha,$hora,$idUsuario,$titulo, $url);
     header("Location: formInicio.php");
     ob_end_flush();
				}
    if(isset($_POST['saveNuevo'])){
           $fecha		  = $_POST["rep_fecha"];
				       $hora	    = $_POST["rep_hora"];
					      $idUsuario =$_SESSION["idUsuario"];
					      $titulo	  = $_POST["rep_titulo"];
					      $url		    = $_POST["rep_url"];
		         $reproductor=new Reproductor;
           $resultado2=$reproductor->agregarReproductor($id,$fecha,$hora,$idUsuario,$titulo, $url);
           header("Location: formInicio.php");
           ob_end_flush();
    }
			?>
			<form class="form-horizontal" action="#" method="post">
    <?php
       if($_GET['nik']<>'nuevo'){ ?>
				        <div class="form-group">
              <label class="col-sm-3 control-label">Fecha</label>
					            <div class="col-sm-4">
						               <input type="text" name="rep_id" value="<?php echo $id; ?>" class="form-control" placeholder="ID" required>
					            </div>
				        </div>
     <?php
       }
     ?>
     
				<div class="form-group">
        <label class="col-sm-3 control-label">Fecha</label>
					   <div class="col-sm-4">
						     <input type="text" name="rep_fecha" value="<?php echo $fecha; ?>" class="form-control" placeholder="Fecha" required>
					    </div>
				</div>
				<div class="form-group">
					  <label class="col-sm-3 control-label">Hora</label>
					    <div class="col-sm-4">
						     <input type="text" name="rep_hora" value="<?php echo $hora; ?>" class="form-control" placeholder="Hora" required>
					    </div>
				</div>
        
				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo</label>
					<div class="col-sm-4">
						<input type="text" name="rep_titulo" value="<?php echo $titulo; ?>" class="input-group date form-control"	placeholder="Titulo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">URL</label>
					<div class="col-sm-3">
						<input type="text" name="rep_url" value="<?php echo $url; ?>" class="input-group date form-control"	placeholder="URL" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
      <?php
         if($_GET['nik']<>'nuevo') { ?>
						        <input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
          <?php
             }
          else
          {
           ?>
						        <input type="submit" name="saveNuevo" class="btn btn-sm btn-primary" value="Guardar datos">
          <?php
          } ?>
						<a href="forminicio.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script>
	function seleccionar() {
	    $("#selectdep option[value='1']").attr("selected", true);
	}
	</script>
</body>
</html>
