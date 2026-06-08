<?php

require_once __DIR__ . '/../../models/Foliares/fosforo_model.php';

$historial = obtenerHistorialFosforo();

require_once __DIR__ . '/../../view/Foliares/historial_fosforo_view.php';

?>