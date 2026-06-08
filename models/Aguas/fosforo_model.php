<?php

require_once __DIR__ . '/../conexion.php';
$conexion = new Conexion();
$conn = $conexion->conectar();

// GUARDAR ANÁLISIS DE FÓSFORO
function guardarFosforo($abs_blanco, $absorbancia, $ppm_sol, $ppm_p) {

    global $conn;

    $stmt = $conn->prepare(
        "INSERT INTO fosforo_ag
        (abs_blanco, absorbancia, ppm_sol, ppm_p)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "dddd",
        $abs_blanco,
        $absorbancia,
        $ppm_sol,
        $ppm_p
    );

    if ($stmt->execute()) {

        return [
            "exito" => true,
            "mensaje" => "Fósforo guardado correctamente.",
            "id" => $conn->insert_id
        ];

    } else {

        return [
            "exito" => false,
            "mensaje" => "Error al guardar: " . $stmt->error
        ];
    }
}

// GUARDAR PUNTO DE CURVA
function guardarCurvaFosforo($punto_curva, $absorbancia) {

    global $conn;

    $stmt = $conn->prepare(
        "INSERT INTO curva_fosforo_ag
        (punto_curva, absorbancia)
        VALUES (?, ?)"
    );

    $stmt->bind_param(
        "dd",
        $punto_curva,
        $absorbancia
    );

    if ($stmt->execute()) {

        return $conn->insert_id;

    } else {

        return false;
    }
}
// RELACIONAR Fósforo↔ CURVA
function relacionarFosforoCurva($id_fosforo, $id_curva) {

    global $conn;

    $stmt = $conn->prepare(
        "INSERT INTO fosforo_curva_ag
        (id_fosforo_ag, id_curva_fosforo_ag)
        VALUES (?, ?)"
    );

    $stmt->bind_param(
        "ii",
        $id_fosforo,
        $id_curva
    );

    return $stmt->execute();
}

function obtenerCurvaFosforo($id_fosforo) {

    global $conn;

    $sql = "
        SELECT
            cag.punto_curva,
            cag.absorbancia
        FROM curva_fosforo_ag cag

        INNER JOIN fosforo_curva_ag agc
            ON cag.id_curva = agc.id_curva_fosforo_ag

        WHERE agc.id_fosforo_ag = ?
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id_fosforo);

    $stmt->execute();

    $resultado = $stmt->get_result();

    return $resultado->fetch_all(MYSQLI_ASSOC);
}

function obtenerHistorialFosforo() {

    global $conn;

    $sql = "
        SELECT
            id,
            abs_blanco,
            absorbancia,
            ppm_sol,
            ppm_p
        FROM fosforo_ag

        ORDER BY id DESC
    ";

    $resultado = $conn->query($sql);

    return $resultado->fetch_all(MYSQLI_ASSOC);
}
?>