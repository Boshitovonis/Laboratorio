<?php

require_once("models/conexion.php");

$conn = conexion::conectar();

$sql = "SELECT * FROM tipo_muestra";

$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Seleccionar formulario — AgroLab</title>
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>

<h1>Seleccione tipo de muestra</h1>

<?php while($fila = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>

    <a href="labc_solicitud_formulario.php?tipo=<?php echo $fila['id_tipo']; ?>">

        <?php echo $fila['nombre']; ?>

    </a>

    <br><br>

<?php } ?>

</body>
</html>
