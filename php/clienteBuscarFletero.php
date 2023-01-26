<?php
include 'conexion.php';
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: inicioSesion.php');
}

$idCliente = $_SESSION['idCliente'];
//SELECT PARA VERIFICAR ROL POR LAS DUDAS NOA ACTUALIZA EL DE LA VARIABLE SESSION
$sql2 = "SELECT * FROM usuario WHERE idCliente='$idCliente' ";
$res2 = mysqli_query($conexion, $sql2);
if ($row2 = $res2->fetch_assoc()) {
  $rol = $row2['rol'];
}
if ($rol == 0) {
  //ROL: CLIENTE
  //SQL1: CONSULTA PARA EXTRAER IMAGENES E INFO DE TABLA FLETERO
  $sql1 = "SELECT * FROM fletero WHERE idCliente='$idCliente' AND eliminado<1  ";
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
            <div class="col-md-4">
              <div class="card user-card">
                <div class="card-header">
                  <h5>Perfil</h5>
                </div>
                <div class="card-block">
                  <div class="user-image">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                  <p class="text-muted">Active | Male | Born 23.05.1992</p>
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
                        <i class="fa fa-comment"></i>
                        <p>1256</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-user"></i>
                        <p>8562</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-suitcase"></i>
                        <p>189</p>
                      </div>
                    </div>
                  </div>
                  <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  <hr>
                  <div class="row justify-content-center user-social-link">
                    <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card user-card">
                <div class="card-header">
                  <h5>Profile</h5>
                </div>
                <div class="card-block">
                  <div class="user-image">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                  <p class="text-muted">Active | Male | Born 23.05.1992</p>
                  <hr>
                  <p class="text-muted m-t-15">Activity Level: 87%</p>
                  <ul class="list-unstyled activity-leval">
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                  </ul>
                  <div class="bg-c-green counter-block m-t-10 p-20">
                    <div class="row">
                      <div class="col-4">
                        <i class="fa fa-comment"></i>
                        <p>1256</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-user"></i>
                        <p>8562</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-suitcase"></i>
                        <p>189</p>
                      </div>
                    </div>
                  </div>
                  <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  <hr>
                  <div class="row justify-content-center user-social-link">
                    <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card user-card">
                <div class="card-header">
                  <h5>Profile</h5>
                </div>
                <div class="card-block">
                  <div class="user-image">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                  <p class="text-muted">Active | Male | Born 23.05.1992</p>
                  <hr>
                  <p class="text-muted m-t-15">Activity Level: 87%</p>
                  <ul class="list-unstyled activity-leval">
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                  </ul>
                  <div class="bg-c-yellow counter-block m-t-10 p-20">
                    <div class="row">
                      <div class="col-4">
                        <i class="fa fa-comment"></i>
                        <p>1256</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-user"></i>
                        <p>8562</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-suitcase"></i>
                        <p>189</p>
                      </div>
                    </div>
                  </div>
                  <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  <hr>
                  <div class="row justify-content-center user-social-link">
                    <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                    <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
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