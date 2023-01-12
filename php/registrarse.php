<?php
  require_once "conexion.php";
  $error = "";//variable para almacenar error
  if (isset($_POST['submit'])){
    if (!isset($_POST['usuario']) && !isset($_POST['password']) && !isset($_POST['nombre']) && !isset($_POST['apellido']) && !isset($_POST['correo']) && !isset($_POST['dni']) && !isset($_POST['domicilio']) && !isset($_POST['telefono']) && !isset($_POST['fechaNac']) && !isset($_POST['sexo']))
    {
      $error = "Debe completar todos los campos del formulario.";
    }else{
      // CREAMOS USUARIO Y CONTRASEÑA
      $usuario = $_POST['usuario'];
      $contraseña = $_POST['contraseña'];
      $rol=0;//rol=0 -> cliente
      $eliminado=0;//eliminado=0 -> activo

      //CREAMOS DATOS DEL USUARIO
        $nombreCliente = $_POST['nombre'];
        $apellidoCliente = $_POST['apellido'];
        $correoCliente = $_POST['correo'];
        $dniCliente = $_POST['dni'];
        $domicilioCliente = $_POST['domicilio'];
        $telefonoCliente = $_POST['telefono'];
        $fechaNacCliente = $_POST['fechaNac'];
        $sexoCliente = $_POST['sexo'];
        $eliminadoCliente = 0;


        // VERIFICO QUE NO EXISTA PERSONA CON MISMO DNI
        $sql3 = "SELECT * FROM cliente WHERE dniCliente=$dniCliente";
        $res3 = mysqli_query($conexion, $sql3);
        if (mysqli_num_rows($res3)>0) {
            
            header('location: registrarse.php');
        }else{


          //SQL1: INSERTAR CLIENTE
        $sql1 = "INSERT INTO cliente(nombreCliente, apellidoCliente, correoCliente, dniCliente, domicilioCliente, telefonoCliente, fechaNacCliente, sexoCliente, fechaRegCliente, eliminado) VALUES('$nombreCliente', '$apellidoCliente', '$correoCliente', '$dniCliente', '$domicilioCliente', '$telefonoCliente', '$fechaNacCliente', '$sexoCliente', NOW(), '$eliminadoCliente' )";
        $res1 = mysqli_query($conexion, $sql1);

        //SQL2: OBTENEMOS idCLiente PARA TABLA USUARIO
        $sql2 = "SELECT idCliente FROM cliente ORDER BY idCliente DESC LIMIT 1";
        $res2 = mysqli_query($conexion,$sql2);
        if($row2 = $res2->fetch_assoc()){
          $idCliente = $row2['idCliente'];
        }
        //SQL3: INSERTAR USUARIO
        $sql3 = "INSERT INTO usuario(usuario, contraseña, rol, eliminado, idCliente) VALUES('$usuario', '$contraseña', '$rol', '$eliminado', '$idCliente' )";
        $res3 = mysqli_query($conexion,$sql3);
        $var = "Registro Exitoso !!";
        echo "<script> alert('".$var."');</script>";
        sleep(3);
        header('location: inicioSesion.php');
        }
    }
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
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">

                  <span class="d-none d-lg-block">FleteAR</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 pb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Registrarse</h5>
                    <p class="text-center small">Ingrese su información personal en el formulario</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-6">
                      <label for="yourUsername" class="form-label">Nombre</label>
                      <div class="input-group has-validation">
                        <input type="text" name="nombre" class="form-control" id="nombre" required placeholder="example">
                        <div class="invalid-feedback">Ingrese su nombre</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <label for="apellido" class="form-label">Apellido</label>
                      <input type="text" name="apellido" class="form-control" id="apellido" required placeholder="example">
                      <div class="invalid-feedback">Ingrese su apellido.</div>
                    </div>
                    <div class="col-6">
                      <label for="usuario" class="form-label">Usuario</label>
                      <input type="text" name="usuario" class="form-control" id="usuario" required placeholder="user">
                      <div class="invalid-feedback">Ingrese su usuario.</div>
                    </div>
                    <div class="col-6">
                      <label for="contraseña" class="form-label">Contraseña</label>
                      <input type="password" name="contraseña" class="form-control" id="contraseña" required placeholder="**********">
                      <div class="invalid-feedback">Ingrese su contraseña.</div>
                    </div>
                    <div class="col-6">
                      <label for="correo" class="form-label">Correo Electronico</label>
                      <input type="mail" name="correo" class="form-control" id="correo" required placeholder="example@example.com">
                      <div class="invalid-feedback">Ingrese su correo.</div>
                    </div>
                    <div class="col-6">
                      <label for="dni" class="form-label">DNI</label>
                      <input type="number" name="dni" class="form-control" id="dni" required placeholder="11111111">
                      <div class="invalid-feedback">Ingrese su dni.</div>
                    </div>
                    <div class="col-6">
                      <label for="domicilio" class="form-label">Domicilio</label>
                      <input type="text" name="domicilio" class="form-control" id="domicilio" required placeholder="">
                      <div class="invalid-feedback">Ingrese su domicilio.</div>
                    </div>
                    <div class="col-6">
                      <label for="telefono" class="form-label">Telefono</label>
                      <input type="number" name="telefono" class="form-control" id="telefono" required placeholder="+54 XXXX XXXXXX">
                      <div class="invalid-feedback">Ingrese su telefono.</div>
                    </div>
                    <div class="col-6">
                      <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                      <input type="date" name="fechaNac" class="form-control" id="fechaNac" required>
                      <div class="invalid-feedback">Ingrese su fecha de nacimiento.</div>
                    </div>
                    <div class="col-6">
                      <label for="sexo" class="form-label">Sexo</label>
                      <select require name="sexo" id="sexo" class="form-select">
                      <option value="">Seleccionar</option>
                      <option value="0">Hombre</option>
                      <option value="1">Mujer</option>
                      <option value="2">No Binario</option>
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
                      <button class="btn btn-primary w-50" type="submit" name="submit">Registrarse</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

    </section>

    </div>
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