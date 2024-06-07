<?php
// Datos de conexión a la base de datos
$servername = "127.0.0.1"; // Nombre del servidor
$username = "root"; // Nombre de usuario
$password = "54321"; // Contraseña
$dbname = "proyectophp"; // Nombre de la base de datos

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    // Si la conexión falla, muestra un mensaje de error y finaliza la ejecución del script
    die("Conexión fallida: " . $conn->connect_error);
}

// Si la conexión es exitosa, muestra un mensaje de éxito
echo "Conexión exitosa";

