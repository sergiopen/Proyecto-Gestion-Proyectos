<?php
require_once ABSPATH . 'config.php';

function conexionBD() {
    $conexion = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_TABLENAME);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}

?>