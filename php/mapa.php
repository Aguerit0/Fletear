<?php
include 'conexion.php';
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: inicioSesion.php');
}

$idCliente = $_SESSION['idCliente'];



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

  <!-- SCRIPTS JS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="peticion.js"></script>

  <link href="assets/css/style.css" rel="stylesheet">

  <!-- SCRIPT PASAR LAT Y LONG A INPUTS-->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
  </script>

  <style>
    #map {
        height: 50%;
        width: auto;
      }
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #searchMap {
        width: 40%;
        height: 40px;
        border-color: black;
        font-size: 20px;
      }
      #buttonMyUbi {
        width: 15%;
        height: auto;
        margin-left: 10px;
        cursor: pointer;
      }
  </style>

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
      
    <input type="text" id="searchMap" placeholder="Ingresa una Ubicación" />
  <div id="map"></div>
  <div class="row">
    <div class="col-6">
      <h3>Datos de SALIDA</h3>
      <label for="latitud">
        Latitud:  
      </label>
      <input type="text" id="latitudSalida" style="color:green" value="0"><br>
      <label for="longitud">
        Longitud:
      </label>
      <input type="text" id="longitudSalida" style="color:green" value="0">
    </div>  
    <div class="col-6">
      <h3>Datos de LLEGADA</h3>
      <label for="latitud">
        Latitud:
      </label>
      <input type="text" id="latitudLlegada" style="color:red" value="-28.46957"><br>
      <label for="longitud">
        Longitud:
      </label>
      <input type="text" id="longitudLlegada" style="color:red" value="-65.78524">
    </div>
  </div>
  
  
  
  

    </section><!-- End Resume Section -->
  </main><!-- End #main -->


<!-- SCRIPT API KEY GOOGLE MAPS API -->
<script
    async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyrhhTAE5dCjUWQ9hO9G3GHA85F5k2awY&libraries=places&callback=initMap">
</script>

<!-- SCRIPT BACK API GOOGLE MAPS -->
<script>
//FUNCIÓN INICIAR MAPA



</script>

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