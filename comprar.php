<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Acceso Denegado',
            text: 'Primero inicia sesión para acceder a productos',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize@0.13.3/dist/css/selectize.bootstrap3.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/selectize@0.13.3/dist/js/standalone/selectize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Estilos CSS integrados aquí */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('img/imgencomprar.jpeg');
            background-size: 2150px 1200px;
            background-repeat: no-repeat;
            background-position: center;
        }

        .box {
            position: relative;
            width: 300px;
            height: 900px;
            transform-style: preserve-3d;
            animation: animate 50s linear infinite;
        }

        @keyframes animate {
            10% {
                transform: perspective(1500px) rotateY(0deg);
            }
            100% {
                transform: perspective(1500px) rotateY(360deg);
            }
        }

        .box span {
            position: absolute;
            top: 38%;
            left: 50%;
            width: 150px;
            height: 255px;
            margin-top: -75px;
            margin-left: -65px;
            transform-origin: center;
            transform: rotateY(calc(var(--i) * 60deg)) translateZ(240px);
            -webkit-box-reflect: below 0px linear-gradient(transparent, transparent, #0004);
        }

        .box span img {
            width: 150%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .box span button {
            position: absolute;
            bottom: 10px;
            left: 80%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
        }

        ul li {
            list-style: none;
        }

        ul li a {
            position: relative;
            display: block;
            text-transform: uppercase;
            margin: 10px 0;
            padding: 10px 30px;
            text-decoration: none;
            color: #fde907;
            font-family: sans-serif;
            font-size: 18px;
            font-weight: 600;
            transition: 0.5s;
            z-index: 1;
        }

        ul li a:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-top: 2px solid #fde907;
            border-bottom: 0px solid #fde907;
            transform: scaleY(2);
            opacity: 0;
            transition: 0.3s;
        }

        ul li a:after {
            content: "";
            position: absolute;
            top: 2px;
            left: 0;
            width: -100%;
            height: -100px;
            background-color: #fde907;
            transform: scale(100);
            opacity: 0;
            transition: 0.3s;
            z-index: -1;
        }

        ul li a:hover {
            color: #012822;
        }

        ul li a:hover::before {
            transform: scaleY(1);
            opacity: 1;
        }

        ul li a:hover::after {
            transform: scaleY(1);
            opacity: 1;
        }

        form {
            position: absolute;
            left: 60px;
            top: 50%;
            transform: translateY(-50%);
        }

        form label {
            color: #fde907;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="alert alert-success" role="alert">Producto agregado correctamente.</div>';
    }
    ?>

    <!-- Formulario de compra -->
    <form id="formProducto" action="agregar_producto.php" method="POST" onsubmit="event.preventDefault(); submitForm();">
        <!-- Campos del formulario -->
        <!-- Los nombres de los campos deben coincidir con los de la base de datos -->

        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio:</label>
            <select class="form-control" id="servicio" name="servicio" required>
                <option value="" selected disabled>Seleccionar servicio</option>
                <option value="24 horas">24 horas</option>
                <option value="2x2">2x2</option>
                <option value="24 horas 8 horas">24 horas 8 horas</option>
                <option value="12 horas diurno">12 horas diurno</option>
                <option value="12 horas nocturno">12 horas nocturno</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" required min="0" step="0.01" placeholder="Ingresar precio">
        </div>
        <div class="mb-3">
            <label for="modalidad" class="form-label">Modalidad:</label>
            <select class="form-control" id="modalidad" name="modalidad" required>
                <option value="" selected disabled>Seleccionar modalidad</option>
                <option value="fija">Fija</option>
                <option value="movil">Móvil</option>
                <option value="motorizada">Motorizada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="" selected disabled>Seleccionar estado</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                <option value="cancelado">Cancelado</option>
                <option value="en proceso">En proceso</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Comprar Producto</button>
    </form>
    </div>

    <div class="box">
        <span style="--i:1;">
            <img src="img/seguridad_canina.jpg" alt="">
            <button id="button1">Canino</button>
        </span>
        <span style="--i:2;">
            <img src="img/cuidandote.jpeg" alt="">
            <button id="button2">Monitoreo</button>
        </span>
        <span style="--i:3;">
            <img src="img/seguridad.jpeg" alt="">
            <button id="button3">Perimetral</button>
        </span>
        <span style="--i:4;">
            <img src="img/transportevalores.jpeg" alt="">
            <button id="button4">Valores</button>
        </span>
        <span style="--i:5;">
            <img src="img/tabajandoSeguridad.jpeg" alt="">
            <button id="button5">Residencial</button>
        </span>
        <span style="--i:6;">
            <img src="img/hermel.jpeg" alt="">
            <button id="button6">Tecnología</button>


            </span>
        <span style="--i:7;">
            <img src="img/eficacia.jpeg" alt="">
            <button id="button7">Adicionales</button>
        </span>
        <span style="--i:8;">
            <img src="img/escoltasmotorizados.jpg" alt="">
            <button id="button8">Escoltas</button>
        </span>
    </div>

    <script>
        // Manejadores de eventos para los botones
        document.getElementById('button1').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Seguridad canina',
                text: 'Valor x día 153.000',
                text: 'Valor x mes 4.590.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button2').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Monitoreo remoto',
                text: 'Valor x día 200.000',
                text: 'Valor x mes 6.000.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button3').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Seguridad perimetral',
                text: 'Valor x día 150.000',
                text: 'Valor x mes 4.500.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button4').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Transporte de valores',
                text: 'Valor x recaudo 83.000',
                text: 'valor x mes 2.490.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button5').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Seguridad residencial',
                text: 'Valor x día 125.000',
                text: 'Valor x mes 3.750.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button6').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Tecnología avanzada',
                text: 'Valor x día 215.000',
                text: 'Valor x mes 6.450.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button7').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Servicios adicionales',
                text: 'Valor x día 125.000',
                text: 'Valor x mes 3.750.000',
                confirmButtonText: 'OK'
            });
        });
        document.getElementById('button8').addEventListener('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Escoltas motorizados',
                text: 'Valor x día 300.000',
                text: 'Valor x mes 9.000.000',
                confirmButtonText: 'OK'
            });
        });

        // Función para enviar el formulario y mostrar la alerta SweetAlert
        function submitForm() {
            const form = document.getElementById('formProducto');
            const formData = new FormData(form);

            fetch('agregar_producto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto adquirido satisfactoriamente',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'comprar.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al adquirir el producto',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al adquirir el producto',
                    confirmButtonText: 'OK'
                });
            });
        }
        $(document).ready(function() {
            $('#servicio').selectize({
                create: true,
                sortField: 'text',
                placeholder: 'Seleccionar servicio'
            });
            $('#precio').selectize({
                create: true,
                sortField: 'text',
                placeholder: 'Seleccionar precio'
            });
            $('#modalidad').selectize({
                create: true,
                sortField: 'text',
                placeholder: 'Seleccionar modalidad'
            });
            $('#estado').selectize({
                create: true,
                sortField: 'text',
                placeholder: 'Seleccionar estado'
            });
        });
    </script>
</body>

</html>
