<?php
include 'conexion.php';
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: inicioSesion.php');
}

$idCliente = $_SESSION['idCliente'];
//SELECT PARA VERIFICAR ROL POR LAS DUDAS NO ACTUALIZA EL ID DE LA VARIABLE SESSION
$sql2 = "SELECT * FROM usuario WHERE idCliente='$idCliente' ";
$res2 = mysqli_query($conexion, $sql2);
if ($row2 = $res2->fetch_assoc()) {
  $rol = $row2['rol'];
}
if ($rol == 0) {
  //ROL: CLIENTE
} elseif ($rol == 1) {
  //ROL: FLETERO
  //SQL1: CONSULTA PARA EXTRAER IDFLETERO
  $sql1 = "SELECT idFletero FROM fletero WHERE idCliente='$idCliente'";
  $res1 = mysqli_query($conexion, $sql1);
  if ($row1 = $res1->fetch_assoc()) {
    $idFletero = $row1['idFletero'];
  }
  //SQL2: CONSULTA PARA EXTRAER INFORMACIÓN DE TABLA VEHICULOS
  $sql2 = "SELECT * FROM vehiculo WHERE idFletero='$idFletero'";
  $res2 = mysqli_query($conexion, $sql2);
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

  <!-- Preview Imagen -->
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
          <h2>Mis Vehículos <a href="fleteroAgregarVehiculo.php" class="btn btn-success text-end" type="submit" name="nuebo">Nuevo</a></h2>
          <p>Información sobre mis vehículos</p>
        </div>
        <!--CARDS-->
        <div class="card-group mt-3">
          <?php
          $contador = 1;
          while ($row2 = $res2->fetch_assoc()) {
          ?>
            <div class="col md-3">
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $row2['vehiculoVehiculo'] ?>" alt="Vehículo del Fletero">
                <div class="card-body Vehiculo">
                  <h5 class="card-title text-center"><?php echo $contador ?></h5>
                  <?php
                  if ($row2['tipoVehiculo'] == 0) {
                    $tipoVehiculo = "Auto";
                  } elseif ($row2['tipoVehiculo'] == 1) {
                    $tipoVehiculo = "Camioneta";
                  } elseif ($row2['tipoVehiculo'] == 2) {
                    $tipoVehiculo = "Camion";
                  } elseif ($row2['tipoVehiculo'] == 3) {
                    $tipoVehiculo = "Traffic";
                  } elseif ($row2['tipoVehiculo'] == 4) {
                    $tipoVehiculo = "Moto";
                  } elseif ($row2['tipoVehiculo'] == 5) {
                    $tipoVehiculo = "Bicicleta";
                  } else {
                    $tipoVehiculo = " ";
                  }
                  //EXTRAIGO 'idVehiculo' PARA ENVIARLO EN EL BOTON
                  $idVehiculo = $row2['idVehiculo'];
                  ?>
                  <p><b>Tipo:</b> <?php echo $tipoVehiculo ?></p>
                  <p><b>Color:</b> <?php echo $row2['colorVehiculo'] ?></p>
                  <p><b>Descripción:</b> <?php echo $row2['descripcionVehiculo'] ?></p>
                  <div class="col md-3 text-center">
                  <a href="fleteroEditarVehiculo.php?idVehiculo=<?php echo $idVehiculo;?>" class="btn btn-primary w-50" type="submit" name="editar">Editar</a>
                  </div>
                </div>
              </div>
            </div>
          <?php
            $contador++;
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