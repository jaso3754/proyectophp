<?php
// Iniciar sesión si no está iniciada
session_start();

// Obtener el correo electrónico del usuario desde la sesión
$correoUsuario = $_SESSION['email'];

// Cuerpo del correo electrónico con la factura
$mensaje = "Estimado cliente,\n\nAdjunto encontrará su factura de compra.\n\nGracias por su compra.";

// Configuración para enviar el correo
$asunto = "Factura de compra";
$headers = "From: reybernal250410@gmail.com";

// Enviar el correo electrónico con la factura adjunta
if (mail($correoUsuario, $asunto, $mensaje, $headers)) {
    // El correo se envió correctamente
    echo "<script>alert('Compra realizada satisfactoriamente. Se ha enviado la factura al correo electrónico.');</script>";
    echo "<script>window.location.href = 'comprar.php';</script>";
} else {
    // Error al enviar el correo
    echo "<script>alert('Error al enviar la factura por correo electrónico.');</script>";
    echo "<script>window.location.href = 'comprar.php';</script>";
}

