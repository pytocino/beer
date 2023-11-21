<!DOCTYPE html>
<html lang="en">

<?php
$conexion = new mysqli("localhost", "super", "123456", "beerfinder");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$consulta = "SELECT id_marca, nombre FROM marcas_cerveza ORDER BY nombre";
$resultado = $conexion->query($consulta);
$valor = "";

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $valor .= "<option value='" . $fila['id'] . "'>" . ucwords($fila['nombre']) . "</option>";
    }
}

$conexion->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER</title>
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="icon" href="/ico/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@1,500&display=swap" rel="stylesheet">

    <script>
        function openNav() {
            document.getElementById("menu-desplegable").style.width = "250px";
            document.body.style.overflow = "hidden";
        }

        function closeNav() {
            document.getElementById("menu-desplegable").style.width = "0";
            document.body.style.overflow = "scroll";
        }
    </script>
</head>

<body>
    <header>
        <div id="header">
            <a href="index.html">
                <img src="./images/beerfinder.png" alt="logo" width="200px">
            </a>
            <span id="menu" onclick="openNav()">
                <img src="./images/menu.svg" alt="menu" height="25px">
            </span>
            <div id="menu-desplegable">
                <span class="closebtn" onclick="closeNav()">&times;</span>
                <a href="#">INICIAR SESION</a>
                <a href="#">REGISTRO</a>
                <a href="#">CONTACTO</a>
            </div>
        </div>
    </header>
    <div id="cuerpo" onclick="closeNav()">
        <section>
            <div id="foto">
                <div id="input">
                    <form id="query" action="./locales/cargar_locales.php" method="get">
                        <h2>BUSCA LA CERVEZA QUE TE APETEZCA</h2>
                        <div id="contenido-form">
                            <select name="opciones" required>
                                <option value="" selected>Escoge una</option>
                                <?= $valor; ?>
                            </select>
                            <button type="submit">ENCUENTRALA</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="contenido">
                <div id="contenido1">
                    <div id="imagen1"></div>
                    <div id="texto1">
                        <p>La cerveza es una bebida alcohólica que ha sido parte de la cultura humana durante miles de
                            años. ¿Sabías que la cerveza primitiva era simplemente harina de cereal fermentada con el
                            mismo sistema que el pan?. Además, los babilonios consideraban la cerveza como el alimento
                            más
                            importante y el código del rey Hammurabi dictaba que debía garantizarse a todo ciudadano una
                            ración diaria de cerveza como parte de la dieta base en Babilonia.
                            <strong>¡Salud!🍻</strong>
                        </p>
                    </div>
                </div>
                <div id="contenido2">
                    <div id="imagen2"></div>
                    <div id="texto2">
                        <p>La cerveza, consumida con moderación, puede tener algunos para la salud. Contiene
                            nutrientes beneficiosos como ácido fólico, proteínas, carbohidratos, fibra soluble, fósforo,
                            silicio, potasio y sodio. Además, un estudio concluyó que las personas que consumían cerveza
                            habitualmente de forma moderada tenían menor incidencia de diabetes mellitus e hipertensión,
                            y mayor cantidad de colesterol bueno que aquellas que no la bebían.
                            <strong>¡Salud!🍻</strong>
                        </p>
                    </div>
                </div>
                <div id="contenido1">
                    <div id="imagen3"></div>
                    <div id="texto1">
                        <p>¿A quien no le gusta una buena cerveza fria? Según Brand Finance(consulora), la mejor
                            cerveza del mundo es Corona, de origen mexicano. El valor de esta marca aumentó un 21% hasta
                            alcanzar los 7.000 millones de dólares. Heineken (neerlandesa), por su parte, ocupa el
                            segundo puesto con un aumento de su marca del 23% a 6.900 millones de dólares. Budweiser,
                            estadounidense, con una valoración de 5.600 millones, cierra el podio.
                            <strong>¡Salud!🍻</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div id="contact">
                <h2>CONTACTO</h2>
                <p>¿Tienes alguna pregunta o comentario? ¡Contáctanos!</p>
            </div>
        </section>
    </div>

    <footer>
        <h3>© 2023 BEERFINDER<br>Todos los derechos reservados.</h3>
    </footer>
</body>

</html>