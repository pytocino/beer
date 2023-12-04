<!DOCTYPE html>
<html lang="en">
<?php
$conexion = new mysqli("localhost", "super", "123456", "beerfinder");
if ($conexion->connect_error) {
    die("Error en la conexion con la base de datos" . $conexion->connect_error);
}
$consulta = "SELECT id_marca, nombre FROM marcas_cerveza ORDER BY nombre";
$consulta2 = "SELECT nombre FROM locales ORDER BY nombre";
$resultado = $conexion->query($consulta);
$resultado2 = $conexion->query($consulta2);
$valor = "";
$valor2 = "";
$valor3 = "";
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $valor .= "<option value='" . $fila['nombre'] . "'>" . ucwords($fila['nombre']) . "</option>";
        $valor2 .= $fila['nombre'] . ", ";
    }
    $valor2 = rtrim($valor2, ", ");
} else {
    echo "No se encontraron resultados";
}
$conexion->close();
$metaDescripcion = "Encuentra fácilmente bares y restaurantes que sirven la cerveza que más te gusta con BeerFinder. ¡Busca una cerveza y descubre donde la sirven! ¿Donde tomarme una " . $valor2 . "?";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER - Localizador de cervezas</title>
    <link rel="icon" type="image/png" href="ico/favicon-16x16.png">
    <link rel="icon" type="image/png" href="ico/favicon-32x32.png">
    <meta name="description" content="<?= $metaDescripcion; ?>">
    <?php
    // Colocar aquí tu código PHP para generar las etiquetas meta dinámicamente
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $nombreCerveza = ucwords($fila['nombre']);
            $metaDescripcion = "Encuentra fácilmente bares y restaurantes que sirven la cerveza " . $nombreCerveza . " con BeerFinder. ¡Busca esta cerveza y descubre dónde la sirven!";
            echo "<meta name='description' content='" . $metaDescripcion . "'>";
        }
    } else {
        echo "<meta name='description' content='No se encontraron resultados'>";
    }
    ?>
    <meta name="keywords" content="BeerFinder, localizador de cervezas, bares de cerveza, restaurantes con cerveza, locales con cerveza">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@1,500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="modal fade" id="ageVerificationModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bg-warning">¿Eres mayor de edad?</h5>
                </div>
                <div class="modal-body">
                    <p>Para acceder a este sitio, necesitas ser mayor de edad.</p>
                    <button type="button" class="btn btn-success" id="yesBtn">Sí</button>
                    <button type="button" class="btn btn-danger" id="noBtn" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <header class="container-fluid border-bottom">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand justify-content-center my-4 px-3">
                    <a href="index.php">
                        <img class="img-fluid" src="images/beerfinder.svg" alt="logo beerfinder">
                    </a>
                </nav>
            </div>
        </div>
    </header>
    <main class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="background-image d-flex justify-content-center align-items-center">
                    <form class="form form-control text-center" action="locales/cargar_locales.php" method="get">
                        <label for="selectOptionCervezas" class="form-label fw-semibold display-5 my-3">¿QUE CERVEZA TE
                            APETECE?</label>
                        <select class="form-select my-3 w-80" id="selectOptionCervezas" name="marcaCerveza" required>
                            <option class="text-center" value="" selected>Escoge una</option>
                            <?= $valor; ?>
                        </select>
                        <input type="hidden" name="pagina" value="<?= isset($_GET['pagina']) ? $_GET['pagina'] : 1 ?>">
                        <button type="submit" class="btn btn-success fw-semibold mt-2">ENCUENTRALA</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center my-5">
                <img class="rounded img-fluid" src="images/beerfinder2.gif" alt="gif beerfinder">
            </div>
            <div class="col-12 col-sm-6 col-md-4 my-2">
                <img class="img-fluid rounded" src="images/imagen1.jpg" alt="tirador de cereveza">
                <p class="pt-4 pb-4">La cerveza es una bebida alcohólica que ha sido parte de la cultura humana
                    durante
                    miles de
                    años. ¿Sabías que la cerveza primitiva era simplemente harina de cereal fermentada con el
                    mismo sistema que el pan?. Además, los babilonios consideraban la cerveza como el alimento
                    más importante y el código del rey Hammurabi dictaba que debía garantizarse a todo ciudadano una
                    ración diaria de cerveza como parte de la dieta base en Babilonia.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 my-2">
                <img class="img-fluid rounded" src="images/imagen2.jpg" alt="tirador de cereveza">
                <p class="pt-4 pb-4">La cerveza, consumida con moderación, puede tener algunos para la salud.
                    Contiene
                    nutrientes beneficiosos como ácido fólico, proteínas, carbohidratos, fibra soluble, fósforo,
                    silicio, potasio y sodio. Además, un estudio concluyó que las personas que consumían cerveza
                    habitualmente de forma moderada tenían menor incidencia de diabetes mellitus e hipertensión,
                    y mayor cantidad de colesterol bueno que aquellas que no la bebían.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 my-2">
                <img class="img-fluid rounded" src="images/coldbeer.jpg" alt="tirador de cereveza">
                <p class="pt-4 pb-4">¿A quien no le gusta una buena cerveza fria? Según Brand Finance(consulora), la
                    mejor
                    cerveza del mundo es Corona, de origen mexicano. El valor de esta marca aumentó un 21% hasta
                    alcanzar los 7.000 millones de dólares. Heineken (neerlandesa), por su parte, ocupa el
                    segundo puesto con un aumento de su marca del 23% a 6.900 millones de dólares. Budweiser,
                    estadounidense, con una valoración de 5.600 millones, cierra el podio.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form-check pl-0" action="enviar_correo.php" method="post" enctype="text/plain">
                    <h2>CONTACTO</h2>
                    <p>¿Tienes alguna pregunta o comentario? ¡Contáctanos!</p>
                    <div class="form-group mb-2">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" required></textarea>
                    </div>
                    <button type="submit" class="w-25 btn btn-primary" disabled>Enviar</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 bg-black">
                <div class="text-center text-white py-4">
                    <h3>© 2023 BEERFINDER<br>Todos los derechos reservados.</h3>
                </div>
            </div>
        </div>
    </footer>
    <script src="bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (document.cookie.indexOf('modal_visto=1') === -1) {
                let ageVerificationModal = new bootstrap.Modal(document.getElementById('ageVerificationModal'));
                ageVerificationModal.show();

                // Agrega eventos a los botones del modal
                document.getElementById('yesBtn').addEventListener('click', function() {
                    ageVerificationModal.hide();
                    document.cookie = "modal_visto=1; max-age=" + 30 * 24 * 60 * 60 + "; path=/";
                });

                document.getElementById('noBtn').addEventListener('click', function() {
                    window.history.back();
                });
            }
        });
    </script>

</body>

</html>