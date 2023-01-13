<?php
  include 'conexion.php';
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: inicioSesion.php');
  }

  $idCliente = $_SESSION['idCliente'];
  //SELECT PARA VERIFICAR ROL POR LAS DUDAS NOA ACTUALIZA EL DE LA VARIABLE SESSION
  $sql2 = "SELECT * FROM usuario WHERE idCliente='$idCliente' ";
  $res2 = mysqli_query($conexion, $sql2);
  if ($row2 = $res2->fetch_assoc()) {
    $rol = $row2['rol'];
  }
  if ($rol==0) {
    //ROL: CLIENTE
  }elseif ($rol==1) {
    //ROL: FLETERO
    //SQL1: EXTRAER INFORMACIÓN DE CLIENTE / FLETERO
    $sql1 = "SELECT * FROM cliente c INNER JOIN fletero f WHERE c.idCliente=f.idCliente AND c.idCliente='$idCliente' ";
    $res1 = mysqli_query($conexion, $sql1);
    if ($row1 = $res1->fetch_assoc()) {
      //DATOS CLIENTE
      $nombreCliente = $row1['nombreCliente'];
      $apellidoCliente = $row1['apellidoCliente'];
      $correoCliente = $row1['correoCliente'];
      $dniCliente = $row1['dniCliente'];
      $domicilioCliente = $row1['domicilioCliente'];
      $telefonoCliente = $row1['telefonoCliente'];
      $fechaNacCliente = $row1['fechaNacCliente'];
      $sexoCliente = $row1['sexoCliente'];
      if ($sexoCliente==0) {
        $sexoCliente = 'Hombre';
      }elseif ($sexoCliente==1) {
        $sexoCliente = 'Mujer';
      }else{
        $sexoCliente = 'No Binario';
      }
      $fechaRegCliente = $row1['fechaRegCliente'];

      //DATOS FLETERO
      $idFletero = $row1['idFletero'];
      $conductor = $row1['conductor'];
      $carnetFletero = $row1['carnetFletero'];
      $cedulaFletero = $row1['cedulaFletero'];
      $seguroFletero = $row1['seguroFletero'];
      $vehiculoFletero = $row1['vehiculoFletero'];
      $tituloFletero = $row1['tituloFletero'];
      $fechaRegFletero = $row1['fechaRegFletero'];
      $contador = $row1['contador'];
      $eliminado = $row1['eliminado'];
      
      //VARIABLE ROL
      $rolString = 'Fletero';
    }
  }else{
    //ROL: ADMINISTRADOR
  }
  

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FleteAR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<br>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("./template/header.php")?>

  <!-- ======= Sidebar ======= -->
  <?php  if($rol == 2){
      include ("./template/adminNav.php");
    }else if($rol==1){
      include ("./template/fleteroNav.php");
    }else{
      include ("./template/clienteNav.php");
    }
  ?>

  <main id="main" class="main">

    

    <section class="section dashboard">
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">

            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $apellidoCliente." ".$nombreCliente ?></span><span class="text-black-50"><?php echo $rolString ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">



                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Información del Perfil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><input disabled type="text" class="form-control" value="<?php echo $nombreCliente ?>" placeholder="nombre"></div>
                    <div class="col-md-6"><label class="labels">Apellido</label><input disabled type="text" class="form-control" value="" placeholder="apellido"></div>
                </div>
                <div class="row mt-2">
                <div class="col-md-12"><label class="labels">Correo Electronico</label><input disabled type="text" class="form-control" value="<?php echo $apellidoCliente?>" placeholder="correo"></div>
                </div>
                <div class="row mt-2">
                <div class="col-md-6"><label class="labels">DNI</label><input disabled type="text" class="form-control" value="<?php echo $dniCliente ?>" placeholder="dni"></div>
                <div class="col-md-6"><label class="labels">Telefono</label><input disabled type="text" class="form-control" value="<?php echo $telefonoCliente ?>" placeholder="telefono"></div>
                </div>
                <div class="row mt-2">
                <div class="col-md-12"><label class="labels">Domicilio</label><input disabled type="text" class="form-control" value="<?php echo $domicilioCliente ?>" placeholder="domicilio"></div>
                </div>
                <div class="row mt-2">
                <div class="col-md-6"><label class="labels">Fecha de Nacimiento</label><input disabled type="text" class="form-control" value="<?php echo $fechaNacCliente ?>" placeholder="fecha nacimiento"></div>
                <div class="col-md-6"><label class="labels">Sexo</label><input disabled type="text" class="form-control" value="<?php echo $sexoCliente ?>" placeholder="sexo"></div>
                </div>
                <div class="row mt-2">
                  <?php
                    if ($eliminado==0) {
                      $eliminado='ACTIVO';
                    }else{
                      $eliminado='ELIMINADO';
                    }
                  ?>
                <div class="col-md-6"><label class="labels">Fecha de Registro</label><input disabled type="text" class="form-control" value="<?php echo $fechaRegCliente ?>" placeholder="fecha registro"></div>
                <div class="col-md-6"><label class="labels">Estado</label><input disabled type="text" class="form-control" value="<?php echo $eliminado ?>" placeholder="estado"></div>

                </div>
                
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Guardar</button></div>                
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Información de Usuario</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Usuario</span></div><br>
                <div class="col-md-12"><label class="labels">Nombre de Usuario</label><input disabled type="text" class="form-control" placeholder="usuario" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Contraseña</label><input disabled type="password" class="form-control" placeholder="contraseña" value=""></div>
            </div>
        </div>
        <div class="col-md-6"><label class="labels">Contraseña</label><input disabled type="password" class="form-control" placeholder="contraseña" value=""></div>

    </div>

</div>
    

      
         
    </section>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>