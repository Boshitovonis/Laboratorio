<?php

require_once __DIR__ . '/../../models/Suelos/fosforo_model.php';

$historial = obtenerHistorialFosforo();

require_once __DIR__ . '/../../view/Suelos/historial_fosforo_view.php';

?>