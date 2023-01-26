<header id="header" class="header fixed-top d-flex align-items-center">
  <!-- ======= ALERTA DE INACTIVIDAD ======= -->
  <?php include("./alerta-sesion.php")?>

  <div class="d-flex align-items-center justify-content-between">
    <a href="inicio.php" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block">FleteAR</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/user.png" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['usuario'];?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $_SESSION['nombreCliente']. " " .$_SESSION['apellidoCliente'];?></h6>
            <span><?php if($_SESSION['rol'] == 2){
              echo "Administrador";
            }else if($_SESSION['rol'] == 1){
              echo "Fletero";
            }else if($_SESSION['rol'] == 0) {
              echo "Cliente";
            }?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="perfil.php">
              <i class="bi bi-person"></i>
              <span>Mi Perfil</span>
            </a>
          </li>
          
          <li>
            <a class="dropdown-item d-flex align-items-center" href="cerrar-sesion.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Salir</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->