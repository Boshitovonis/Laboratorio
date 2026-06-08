<?php

require_once __DIR__ . '/../../models/Suelos/azufre_model.php';

$id_azufre = $_GET['id'];

$datos_curva = obtenerCurvaAzufre($id_azufre);

require_once __DIR__ . '/../../view/graficas/curva_view.php';

?>