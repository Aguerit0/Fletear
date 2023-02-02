<?php
include('conexion.php');
//////////////// VALORES INICIALES ///////////////////////

$tabla = "";
$query = "SELECT * FROM cliente c INNER JOIN fletero f WHERE (c.idCliente=f.idCliente) AND (c.eliminadoCliente<1) AND (f.eliminadoFletero<1) ORDER BY f.puntajeFletero DESC";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if (isset($_POST['fletero'])) {
  $q = $conexion->real_escape_string($_POST['fletero']);
  $query = "SELECT * FROM cliente c INNER JOIN fletero f WHERE c.nombreCliente LIKE '%" . $q . "%' OR c.apellidoCliente LIKE '%" . $q . "%' ORDER BY f.puntajeFletero DESC";
}

$buscarFletero = $conexion->query($query);
if ($buscarFletero->num_rows > 0) {
  //AQUÍ VAN LOS VALORES DESPUES DE HABER BUSCADO

  while ($row1 = $buscarFletero->fetch_assoc()) {
?>
    <div class="col-md-4">
      <div class="card user-card">
        <?php if ($row1['eliminadoFletero'] == 0) {
          $eliminadoCliente = "EN LINEA";
        } else {
          $eliminadoCliente = "INACTIVO";
        }
        $sexoCliente = $row1['sexoCliente'];
        if ($sexoCliente == 0) {
          $sexoCliente = 'Hombre';
        } elseif ($sexoCliente == 1) {
          $sexoCliente = 'Mujer';
        } else {
          $sexoCliente = 'No Binario';
        }
        ?>
        <div class="card-header">
          <p class="text"><i class="fa fa-circle" style="<?php if ($row1['actividadFletero'] == 1) { ?>color: green;<?php echo " ";
                                                                                                              } else if ($row1['actividadFletero'] == 0) { ?>color: red;<?php echo " ";
                                                                                                                                                                                  } ?>"> </i><?php if ($row1['actividadFletero'] == 1) {
                                                                                                                                                                                                                echo " ON";
                                                                                                                                                                                                              } else if ($row1['actividadFletero'] == 0) {
                                                                                                                                                                                                                echo " OFF";
                                                                                                                                                                                                              }; ?></p>
        </div>
        <div class="card-block">
          <div class="user-image">
            <img src="<?php echo $row1['imagenFletero'] ?>" class="img-radius" alt="imagen fletero">
          </div>
          <h6 class="f-w-600 m-t-25 m-b-10"><?php echo $row1['apellidoCliente'] . " " . $row1['nombreCliente'] ?></h6>
          <hr>
          <div class="row">
            <div class="col-2">
              <div class="row">
                <p><i class="fa fa-car"> <?php echo $row1['cantidadVehiculosFletero'] ?></i><!-- CANT VEHICULOS --></p>
              </div>
              <div class="row">
                <p><i class="fa fa-road"> <?php echo $row1['cantidadViajesFletero'] ?></i><!-- CANT VIAJES --></p>
              </div>
              <div class="row">
                <p><i class="fa fa-star"> <?php echo $row1['puntajeFletero'] ?></i><!-- CANT PUNTAJE --></p>
              </div>
            </div>

            <div class="col-10">
              <h5 class="text-tittle text-center">Descripción</h5>
              <p class="text"><?php echo $row1['descripcionFletero']; ?></p>
            </div>
          </div>
          <hr>
          <div class="row justify-content-center user-social-link">
            <a href="#" class="btn btn-outline-success w-50" type="submit" name="contratar">Contratar</a>
          </div>
        </div>
      </div>
    </div>
<?php
  }
} else {
  $tabla = "No se encontraron coincidencias con sus criterios de búsqueda.";
}


echo $tabla;
?>