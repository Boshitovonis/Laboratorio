<?php

require_once __DIR__ . '/../../models/Suelos/boro_model.php';

$id_boro = $_GET['id'];

$datos_curva = obtenerCurvaBoro($id_boro);

require_once __DIR__ . '/../../view/graficas/curva_view.php';

?>