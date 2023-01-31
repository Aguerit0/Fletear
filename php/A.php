<?php
include 'conexion.php';
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: inicioSesion.php');
}

$idCliente = $_SESSION['idCliente'];
$eliminadoCliente=0;
$contadorWhile = 0;
//SELECT PARA VERIFICAR ROL POR LAS DUDAS NOA ACTUALIZA EL DE LA VARIABLE SESSION
$sql2 = "SELECT * FROM usuario WHERE idCliente='$idCliente' ";
$res2 = mysqli_query($conexion, $sql2);
if ($row2 = $res2->fetch_assoc()) {
  $rol = $row2['rol'];
}
if ($rol == 0) {
  //ROL: CLIENTE
  //SQL1: CONSULTA PARA EXTRAER IMAGENES E INFO DE TABLA FLETERO PARA MOSTRAR TOP 3
  $sql1 = "SELECT * FROM cliente c INNER JOIN fletero f WHERE (c.eliminadoCliente<1) AND (f.eliminadoFletero<1) ORDER BY f.puntajeFletero DESC LIMIT 3";
  $res1 = mysqli_query($conexion, $sql1);
  
} elseif ($rol == 1) {
  //ROL: FLETERO

} else {
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

  <!-- Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Preview Image -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("template/header.php") ?>

  <!-- ======= Sidebar ======= -->
  <?php if ($_SESSION['rol'] == 2) {
    include("./template/adminNav.php");
  } else if ($_SESSION['rol'] == 1) {
    include("./template/fleteroNav.php");
  } else {
    include("./template/clienteNav.php");
  }
  ?>

  <main id="main" class="main">
    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Buscar Fleteros</h2>
          <p>Top 3 Fleteros</p>
        </div>
        <div class="container">
          <div class="row">

          <?php
            while ($row1 = $res1->fetch_assoc()) {
          ?>
            <div class="col-md-4">
              <div class="card user-card">
                <div class="card-header">
                  <h5>Perfil</h5>
                </div>
                <div class="card-block">
                  <div class="user-image">
                    <img src="<?php echo $row1['conductor'] ?>" class="img-radius" alt="imagen fletero">
                  </div>
                  <h6 class="f-w-600 m-t-25 m-b-10"><?php echo $row1['apellidoCliente']." ".$row1['nombreCliente'] ?></h6>
                  <?php if ($row1['eliminadoFletero']==0) {
                    $eliminadoCliente="EN LINEA";
                  }else{
                    $eliminadoCliente="INACTIVO";
                  }
                  $sexoCliente = $row1['sexoCliente'];
                  if ($sexoCliente==0) {
                    $sexoCliente = 'Hombre';
                  }elseif ($sexoCliente==1) {
                    $sexoCliente = 'Mujer';
                  }else{
                    $sexoCliente = 'No Binario';
                  }
                  ?>
                  <p class="text-muted"><i class="fa fa-circle" style="<?php if ($row1['actividadFletero']==1) {?>color: green;<?php echo " ";}else if($row1['actividadFletero']==0){?>color: red;<?php echo " ";} ?>"> </i><?php if($row1['actividadFletero']==1){echo " EN LINEA";}else if($row1['actividadFletero==0']){echo " INACTIVO";}; ?> | <?php echo $sexoCliente ?> | Telefono: <?php echo $row1['telefonoCliente'] ?></p>
                  <hr>
                  <p class="text-muted m-t-15">Activity Level: 87%</p>
                  <ul class="list-unstyled activity-leval">
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                  </ul>
                  <div class="bg-c-blue counter-block m-t-10 p-20">
                    <div class="row">
                      <div class="col-4">
                        <i class="fa fa-car"></i><!-- VEHICULOS -->
                        <p><?php echo $row1['cantidadVehiculosFletero'] ?></p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-road"></i><!-- VIAJES -->
                        <p><?php echo $row1['cantidadServiciosFletero'] ?></p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-star"></i><!-- PUNTAJE -->
                        <p><?php echo $row1['puntajeFletero'] ?></p>
                      </div>
                    </div>
                  </div>
                  <p class="m-t-15 text-muted"><?php echo $row1['descripcionFletero'] ?></p>
                  <hr>
                  <div class="row justify-content-center user-social-link">
                    <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-instagram text-instagram"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-whatsapp text-whatsapp"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }
          ?>
          </div>
        </div>


    </section><!-- End Resume Section -->
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