<?php
  include ('conexion.php');

  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: inicioSesion.php');
  }

  $error = "";
  $c=0;


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
  


  
    if (isset($_POST['submit']) ) {

        if (!empty($_FILES)) {
            if (isset($_FILES['conductor']) OR isset($_FILES['carnet']) OR isset($_FILES['cedula']) OR isset($_FILES['seguro']) OR isset($_FILES['vehiculo']) OR isset($_FILES['titulo']) OR isset($_POST['tipoVehiculo'])) {
                //IMAGEN CONDUCTOR
                $archivoConductor=$_FILES['conductor']['name'];
                $archivoConductorTemp=$_FILES['conductor']['tmp_name'];
                $rutaConductor="../imagenesFletero/conductor/".$archivoConductor;
                move_uploaded_file($archivoConductorTemp, $rutaConductor);

                //IMAGEN CARNET
                $archivoCarnet=$_FILES['carnet']['name'];
                $archivoCarnetTemp=$_FILES['carnet']['tmp_name'];
                $rutaCarnet="../imagenesFletero/carnet/".$archivoCarnet;
                move_uploaded_file($archivoCarnetTemp, $rutaCarnet);

                //IMAGEN CEDULA
                $archivoCedula=$_FILES['cedula']['name'];
                $archivoCedulaTemp=$_FILES['cedula']['tmp_name'];
                $rutaCedula="../imagenesFletero/cedula/".$archivoCedula;
                move_uploaded_file($archivoCedulaTemp, $rutaCedula);

                //IMAGEN SEGURO
                $archivoSeguro=$_FILES['seguro']['name'];
                $archivoSeguroTemp=$_FILES['seguro']['tmp_name'];
                $rutaSeguro="../imagenesFletero/seguro/".$archivoSeguro;
                move_uploaded_file($archivoSeguroTemp, $rutaSeguro);

                //IMAGEN VEHÍCULO
                $archivoVehiculo=$_FILES['vehiculo']['name'];
                $archivoVehiculoTemp=$_FILES['vehiculo']['tmp_name'];
                $rutaVehiculo="../imagenesFletero/vehiculo/".$archivoVehiculo;
                move_uploaded_file($archivoVehiculoTemp, $rutaVehiculo);

                //IMAGEN TITULO
                $archivoTitulo=$_FILES['titulo']['name'];
                $archivoTituloTemp=$_FILES['titulo']['tmp_name'];
                $rutaTitulo="../imagenesFletero/titulo/".$archivoTitulo;
                move_uploaded_file($archivoTituloTemp, $rutaTitulo);

                //TIPO DE VEHÍCULO: SELECT
                $tipoVehiculo = $_POST['tipoVehiculo'];
                
                //EXTRAIGO idCliente de Variables de sesion
                $idCliente = $_SESSION['idCliente'];
              
                //SQL1: INSERT DATOS PARA FLETERO
                $sql1 = "INSERT INTO fletero(conductor, carnetFletero, cedulaFletero, seguroFletero, vehiculoFletero, tituloFletero, tipoVehiculoFletero, fechaRegFletero, eliminado, idCliente) VALUES('$rutaConductor', '$rutaCarnet', '$rutaCedula', '$rutaSeguro', '$rutaVehiculo', '$rutaTitulo', '$tipoVehiculo', NOW(), '0', '$idCliente' ) ";
                $res1 = mysqli_query($conexion, $sql1);
                if ($res1) {
                ?>
                    <script type="text/javascript">
                        alert('Imagen subida con exito !!');
                    </script>
                <?php
                }else{
                  ?>
                      <script type="text/javascript">
                          alert('NO SE REALIZÓ LA CONSULTA SQL !!');
                      </script>
                  <?php
              }
            }else{
                ?>
                    <script type="text/javascript">
                        alert('Formulario Incompleto !!');
                    </script>
                <?php
            }
        }else{
            ?>
                <script type="text/javascript">
                    alert('Formulario Incompleto !!');
                </script>
            <?php
        }
    }else{
    ?>
        <script type="text/javascript">
            alert('No se transfirio correctamente la imagen ');
        </script>
    <?php
    $c=1;
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
  <?php include("template/header.php")?>

  <!-- ======= Sidebar ======= -->
  <?php  if($_SESSION['rol'] == 1){
      include ("template/admin-nav.php");
    }else{
      include ("template/cliente-nav.php");
    }
  ?>

  <main id="main" class="main">
  
    

    <section class="section dashboard">
    <div class="container">
        <div class="card mb-3 pb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Registrá tu vehículo</h5>
              <p class="text-center small">Ingrese su información de su vehículo en el formulario</p>
            </div>

            <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>

              <div class="col-4">
                <label for="conductor" class="form-label">Foto del Conductor</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="conductor" id="conductor" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="Foto del conductor">
              </div>
              <div class="col-4">
                <label for="carnet" class="form-label">Foto de Carnet de Conducir</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="carnet" id="carnet" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="carnet">
              </div>
              <div class="col-4">
                <label for="cedula" class="form-label">Foto de la Cedula</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="cedula" id="cedula" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="cedula">
              </div>
              <div class="col-4">
                <label for="seguro" class="form-label">Foto del Seguro</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="seguro" id="seguro" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="seguro">
              </div>
              <div class="col-4">
                <label for="vehiculo" class="form-label">Foto del Vehículo</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="vehiculo" id="vehiculo" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="vehiculo">
              </div>
              <div class="col-4">
                <label for="titulo" class="form-label">Foto del Titulo del Vehículo</label>
                <div class="input-group has-validation">
                  <input class="form-control" maxlength="256" placeholder="Imagen" name="titulo" id="titulo" type="file" accept="image/jpeg, image/gif, image/png" />
                  <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                  <div class="invalid-feedback">Subir archivo</div>
                </div>
                <img src="" width="150px" height="120px" id="imagenmuestra" alt="titulo">
              </div>
              <div class="col-4 offset-3">
                      <label for="tipoVehiculo" class="form-label">Tipo de Vehículo</label>
                      <select require name="tipoVehiculo" id="tipoVehiculo" class="form-select">
                      <option value="">Seleccionar</option>
                      <option value="0">Auto</option>
                      <option value="1">Camioneta</option>
                      <option value="2">Camion</option>
                      <option value="2">Traffic</option>
                      <option value="2">Moto</option>
                      <option value="2">Bicicleta</option>
                      </select>
                      <div class="invalid-feedback">Ingrese su sexo.</div>
                </div>
              

              <div class="col-12 d-flex align-items-center justify-content-center">
                <div style='color:red'>
                  <?php
                 
                    echo $error;
                  ?> 
                  </div>
              </div>
              <div class="col-12 d-flex align-items-center justify-content-center">
                <button class="btn btn-primary w-50" type="submit" name="submit">Registrar Vehículo</button>
              </div>
            </form>

          </div>
        </div>
      </div>
  </main><!-- End #main -->
  <script>
  //FUNCIÓN PREVISUALIZAR UNA IMAGEN LUEGO DE CARGARLA / ANTES DE SUBIRLA
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          // Asignamos el atributo src a la tag de imagen
          $('#imagenmuestra').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    // El listener va asignado al input
    $("#imagen").change(function() {
      readURL(this);
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