<?php
// Inicia la sesión
session_start();

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
    <title>softvigitecol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/e6d3741188.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
    <style>
         
    :root{
        --color1: #0a42fc;
        --color2: #0044ff;
        --color3: #0659ff;
        --fondo: #f2f2f2;
        --titulos: 33px;
        --margenes: 60px;
        --espacios: 10px;
        --espacios-contenido:45px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'open sans';
        background: var(--fondo);
    }

    img{
       vertical-align: top;
    }




    /* Header */

    header{
        width: 100%;
        height:600px;
        background: linear-gradient(to bottom,
        #010645,
        #0314fd,
        #dbaa2e,
        #f4e2b3
        ), url(img/fondo.jpg);
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }

    nav {
    width: 100%;
    position: fixed;
    top: 0;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
    background-color: #fff; /* Color de fondo de la barra de menú */
    z-index: 1000;
}

    .nav1{
        background: white;
        height: 80px;
        color:#000000; /*color del texto dentro de este nav*/
    }

    /*El siguiente estilo aplica a un nombre de clase (nav2) que se asigna mediante JavaScript*/
    .nav2{
        background: var(--fondo);
        height:100px;
        color:#fcfcfc; /*color del texto dentro de este segundo estilo para el nav*/
    }

    .contenedor-nav{
        display: flex;
        margin: auto; /*el elemento toma el ancho que le doy, y después tomará el espacio sobrante para establecer automáticamente las márgenes*/
        width: 90%;
        justify-content: space-between; /*espacio adecuado entre los diferentes elementos de este contenedor*/
        align-items: center;  /*Los elementos se centran automáticamente con respecto a la parte superior e inferior del contenedor, es decir, en el eje y*/
        max-width:1000px;
        height:inherit;
        overflow: hidden;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    nav .enlaces a{  /*Aquí estoy diciendo que se aplica el estilo a la etiqueta a de la clase enlaces del elemento nav*/
        display: inline-block;
        padding: 5px 0;
        margin-right: 17px;
        font-size: 17px;
        font-weight: 300;
        text-decoration: none;
        border-bottom: 3px solid transparent;
        color: inherit; /*se hereda el color de texto del nav como se definió ya en nav1*/
    }

    nav .enlaces a:hover{
        border-bottom: 3px solid #030154;
        transition: 0.6s;
        color:#3358FF;
        font-size: 20px;
    }

    .logo, .logo img{ height:120px;
        
    }

    .logo{
       justify-content: right;
    }

    .icono{
        display:none;
        font-size: 24px;
        padding: 23.5px 20px;
    }

    /*textos*/

    .textos{
        width: 100%;
        height: 100%;
        display:flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        color:rgb(7, 7, 7);
        overflow: hidden;
        text-align: center;
    }

    .textos>h1{
        font-size:80px;
        text-shadow: 2px 1px 30px black;
    }

    .textos>h2{
        font-size: 30px; font-weight: 300;
    }

    /* Main */

    .contenedor{
        margin:auto;
        padding: var(--margenes) 0;
        width: 90%;
        max-width: 1000px;
        text-align: center;
        overflow: hidden;
    }

    .contenedor h3{
        font-size: var(--titulos);
        color: var(--color1);
        margin-bottom: var(--espacios);
    }

    .contenedor p{
        font-size: var(--subtitulos);
        font-weight: 300;
        color: var(--color1);
    }

    .after::after{
        content:'';
        display: block;
        margin: auto;
        margin-top: var(--espacios);
        width: 100px;
        height: 2px;
        background: var(--color1);
        margin-bottom: var(--espacios-contenido);
    }

    .card {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        flex-direction: row;
    }

    .content-card{
        width: 25%;
        box-shadow: 0 0 6px 0 rgba(4, 23, 110, 0.5);
        overflow: hidden;
        height:650px;
        display: flex; /* Para usar flexbox */
        flex-direction: column; /* Dirección de la flexbox */
        align-items: center; /* Centrar verticalmente */
    }

    .people{
        height: 80%; /* cuánta altura me va a ocupar del content-card */
    }

    .content-card img{
        width: 100%;
        height: 100%;
        object-fit: cover; /* el objeto reemplazado (la imagen) se redimensiona para ajustarse al al tamaño del div*/
    }

    .texto-team{
        height: 100%;
        width: 80%;
        padding: 10px;
    }

    .about{
        background: url(img/teclado.jpg);
        height: auto;
    }

    .servicios{
        display: flex;
        color:#fff;
        justify-content: space-between;
        margin: auto;
        flex-wrap: wrap; /*responsive, útil para para pantallas más pequeñas*/
       align-items: center;
       flex-direction:column
    }

    .caja-servicios{
        width: 31%;
        margin: auto;
        text-align: center;
    }
    .caja-servicios>img{
        vertical-align: top;
        width: 65%;
    }

    .caja-servicios>h4{
        margin-bottom: var(--espacios);
    } 

    .caja-servicios>p{
        text-align: center;
    }

    .botones-work{
        overflow: hidden;
    }

    .botones-work li{
        display: inline-block;
        text-align: center;
        margin-left: var(--espacios);
        margin-bottom: var(--espacios-contenido);
        padding: 6px 12px;
        border: 1px solid var(--color1);
        list-style: none;
        color: var(--color1);
    }

    .botones-work li:hover{
        background: var(--color1);
        color:#fff;
        cursor: pointer;
    }

    .botones-work .active{
        background: var(--color1);
        color:#fff;
    }

    .galeria-work{
        display:flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .cont-work{
        width: 31%;
        box-shadow: 0 0 6px 0 rgba(0,0,0,.5);
        height:300px;
        overflow: hidden;
        margin-bottom: var(--espacios-contenido);
    }

    .img-work{
        height: 90%;
        width: 100%;
    }

    .img-work img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .textos-work{
        height: 10%;
    }

    .textos-work h4{
        line-height: 30px;
        font-weight: 300;
    }

    /*Diseño del footer*/

    footer{background:url(img/teclado.jpg);
    
    }
    .marca-logo p {
    color: red; /* Cambia 'red' al color que desees */
}


    .marca-logo{
        width: 40%;
        margin: auto;
        margin-bottom: var(--espacios);
        /*background: yellow;*/
    }

    .marca-logo img{
        width: 100%;
    }

    .iconos{
        display: flex;
        margin: auto;
        justify-content: space-around;
        width: 100%;
        /*background: blue;*/
    }

    .fab{
        font-size:60px;
        color: #FFF;
        margin-bottom: var(--espacios);
        display: inline-block;
        /*background: green;*/
    }

    footer p{
        margin-top:var(--espacios);
        /*background:#FFF;*/
    }
    /*
    .fa-youtube, .fa-facebook-square, .fa-github{
    color: #fff;
    border: 1px solid red; 
    
    } */

    /*se usa @media para especificar estilos que solo se reflejarán si se cumplen ciertas condiciones*/
    @media screen and (max-width: 700px){                  /*debe ser una pantalla y no tener más de 700px de ancho*/
   

    .icono{
        display:block;
        cursor: pointer;
    }

    .enlaces{
        position: fixed;
        top:80px;
        background: #2c3e50; /*color de fondo del contenedor de los enlaces del nav*/
        left: 0; /*dentro del nav por el lado izquierdo no tednrá margen*/
        height: 100%;
        transition: 1s;
        width: 0;  /*esconde el div ya que el ancho es 0*/
        overflow: hidden; /*oculta los textos*/
        display: inline-block;
        color: red;  
    
    }
    .enlaces a{
        display: block;
        width: 100%;  /*el 100% de la caja enlances*/
        height: 50px;    /*altura de la caja elemento "a"*/
        padding: 20px;
        text-align: center;
        background: #34495e; /*color de fondo de la caja elemento "a"*/
        color:#fff;
    }

    .textos>h1{font-size: 70px;}
    .textos>h2{font-size:35px;}


    .content-card{     /*2     */
        width: 48%;     /*se redujo el ancho del content-card */
        margin-bottom:var(--margenes);
    }

    :root{
        --margenes: 30px;
    }

    }

    @media screen and (max-width: 500px){
    :root{
        --espacios-contenido: 25px;
    }

    .content-card{   /*3     */
        width: 90%;   /*se aumentó el tamaño del content-card  */
    }

    .caja-servicios{
        width: 90%;
        margin-bottom: var(--margenes);
    
    }
 
    .cont-work{
        width: 85%;
    }

    .marca-logo{
        width: 80%;
    }

    .iconos{
        margin: auto;
    }
    }
    .boton-comprar {
    margin-top: var(--espacios);
}

.boton-comprar .btn {
    display: inline-block;
    padding: 10px 20px; /* Ajusta el padding según sea necesario */
    background-color: #007bff; /* Color de fondo */
    color: #fff; /* Color del texto */
    text-decoration: none; /* Quita el subrayado de los enlaces */
    border-radius: 5px; /* Añade bordes redondeados */
}
.people img {
    width: 210px; /* Cambia el valor a lo que necesites */
    height: 400px; /* Para mantener la proporción original */
    object-fit: cover;
}
/* Estilos para los modales */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}



    
    </style>
</head>

<body>
    <body class="hidden">
    <div class="centrado" id="onload">
        <div class="lds-facebook"><div></div><div></div><div></div></div>
    </div>
    <header>
        <nav id="nav" class="nav1">
            <div class="contenedor-nav">
                
                <div class="logo">
                <img src="img/logo-vigitecol.png" alt="logo">
                </div>
                <div class="enlaces" id="enlaces">
                    <a href="#Servicios" id="enlace-servicios" class="btn-header">Servicios</a>
                    <a href="#Equipo" id="enlace-equipo" class="btn-header">Equipo</a>
                   
                    <a href="#Trabaja" id="enlace-trabajo" class="btn-header">Trabaja con nosotros</a>
                    <a href="#Contacto" id="enlace-contacto" class="btn-header">Contacto</a>
                    <a href="login.php" class="btn-header">Iniciar sesion</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>
        <div class="textos">
            <h1>Softvigitecol</h1>
            <h2>Software de Vigilancia y seguridad privada</h2>
        </div>
    </header>
    <main>
        <section class="about" id="Servicios">
            <div class="contenedor">
                <h3>Nuestros servicios</h3>
                <p class="after">Siempre mejorando para ti</p>
                <div class="servicios">
                    <div class="caja-servicios">
                        <img src="img/canino.jpeg" alt="">
                        <h4>vigilancia humana y canina</h4>
                        <p>Esta modalidad esta establecida para el cuidado de bienes e inmuebles residenciales o industriales.</p>
                    </div>
                    <div class="caja-servicios">
                        <img src="img/ccvv.png" alt="">
                        <h4>Circuito cerrado de Television</h4>
                        <p>La mejor tecnologia en circuitos cerrados para mejorar su seguridad</p>
                    </div>
                    <div class="caja-servicios">
                        <img src="img/seguridad.jpeg" alt="">
                        <h4>Creativos y asombrosos</h4>
                        <p>Estudios de seguridad hechos por profesionales calificados</p>
                    </div>
                     <!--jei esto es la modificacion en el html para el boton comprar, abajo esta el script con la alerta y redireccion a comprar.php-->
                    <div class="boton-comprar">
                     <button type="button" onclick="comprar()" class="btn btn-primary">Comprar</button>

            </div>
                </div>
            </div>
        </section>
        <section class="team contenedor" id="equipo">
            <h3>Sobre Nosotros</h3>
            <p class="after">Conoce a nuestro equipo</p>
            <div class="card">
                <div class="content-card">
                    <div class="people">
                        <img src="img/jheison.jpeg" alt="">
                    </div>
                    <div class="texto-team">
                        <h4>Jheison rojas</h4>
                        <p>Guarda de seguridad experto en seguridad perimetral y estudios de seguridad en toda clase de perimetros, ya sea urbanos o rurales</p>
                    </div>
                </div>
                <div class="content-card">
                    <div class="people">
                        <img src="img/Arbey.jpeg" alt="">
                    </div>
                    <div class="texto-team">
                        <h4>Harvey Bernal</h4>
                        <p>Guarda de seguridad,escolta y supervisor.Lider gremial con amplia experiencia en los distintos servicios y modalidades existentes en seguridad privada para colombia.</p>
                    </div>
                </div>
                <div class="content-card">
                    <div class="people">
                        <img src="img/anak jun 2023_fondo blanco.jpg">
                    </div>
                    <div class="texto-team">
                        <h4>Ana Karina Yepes</h4>
                        <p>Profesional Ambiental SIG, Bioinformatica, Analísta de datos, ilustradora científica y encargada de la gestion documental sobre nuestro servicios</p>
                    </div>
                </div>
                <!--agrego un nuevo content-card a mi gusto-->
                <div class="content-card">
                    <div class="people">
                        <img src="img/adan.jpg" alt=""> <!--cambio imagen-->
                    </div>
                    <div class="texto-team">
                        <h4>Adan de Jesus Restrepo Zapata</h4>
                        <p>39 años guarda de seguridad experto en control de accesos y plataformas digitales su experiencia guia a nuestros clientes para entregar el  servicio idoneo para ellos</p>
                    </div>
                </div>     
            </div>
        </section>
        
        <section class="work contenedor" id="trabajo">
    <h3>Trabaja Con Nosotros</h3>
    <p class="after">Hacemos de algo simple algo extraordinario</p>
    <div class="botones-work">
        <ul>
            <li class="filter" data-nombre='tecnologia' id="btn-tecnologia">Tecnologia</li>
            <li class="filter" data-nombre='historia' id="btn-historia">Historia</li>
            <li class="filter" data-nombre='aliados' id="btn-aliados">Aliados</li>
        </ul>
    </div>
    <div class="galeria-work">
        <div class="cont-work programacion">
            <div class="img-work">
                <img src="img/programacion2.jpeg" alt="">
            </div>
            <div class="textos-work">
                <h4>Tecnologia</h4>
            </div>
        </div>
        <div class="cont-work diseño">
            <div class="img-work">
                <img src="img/frontend-04.jpg" alt="">
            </div>
            <div class="textos-work">
                <h4>Historia</h4>
            </div>
        </div>
        <div class="cont-work marketing">
            <div class="img-work">
                <img src="img/marketing1.jpeg" alt="">
            </div>
            <h4>Aliados</h4>
        </div>
    </div>

    <!-- Modal Tecnologia -->
    <div id="modal-tecnologia" class="modal">
        <div class="modal-content">
            <span class="close" id="close-tecnologia">&times;</span>
            <h2>Tecnologia</h2>
            <p>En la actualidad, la tecnología juega un papel crucial en el ámbito de la seguridad privada. Sofvigitecol utiliza sistemas avanzados de videovigilancia con cámaras de alta definición que permiten monitorear en tiempo real cualquier incidencia. Además, contamos con sistemas de control de acceso biométricos, que garantizan la entrada solo a personas autorizadas mediante el reconocimiento de huellas dactilares y faciales. La integración de inteligencia artificial y análisis de datos en nuestros procesos permite predecir y prevenir posibles amenazas, brindando una protección proactiva y eficaz. Los drones y los sistemas de patrullaje automatizado también forman parte de nuestro arsenal tecnológico, asegurando una cobertura amplia y constante de las áreas bajo nuestra protección.</p>
        </div>
    </div>

    <!-- Modal Historia -->
    <div id="modal-historia" class="modal">
        <div class="modal-content">
            <span class="close" id="close-historia">&times;</span>
            <h2>Historia</h2>
            <p>Sofvigitecol nació en el año 2005 con el objetivo de proporcionar soluciones de seguridad de alta calidad en Colombia. Fundada por un grupo de expertos en seguridad y tecnología, la empresa comenzó sus operaciones con un equipo reducido pero altamente capacitado. A lo largo de los años, Sofvigitecol ha crecido exponencialmente, expandiendo sus servicios a diversas industrias, incluyendo la banca, la manufactura, y el sector residencial. Nuestra dedicación a la innovación y la excelencia nos ha permitido ganar la confianza de cientos de clientes satisfechos. Hoy en día, Sofvigitecol es reconocida como líder en seguridad privada, gracias a nuestra combinación única de tecnología avanzada y personal calificado.

            </p>
        </div>
    </div>

    <!-- Modal Aliados -->
    <div id="modal-aliados" class="modal">
        <div class="modal-content">
            <span class="close" id="close-aliados">&times;</span>
            <h2>Aliados</h2>
            <p>En Sofvigitecol, creemos en el poder de las alianzas estratégicas para ofrecer el mejor servicio posible. Contamos con la colaboración de empresas líderes en tecnología de seguridad, como Hikvision y Dahua, quienes nos proveen con los equipos de videovigilancia más avanzados del mercado. Además, trabajamos de la mano con firmas de consultoría en seguridad como ASIS International, lo que nos permite mantenernos a la vanguardia en las mejores prácticas y normativas del sector. También somos socios estratégicos de empresas de ciberseguridad, asegurando que nuestros sistemas estén protegidos contra amenazas digitales. Estas alianzas nos permiten ofrecer un servicio integral y de alta calidad, adaptado a las necesidades específicas de cada cliente.

Estos textos están diseñados para ser informativos y atractivos, proporcionando detalles clave sobre la tecnología utilizada, la historia de la empresa y sus aliados estratégicos. Si necesitas algún ajuste o personalización adicional, házmelo saber.






</p>
        </div>
    </div>
</section>

    </main>
    <footer id="contacto">
        <div class="footer contenedor">
            <div class="marca-logo">
                <img src="img/logo-vigitecol.png" alt="">
            </div>
            <div class="iconos">
                <a href="https://www.youtube.com/@vigitecolltda3580/" target="_blank" class="social-icon">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.facebook.com/vigitecol.ltda/about/" target="_blank" class="social-icon">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="https://x.com/Vigitecol?t=ViM_P3CXSSwvHlXntg1YVw&s=09/" target="_blank" class="social-icon">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            <p>Creamos un mundo seguro para ti</p>
        </div>
    </footer>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/filtro.js"></script>

    <script>
        // Función para desplazarse suavemente a una sección
        function scrollToSection(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Event listener para el enlace de servicios
        document.getElementById('enlace-servicios').addEventListener('click', function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            scrollToSection('Servicios'); // Llama a la función para desplazarse a la sección de servicios
        });

        // Event listener para el enlace de equipo
        document.getElementById('enlace-equipo').addEventListener('click', function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            scrollToSection('equipo'); // Llama a la función para desplazarse a la sección de equipo
        });
        document.addEventListener('DOMContentLoaded', function() {
    const enlaceContacto = document.getElementById('enlace-contacto');
    const seccionContacto = document.getElementById('contacto');

    enlaceContacto.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace

        // Obtiene la posición de la sección de contacto
        const offsetTop = seccionContacto.offsetTop;

        // Realiza el desplazamiento suave
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    });
});

        document.addEventListener('DOMContentLoaded', function() {
    const enlaceTrabajo = document.getElementById('enlace-trabajo');
    const seccionTrabajo = document.getElementById('trabajo');

    enlaceTrabajo.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace

        // Obtiene la posición de la sección de trabajo
        const offsetTop = seccionTrabajo.offsetTop;

        // Realiza el desplazamiento suave
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Obtener modales y botones
    var modalTecnologia = document.getElementById("modal-tecnologia");
    var modalHistoria = document.getElementById("modal-historia");
    var modalAliados = document.getElementById("modal-aliados");

    var btnTecnologia = document.getElementById("btn-tecnologia");
    var btnHistoria = document.getElementById("btn-historia");
    var btnAliados = document.getElementById("btn-aliados");

    var spanTecnologia = document.getElementById("close-tecnologia");
    var spanHistoria = document.getElementById("close-historia");
    var spanAliados = document.getElementById("close-aliados");

    // Cuando el usuario hace clic en el botón, abre el modal
    btnTecnologia.onclick = function() {
        modalTecnologia.style.display = "block";
    }

    btnHistoria.onclick = function() {
        modalHistoria.style.display = "block";
    }

    btnAliados.onclick = function() {
        modalAliados.style.display = "block";
    }

    // Cuando el usuario hace clic en <span> (x), cierra el modal
    spanTecnologia.onclick = function() {
        modalTecnologia.style.display = "none";
    }

    spanHistoria.onclick = function() {
        modalHistoria.style.display = "none";
    }

    spanAliados.onclick = function() {
        modalAliados.style.display = "none";
    }

    // Cuando el usuario hace clic fuera del modal, cierra el modal
    window.onclick = function(event) {
        if (event.target == modalTecnologia) {
            modalTecnologia.style.display = "none";
        }
        if (event.target == modalHistoria) {
            modalHistoria.style.display = "none";
        }
        if (event.target == modalAliados) {
            modalAliados.style.display = "none";
        }
    }
});

function comprar() {
        // Verificar si el usuario ha iniciado sesión, jei esta es la funcion para el boton comprar con sweeet
        if (!<?php echo isset($_SESSION['loggedin']) ? 'true' : 'false'; ?>) {
            Swal.fire({
                title: 'Debes iniciar sesión',
                text: 'Para comprar, primero inicia sesión.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        }
    }
</script>

    </script>
</body>
   
</html>
