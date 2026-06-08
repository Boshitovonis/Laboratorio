<?php

require_once __DIR__ . '/../../models/Foliares/fosforo_model.php';

$id_fosforo = $_GET['id'];

$datos_curva = obtenerCurvaFosforo($id_fosforo);

require_once __DIR__ . '/../../view/graficas/curva_view.php';

?>