<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Previsualizar imagen</title>
</head>

<body>
	<h1>Previsualización de imagen</h1>
    <!-- El input para seleccionar los archivos, fíjate en su id -->
    <input type="file" id="seleccionArchivos" accept="image/*">
    <br><br>
    <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
    <img id="imagenPrevisualizacion">
    <script src="script.js"></script>
  </body>

  <script>
    // Obtener referencia al input y a la imagen

const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

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
  </script>
</html>