<?php
  require_once "conexion.php";
  //si es necesario cambiar la config. del php.ini desde tu script
  ini_set("session.use_only_cookies","1");
  ini_set("session.use_trans_sid","0");
  
  session_start();
  $error = ""; //variable para almacenar error
  if(isset($_SESSION['usuario'])){
    header('Location: inicio.php');
  }
  if (isset($_POST['submit'])){
    if (!isset($_POST['usuario']) && !isset($_POST['contraseña']))
    {
      $error = "Usuario o Contraseña invalidos";
    }else{
      // DEFINE USUSARIO Y Contraseña
      $usuario = $_POST['usuario'];
      $contraseña = $_POST['contraseña'];

      //SQL1: SELECT COMPROBAR QUE EXISTA USUARIO
      $sql1 = "SELECT * FROM usuario WHERE usuario='$usuario' AND contraseña='$contraseña' ";
      $res1 = mysqli_query($conexion,$sql1);
      if($row1 = $res1->fetch_assoc()){
        //DECLARO VARIABLES DE SESSION
        $_SESSION['usuario']=$row1['usuario'];
        $_SESSION['rol']=$row1['rol'];
        $_SESSION['idCliente']=$row1['idCliente'];
        $idCliente = $_SESSION['idCliente'];

        //SQL2: SELECT CLIENTE PARA VARIABLES DE SESSON
        $sql2 = "SELECT * FROM cliente WHERE idCliente=$idCliente ";
        $res2 = mysqli_query($conexion,$sql2);
        if($row2 = $res2->fetch_assoc()){
        //DECLARO VARIABLES DE SESSION
          $_SESSION['nombreCliente']=$row2['nombreCliente'];
          $_SESSION['apellidoCliente']=$row2['apellidoCliente'];  
        }
      }else{
        $error = "Usuario o contraseñar invalidos";
      }
        header('Location: inicio.php');
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
            <div class="col-lg-4 col-md-9 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">

                  <span class="d-none d-lg-block">FleteAR</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 pb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingrese a su Cuenta</h5>
                    <p class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-12">
                      <label for="usuario" class="form-label">Usuario</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usuario" class="form-control" id="usuario" required>
                        <div class="invalid-feedback">Por favor, introduzca su nombre de usuario.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="contraseña" class="form-label">Contraseña</label>
                      <input type="password" name="contraseña" class="form-control" id="contraseña" required>
                      <div class="invalid-feedback">Por favor, introduzca su contraseña.</div>
                    </div>

                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <div style='color:red'>
                        <?php
                       
                          echo $error;
                        ?> 
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <button class="btn btn-primary w-50" type="submit" name="submit">Ingresar</button>
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