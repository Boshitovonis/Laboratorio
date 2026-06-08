<?php
require_once __DIR__ . '/../../models/conexion.php';
require_once __DIR__ . '/../../models/Aguas/resistividad_model.php';

$conexion = new Conexion();
$conn = $conexion->conectar();

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lectura_resistividad = (float) $_POST['lectura_resistividad'];

    $resultado = guardarResistividad($lectura_resistividad);

}

require_once __DIR__ . '/../../view/Aguas/resistividad_view.php';
?>
