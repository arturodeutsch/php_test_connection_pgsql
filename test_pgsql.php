<?php
// Comprobar si el módulo php-pgsql está instalado
if (!extension_loaded('pgsql')) {
    die("El módulo php-pgsql no existe.<br>");
}

// Datos de la conexión
$host = "localhost";
$port = 5432;
$dbname = "nombre_de_tu_bd";
$user = "tu_usuario";
$password = "tu_contraseña";

try {
    // Intentar conectar a la base de datos
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    // Comprobar si la conexión fue exitosa
    if (!$conn) {
        throw new Exception("Error al conectar a la base de datos: " . pg_last_error());
    } else {
        echo "Conexión a PostgreSQL exitosa.<br>";

        // Obtener la versión de PostgreSQL
        $version = pg_version($conn);
        echo "Versión de PostgreSQL: " . $version['server'] . "<br>";

        // Obtener la versión de Apache
        if (function_exists('apache_get_version')) {
            echo "Versión de Apache: " . apache_get_version() . "<br>";
        } else {
            echo "La función apache_get_version no está disponible.<br>";
        }

        // Obtener la versión de PostGIS
        $postgis_version = pg_query($conn, "SELECT PostGIS_Version();");
        if ($postgis_version) {
            $row = pg_fetch_assoc($postgis_version);
            echo "Versión de PostGIS: " . $row['postgis_version'] . "<br>";
        } else {
            echo "No se pudo obtener la versión de PostGIS.<br>";
        }

        // Obtener la versión de PHP
        echo "Versión de PHP: " . phpversion() . "<br>";
    }

    // Realizar otras operaciones en la base de datos si es necesario

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    if ($conn) {
        pg_close($conn);
    }
}
?>
