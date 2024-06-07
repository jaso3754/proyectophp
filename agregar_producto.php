<?php
$servername = "localhost";
$username = "root";
$password = "54321";
$dbname = "proyectophp";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que los datos se hayan enviado mediante el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $servicio = $_POST['servicio'];
    $precio = $_POST['precio'];
    $precio = str_replace('.', '', $precio); // Eliminar puntos de los miles
    $precio = str_replace(',', '.', $precio); // Reemplazar coma decimal por punto
    $precio = floatval($precio); // Convertir a número decimal
    $modalidad = $_POST['modalidad'];
    $estado = $_POST['estado'];

    // Insertar datos en la tabla
    $sql = "INSERT INTO producto (servicio, precio, modalidad, estado) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $servicio, $precio, $modalidad, $estado);

    if ($stmt->execute()) {
        // Éxito al insertar el producto
        echo json_encode(["success" => true]);
    } else {
        // Error al insertar el producto
        echo json_encode(["success" => false, "message" => "Error al agregar el producto: " . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud inválido."]);
}


$conn->close();

