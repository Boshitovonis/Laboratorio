<?php
require_once __DIR__ . '/../config/env.php';

class Conexion {

    public function conectar() {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: '3306';
        $name = getenv('DB_NAME') ?: 'ccpmp';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASSWORD') ?: '';

        $conn = new mysqli($host, $user, $pass, $name, $port);

        if ($conn->connect_error) {
            die('Error de conexión: ' . $conn->connect_error);
        }

        $conn->set_charset('utf8');

        return $conn;
    }
}
?>