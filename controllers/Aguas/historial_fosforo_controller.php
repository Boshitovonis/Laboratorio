<?php

require_once __DIR__ . '/../../models/Aguas/fosforo_model.php';

$historial = obtenerHistorialFosforo();

require_once __DIR__ . '/../../view/Aguas/historial_fosforo_view.php';

?>