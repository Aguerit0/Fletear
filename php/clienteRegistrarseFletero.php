<?php
include('conexion.php');

session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: inicioSesion.php');
}

$error = "";
$c = 0;


//AUTOMATIZAR SUBIDA DE IMAGENES
/* $vec=['conductor', 'carnet', 'cedula', 'seguro', 'vehiculo', 'titulo'];
  for ($i=0; $i < sizeof($vec); $i++) { 
    //CARGA DE IMAGENES
    $nombreArchivo=$_FILES[$vec[$i]]['name'];
    $archivo=$_FILES[$vec[$i]]['tmp_name'];
    $ruta="../imagenesFletero/".$vec[$i]."/".$nombreArchivo;
    move_uploaded_file($archivo, $ruta);  
  }
  

  $sql1 = "INSERT INTO fletero($) VALUES('$ruta') ";
  $res1 = mysqli_query($conexion, $sql1);
  if ($res1) {
  ?>
      <script type="text/javascript">
          alert('Imagen subida con exito !!');
      </script>
  <?php
  } */




if (isset($_POST['submit'])) {
  $contador = 0;
  if (!empty($_FILES)) {
    if (isset($_FILES['imagenFletero']) or isset($_FILES['carnetFletero']) or isset($_FILES['cedulaFletero']) or isset($_POST['descripcionFletero']) or isset($_FILES['vehiculoVehiculo']) or isset($_FILES['tituloVehiculo']) or isset($_FILES['seguroVehiculo']) or isset($_POST['tipoVehiculo']) or isset($_POST['colorVehiculo']) or isset($_POST['descripcionVehiculo'])) {
      //IMAGEN CONDUCTOR
      $archivoConductor = $_FILES['imagenFletero']['name'];
      $archivoConductorTemp = $_FILES['imagenFletero']['tmp_name'];
      $rutaConductor = "../imagenesFletero/imagenFletero/" . $archivoConductor;
      move_uploaded_file($archivoConductorTemp, $rutaConductor);

      //IMAGEN CARNET
      $archivoCarnet = $_FILES['carnetFletero']['name'];
      $archivoCarnetTemp = $_FILES['carnetFletero']['tmp_name'];
      $rutaCarnet = "../imagenesFletero/carnetFletero/" . $archivoCarnet;
      move_uploaded_file($archivoCarnetTemp, $rutaCarnet);

      //IMAGEN CEDULA
      $archivoCedula = $_FILES['cedulaFletero']['name'];
      $archivoCedulaTemp = $_FILES['cedulaFletero']['tmp_name'];
      $rutaCedula = "../imagenesFletero/cedulaFletero/" . $archivoCedula;
      move_uploaded_file($archivoCedulaTemp, $rutaCedula);

      //IMAGEN VEHÍCULO
      $archivoVehiculo = $_FILES['vehiculoVehiculo']['name'];
      $archivoVehiculoTemp = $_FILES['vehiculoVehiculo']['tmp_name'];
      $rutaVehiculo = "../imagenesFletero/vehiculoVehiculo/" . $archivoVehiculo;
      move_uploaded_file($archivoVehiculoTemp, $rutaVehiculo);

      //IMAGEN SEGURO
      $archivoSeguro = $_FILES['seguroVehiculo']['name'];
      $archivoSeguroTemp = $_FILES['seguroVehiculo']['tmp_name'];
      $rutaSeguro = "../imagenesFletero/seguroVehiculo/" . $archivoSeguro;
      move_uploaded_file($archivoSeguroTemp, $rutaSeguro);

      //IMAGEN TITULO
      $archivoTitulo = $_FILES['tituloVehiculo']['name'];
      $archivoTituloTemp = $_FILES['tituloVehiculo']['tmp_name'];
      $rutaTitulo = "../imagenesFletero/tituloVehiculo/" . $archivoTitulo;
      move_uploaded_file($archivoTituloTemp, $rutaTitulo);

      //TIPO DE VEHÍCULO: SELECT
      $tipoVehiculo = $_POST['tipoVehiculo'];

      //COLOR VEHICULO
      $colorVehiculo = $_POST['colorVehiculo'];

      //DESCRIPCIONES
      $descripcionFletero = $_POST['descripcionFletero'];
      $descripcionVehiculo = $_POST['descripcionVehiculo'];

      //DESCRIPCIÓN VEHICULO

      //EXTRAIGO idCliente de Variables de sesion
      $idCliente = $_SESSION['idCliente'];

      //SQL1: INSERT DATOS PARA TABLA FLETERO
      $sql1 = "INSERT INTO fletero(imagenFletero, descripcionFletero, carnetFletero, cedulaFletero, cantidadVehiculosFletero, fechaRegFletero, eliminadoFletero, idCliente) VALUES('$rutaConductor', '$descripcionFletero', '$rutaCarnet', '$rutaCedula', 1, NOW(), 0, '$idCliente' ) ";
      $res1 = mysqli_query($conexion, $sql1);

      //SI LA CARGA FUÉ EXITOSA, EL CLIENTE PASA A SER FLETERO
      if ($res1) {
        //POR LO TANTO UPDATE A LA TABLA USUARIO CAMBIANDOLE EL ROL
        //SQL2: UPDATE CAMBIO DE ROL TABLA CLIENTES
        $slq2 = "UPDATE usuario SET rol='1' WHERE idCliente='$idCliente' ";
        $res2 = mysqli_query($conexion, $slq2);
?>
        <script type="text/javascript">
          alert('Imagen subida con exito !!');
        </script>
      <?php
        header('location: inicio.php');//
      } else {
      ?>
        <script type="text/javascript">
          alert('NO SE REALIZÓ LA CONSULTA SQL !!');
        </script>
      <?php
      }
      //SQL4: SELECT PARA EXTRAER ID DE FLETERO ACTUAL
      $sql4 = "SELECT idFletero WHERE (idCliente='$idCliente') AND (eliminadoFletero<1)";
      $res4 = mysqli_query($conexion, $sql4);
      if ($row4 = $res4->fetch_assoc()) {
        $idFletero = $row4['idFletero'];
      }
      //SQL3: INSERT DATOS PARA TABLA VEHICULO
      $sql3 = "INSERT INTO vehiculo(vehiculoVehiculo, seguroVehiculo, tituloVehiculo, tipoVehiculo, colorVehiculo, descripcionVehiculo, fechaRegVehiculo, eliminadoVehiculo, idFletero) VALUES('$rutaVehiculo', '$rutaSeguro', '$rutaTitulo', '$tipoVehiculo', '$colorVehiculo', '$descripcionVehiculo', NOW(), 0, '$idFletero') ";
      $res3 = mysqli_query($conexion, $sql3);
    } else {
      ?>
      <script type="text/javascript">
        alert('Formulario Incompleto !!');
      </script>
    <?php
    }
  } else {
    ?>
    <script type="text/javascript">
      alert('Formulario Incompleto !!');
    </script>
  <?php
  }
} else {
  ?>
  <script type="text/javascript">
    //alert('No se transfirio correctamente la imagen ');
  </script>
<?php
  $c = 1;
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

    <section class="section dashboard">
      <div class="container">
        <div class="card mb-3 pb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Conductor</h5>
              <p class="text-center small">Ingrese la información solicitada del conductor </p>
            </div>

            <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
              <!--DATOS DEL CONDUCTOR-->
              <div class="col-6">
                <label for="imagenFletero" class="form-label">Foto del Conductor</label>
                <div class="profile-img">
                  <img src="../img/imgPerfil.png" alt="imagenFleteroPrev" id="imagenFleteroPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input require type="file" name="imagenFletero" id="imagenFletero" accept="image/*" />
                  </div>
                </div>
              </div>

              <div class="col-6">
                <label for="carnetFletero" class="form-label">Carnet de Conducir</label>
                <div class="cuadrado-img">
                  <img src="../img/imgCarnet.png" alt="carnetFleteroPrev" id="carnetFleteroPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input require type="file" name="carnetFletero" id="carnetFletero" accept="image/*" />
                  </div>
                </div>
              </div>

              <div class="col-4">
                <label for="descripcionFletero" class="form-label">Descripción del Conductor</label>
                <div class="input-group has-validation">
                  <input require type="text" class="form-control" name="descripcionFletero" id="descripcionFletero">
                  <div class="invalid-feedback">Ingrese una descripcion</div>
                </div>
              </div>
              <div class="col-2"></div>

              <div class="col-6">
                <label for="cedulaFletero" class="form-label">Cedula de Conductor</label>
                <div class="cuadrado-img">
                  <img src="../img/imgCarnet.png" alt="cedulaFleteroPrev" id="cedulaFleteroPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input require type="file" name="cedulaFletero" id="cedulaFletero" accept="image/*" />
                  </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
              </div>

              <!--DATOS DEL VEHICULO-->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Registrá tu vehículo</h5>
                <p class="text-center small">Ingrese su información de su vehículo en el formulario</p>
              </div>

              <div class="col-4">
                <label for="vehiculoVehiculo" class="form-label">Foto del Vehiculo</label>
                <div class="vehiculo-img">
                  <img src="../img/imgVehiculo.png" alt="vehiculoVehiculoPrev" id="vehiculoVehiculoPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input require type="file" name="vehiculoVehiculo" id="vehiculoVehiculo" accept="image/*" />
                  </div>
                </div>
              </div>
              <div class="col-4">
                <label for="seguroVehiculo" class="form-label">Seguro del Vehiculo</label>
                <div class="vehiculo-img">
                  <img src="../img/imgTitulo.png" alt="seguroVehiculoPrev" id="seguroVehiculoPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input require type="file" name="seguroVehiculo" id="seguroVehiculo" accept="image/*" />
                  </div>
                </div>
              </div>
              <div class="col-4">
                <label for="tituloVehiculo" class="form-label">Titulo del Vehiculo</label>
                <div class="vehiculo-img">
                  <img src="../img/imgTitulo.png" alt="tituloVehiculoPrev" id="tituloVehiculoPrev" />
                  <div class="file btn btn-lg btn-primary">
                    Subir Imagen
                    <input type="file" name="tituloVehiculo" id="tituloVehiculo" accept="image/*" />
                  </div>
                </div>
              </div>





              <div class="col-4">
                <label for="tipoVehiculo" class="form-label">Tipo de Vehículo</label>
                <select require name="tipoVehiculo" id="tipoVehiculo" class="form-select">
                  <option value="">Seleccionar</option>
                  <option value="0">Auto</option>
                  <option value="1">Camioneta</option>
                  <option value="2">Camion</option>
                  <option value="3">Traffic</option>
                  <option value="4">Moto</option>
                  <option value="5">Bicicleta</option>
                </select>
                <div class="invalid-feedback">Ingrese su sexo.</div>
              </div>
              <div class="col-4">
                <label for="colorVehiculo" class="form-label">Color del Vehículo</label>
                <div class="input-group has-validation">
                  <input require type="text" class="form-control" name="colorVehiculo" id="colorVehiculo">
                  <div class="invalid-feedback">Ingrese el color</div>
                </div>
              </div>
              <div class="col-4">
                <label for="descripcionVehiculo" class="form-label">Descripción del Vehículo</label>
                <div class="input-group has-validation">
                  <input require type="text" class="form-control" name="descripcionVehiculo" id="descripcionVehiculo">
                  <div class="invalid-feedback">Ingrese una descripcion</div>
                </div>
              </div>
              <div class="col-12 d-flex align-items-center justify-content-center">
                <div style='color:red'>
                  <?php
                  echo $error;
                  ?>
                </div>
              </div>
              <div class="col-12 d-flex align-items-center justify-content-center">
                <button class="btn btn-primary w-50" type="submit" name="submit">Registrar Información</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <script>
    // Obtener referencia al input y a la imagen
    const $seleccionArchivos = document.querySelector("#imagenFletero"),
      $imagenPrevisualizacion = document.querySelector("#imagenFleteroPrev");

    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivos.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacion.src = objectURL;
    });


    // Obtener referencia al input y a la imagen
    const $seleccionArchivosCarnet = document.querySelector("#carnetFletero"),
      $imagenPrevisualizacionCarnet = document.querySelector("#carnetFleteroPrev");

    // Escuchar cuando cambie
    $seleccionArchivosCarnet.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivosCarnet.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacionCarnet.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacionCarnet.src = objectURL;
    });

    // Obtener referencia al input y a la imagen
    const $seleccionArchivosCedula = document.querySelector("#cedulaFletero"),
      $imagenPrevisualizacionCedula = document.querySelector("#cedulaFleteroPrev");

    // Escuchar cuando cambie
    $seleccionArchivosCedula.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivosCedula.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacionCedula.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacionCedula.src = objectURL;
    });

    // Obtener referencia al input y a la imagen
    const $seleccionArchivosVehiculo = document.querySelector("#vehiculoVehiculo"),
      $imagenPrevisualizacionVehiculo = document.querySelector("#vehiculoVehiculoPrev");

    // Escuchar cuando cambie
    $seleccionArchivosVehiculo.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivosVehiculo.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacionVehiculo.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacionVehiculo.src = objectURL;
    });

    // Obtener referencia al input y a la imagen
    const $seleccionArchivosSeguro = document.querySelector("#seguroVehiculo"),
      $imagenPrevisualizacionSeguro = document.querySelector("#seguroVehiculoPrev");

    // Escuchar cuando cambie
    $seleccionArchivosSeguro.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivosSeguro.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacionSeguro.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacionSeguro.src = objectURL;
    });

    // Obtener referencia al input y a la imagen
    const $seleccionArchivosTitulo = document.querySelector("#tituloVehiculo"),
      $imagenPrevisualizacionTitulo = document.querySelector("#tituloVehiculoPrev");

    // Escuchar cuando cambie
    $seleccionArchivosTitulo.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivosTitulo.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
        $imagenPrevisualizacionTitulo.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacionTitulo.src = objectURL;
    });
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