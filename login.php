<?php
session_start();





// Verificar si se solicita la acción de ingreso de usuarios
if (isset($_GET['action'])) {
    include_once("./conexion.php");

    if ($_GET['action'] === 'usuarios') {
        $query = "SELECT * FROM usuarios";
    } elseif ($_GET['action'] === 'administrativos') {
        $query = "SELECT * FROM administrativos";
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['usuarios'] = []; // Inicializar el array de usuarios en la sesión
        echo "<script>console.log('Usuarios encontrados:');</script>";
        while ($row = $result->fetch_assoc()) {
            $_SESSION['usuarios'][] = $row; // Almacenar cada usuario en la sesión
            echo "<script>console.log('Usuario: " . $row['nombre'] . ", Correo: " . $row['correo'] . "');</script>";
        }
    } else {
        echo "<script>console.log('No se encontraron usuarios');</script>";
    }
}

$mensaje_error = ""; // Inicializar la variable de mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("./Usuario.php");
    include_once("./conexion.php");

    $user = $_POST["user"] ?? "";
    $pass = $_POST["pass"] ?? "";
    $email = $_POST["email"] ?? "";

    // Validaciones en cada línea de formulario
    $errors = [];
    if (empty($user)) {
        $errors[] = "El campo Usuario es requerido";
    }
    if (empty($pass)) {
        $errors[] = "El campo Contraseña es requerido";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El campo Correo Electrónico es inválido";
    }

    if (empty($errors)) {
        if (isset($_GET['action']) && $_GET['action'] === 'usuarios') {
            $query = "SELECT * FROM usuarios WHERE nombre = ? AND contrasena = ? AND correo = ?";
        } elseif (isset($_GET['action']) && $_GET['action'] === 'administrativos') {
            $query = "SELECT * FROM administrativos WHERE nombre = ? AND contrasena = ? AND correo = ?";
        }
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $user, $pass, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Credenciales válidas
            $_SESSION["status"] = true;
            $_SESSION["user"] = filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Guardar nombre de usuario en sesión
            $_SESSION["email"] = filter_var($email, FILTER_SANITIZE_EMAIL); // Guardar correo electrónico en sesión
            if (isset($_GET['action']) && $_GET['action'] === 'administrativos') {
                header("Location: home.php"); // Redirigir al administrativo a home.php
            } else {
                // Redirigir al usuario a index.php o comprar.php
                if (isset($_GET['action']) && $_GET['action'] === 'usuarios') {
                    
                    header("Location: comprar.php"); // Redirigir al usuario a comprar.php
                } else {
                    
                }
            }
            exit(); // Finalizar la ejecución del script
        
        
               
            
        } else {
            // Credenciales inválidas
            echo '
                <script>
                    Swal.fire({
                        title: "Lo sentimos",
                        text: "Usuario o contraseña incorrectos",
                        icon: "error"
                    });
                </script>
            ';
        }
    }

    // Mostrar errores de validación
    if (!empty($errors)) {
        $mensaje_error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="1stile.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('img/tabajandoSeguridad.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 400px;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h1 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .card input[type="text"],
        .card input[type="password"],
        .card input[type="email"],
        .card button {
            background-color: #212529;
            color: white;
            border: none;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
        }

        .card input[type="text"]::placeholder,
        .card input[type="password"]::placeholder,
        .card input[type="email"]::placeholder {
            color: white;
        }

        .card button {
            cursor: pointer;
        }

        .card button:hover {
            background-color: #343a40;
        }

        .alert {
            background-color: #212529;
            color: white;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .header-text {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-text a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .header-text a:hover {
            text-decoration: underline;
        }

        .divider {
            border-left: 2px solid #0000FF;
            height: 30px;
            margin: 0 10px;
        }
    </style>
</head>

<body class="fondo">
    <div class="container">
        <div class="card p-4">
            <div class="header-text">
                <a href="?action=usuarios">Ingreso Usuarios</a>
                <div class="divider"></div>
                <a href="?action=administrativos">Ingreso Administrativo</a>
            </div>
            <h1 class="text-center mb-4">Inicio de Sesión</h1>
            <?php if (!empty($mensaje_error)) : ?>
                <div class="alert"><?= $mensaje_error ?></div>
            <?php endif; ?>
            <form action="?action=<?= isset($_GET['action']) ? $_GET['action'] : 'usuarios' ?>" method="post">
                <div class="mb-3">
                    <input type="text" name="user" class="form-control" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
            <div class="mt-3">
                <p>¿No tienes una cuenta? <a href="./registro.php">Regístrate aquí</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
