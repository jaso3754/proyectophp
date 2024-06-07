<?php
// Inicia la sesión
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Destruye todas las variables de sesión
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        h1,
        p {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenido, <?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : "Usuario"; ?></h1>
        <p>Tu correo electrónico registrado es: <?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : "Correo electrónico"; ?></p>
        <br><br>

        <?php
        $codigo = null;
        $servicio = null;
        $precio = null;
        $modalidad = null;
        $estado = null;

        if (isset($_GET["codigo"])) {
            $codigo = $_GET["codigo"];
            $servicio = isset($_GET["servicio"]) ? $_GET["servicio"] : '';
            $precio = isset($_GET["precio"]) ? $_GET["precio"] : '';
            $modalidad = isset($_GET["modalidad"]) ? $_GET["modalidad"] : '';
            $estado = isset($_GET["estado"]) ? $_GET["estado"] : '';
        }
        ?>

        <form action="home.php" method="post">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="servicio" class="col-form-label">Servicio</label>
                    <input type="text" name="servicio" id="servicio" class="form-control"
                        value="<?php echo htmlspecialchars($servicio); ?>" required>
                </div>
                <div class="col-auto">
                    <label for="precio" class="col-form-label">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                        value="<?php echo htmlspecialchars($precio); ?>" required>
                </div>
                <div class="col-auto">
                    <label for="modalidad" class="col-form-label">Modalidad</label>
                    <input type="text" name="modalidad" id="modalidad" class="form-control"
                        value="<?php echo htmlspecialchars($modalidad); ?>" required>
                </div>
                <div class="col-auto">
                    <label for="estado" class="col-form-label">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control"
                        value="<?php echo htmlspecialchars($estado); ?>" required>
                </div>

                <div class="col-auto">
                    <label for="crear" class="col-form-label"></label><br>
                    <button type="submit" class="btn btn-success" name="crear" id="crear"><i class="bi bi-plus-circle"></i>
                        CREAR </button>
                </div>

                <div class="col-auto">
                    <input type="hidden" name="codigo_org" value="<?php echo htmlspecialchars($codigo); ?>">
                    <label for="actualizar" class="col-form-label"></label><br>
                    <button type="submit" class="btn btn-primary" name="actualizar" id="actualizar"><i
                            class="bi bi-arrow-clockwise"></i> ACTUALIZAR</button>
                </div>
            </div>
        </form>
        <br>

        <?php
        include_once "./conexion.php";

        if (isset($_POST["crear"])) {
            $sql = "INSERT INTO producto (servicio, precio, modalidad, estado) VALUES ('" . $conn->real_escape_string($_POST["servicio"]) . "', '" . $conn->real_escape_string($_POST["precio"]) . "', '" . $conn->real_escape_string($_POST["modalidad"]) . "', '" . $conn->real_escape_string($_POST["estado"]) . "')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["message"] = "Producto creado exitosamente";
            } else {
                $_SESSION["message"] = "Error al crear producto";
            }
        }

        if (isset($_POST["actualizar"])) {
            $sql = "UPDATE producto SET servicio='" . $conn->real_escape_string($_POST["servicio"]) . "', precio='" . $conn->real_escape_string($_POST["precio"]) . "', modalidad='" . $conn->real_escape_string($_POST["modalidad"]) . "', estado='" . $conn->real_escape_string($_POST["estado"]) . "' WHERE codigo = '" . $conn->real_escape_string($_POST["codigo_org"]) . "'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["message"] = "Producto actualizado exitosamente";
            } else {
                $_SESSION["message"] = "Error al actualizar producto";
            }
        }

        if (isset($_GET["codigo_elm"])) {
            $sql = "DELETE FROM producto WHERE codigo= '" . $conn->real_escape_string($_GET["codigo_elm"]) . "'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["message"] = "Producto eliminado exitosamente";
            } else {
                $_SESSION["message"] = "Error al eliminar producto";
            }
        }

        $sql = "SELECT * FROM producto";
        $res = $conn->query($sql);

        echo '
        <table class="table table-striped">
            <tr>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Modalidad</th>
                <th>Estado</th>
                <th class="text-center">Actualizar</th>
                <th class="text-center">Eliminar</th>
            </tr>
        ';

        while ($row = $res->fetch_array()) {
            echo '
            <tr>
                <td>' . htmlspecialchars($row["servicio"]) . '</td>
                <td>' . htmlspecialchars($row["precio"]) . '</td>
                <td>' . htmlspecialchars($row["modalidad"]) . '</td>
                <td>' . htmlspecialchars($row["estado"]) . '</td>
                <td class="text-center"><a href="home.php?codigo=' . htmlspecialchars($row["codigo"]) . '&servicio=' . htmlspecialchars($row["servicio"]) . '&precio=' . htmlspecialchars($row["precio"]) . '&modalidad=' . htmlspecialchars($row["modalidad"]) . '&estado=' . htmlspecialchars($row["estado"]) . '"><i class="bi bi-arrow-clockwise"></i></a></td>

                <td class="text-center"><a href="home.php?codigo_elm=' . htmlspecialchars($row["codigo"]) . '" onclick="return confirm(\'¿Realmente deseas eliminar este elemento?\')"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
                ';
        }

        echo '</table>';
        ?>
    </div>
    <br><br>

    <div class="d-flex justify-content-center">
        <form action="home.php" method="post">
            <button type="submit" name="logout" class="btn btn-danger me-3">Cerrar sesión</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/react/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom/umd/react-dom.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/babel">
        const confirmarCerrarSesion = () => {
            const confirmacion = window.confirm("¿Estás seguro?");
            if (confirmacion) {
                window.location.href = "index.php";
            }
        }

        // Mostrar alertas SweetAlert si hay un mensaje en la sesión
        <?php if (isset($_SESSION["message"])): ?>
        Swal.fire({
            title: 'Notificación',
            text: '<?php echo $_SESSION["message"]; ?>',
            icon: '<?php echo (strpos($_SESSION["message"], "exitosamente") !== false) ? "success" : "error"; ?>',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION["message"]); ?>
        <?php endif; ?>
    </script>
</body>

</html>
