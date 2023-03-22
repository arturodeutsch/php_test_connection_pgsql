<?php
// Comprobar si el módulo php-pgsql está instalado
if (extension_loaded('pgsql')) {
    echo "El módulo php-pgsql existe.<br>";
} else {
    echo "El módulo php-pgsql no existe.<br>";
}

// Datos de la conexión
$host = "localhost";
$port = 5432;
$dbname = "nombre_de_tu_bd";
$user = "tu_usuario";
$password = "tu_contraseña";

// Intentar conectar a la base de datos
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Comprobar si la conexión fue exitosa
if (!$conn) {
    echo "Error al conectar a la base de datos.";
} else {
    echo "Conexión a PostgreSQL exitosa.";
}

// Cerrar la conexión
pg_close($conn);
?>
