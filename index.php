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
}
if ($resultado2->num_rows > 0) {
    while ($fila = $resultado2->fetch_assoc()) {
        $valor3 .= "<option value='" . $fila['nombre'] . "'>" . ucwords($fila['nombre']) . "</option>";
    }
}
$conexion->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER - Localizador de cervezas</title>
    <link rel="icon" type="image/png" href="ico/favicon-16x16.png">
    <link rel="icon" type="image/png" href="ico/favicon-32x32.png">
    <meta name="description" content="Encuentra fácilmente bares y restaurantes que sirven la cerveza que más te gusta con BeerFinder. ¡Busca una cerveza y descubre donde la sirven! ¿Donde tomarme una <?= $valor2; ?>?">
    <meta name="keywords" content="BeerFinder, localizador de cervezas, bares de cerveza, restaurantes con cerveza, locales con cerveza">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@1,500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- <div class="modal fade" id="ageVerificationModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-bg-warning">¿Eres mayor de edad?</h5>
                </div>
                <div class="modal-body">
                    <p>Para acceder a este sitio necesitas ser mayor de edad.</p>
                    <button type="button" class="btn btn-success" id="yesBtn">Sí</button>
                    <button type="button" class="btn btn-danger" id="noBtn" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div> -->
    <header class="d-flex justify-content-center">
        <nav class="navbar navbar-expand-sm m-4">
            <a href="index.php">
                <img class="logo img-fluid mx-auto d-block" src="images/beerfinder.png" alt="logo beerfinder">
            </a>
        </nav>
    </header>
    <main class="px-2">
        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="cervezas-tab" data-bs-toggle="tab" data-bs-target="#cervezas" type="button" role="tab" aria-controls="cervezas" aria-selected="true"><strong>CERVEZAS</strong></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="locales-tab" data-bs-toggle="tab" data-bs-target="#locales" type="button" role="tab" aria-controls="locales" aria-selected="false"><strong>LOCALES</strong></button>
            </li>
        </ul>
        <div class="background-image tab-content d-flex" id="mytabcontent">
            <div class="tab-pane fade show active" id="cervezas" role="tabpanel" aria-labelledby="cervezas-tab">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <form class="form form-control-lg" action="locales/cargar_locales.php" method="get">
                        <div class="mb-3">
                            <label for="selectOptionCervezas" class="form-label fw-semibold display-5">¿QUE CERVEZA TE
                                APETECE?</label>
                            <select class="form-select" id="selectOptionCervezas" name="marcaCerveza" required>
                                <option class="text-center" value="" selected>Escoge una</option>
                                <?= $valor; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success fw-semibold">ENCUENTRALA</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="locales" role="tabpanel" aria-labelledby="locales-tab">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <form class="form form-control-lg" action="locales/cargar_cervezas.php" method="get">
                        <div class="mb-3">
                            <label for="selectOptionLocales" class="form-label fw-semibold display-5">¿SABES QUE CERVEZA
                                VENDEN DONDE VAS?</label>
                            <select class="form-select" id="selectOptionLocales" name="locales" required>
                                <option class="text-center" value="" selected>¿Donde vas?</option>
                                <?= $valor3; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success fw-semibold">DESCUBRELO</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row px-2 mt-5">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img class="rounded img-fluid" src="images/beerfinder2.gif" alt="gif beerfinder">
            </div>
        </div>
        <div class="row pt-5 d-flex">
            <div class="col-12 col-md-4">
                <img class="imagen-main rounded" src="images/imagen1.jpg" alt="tirador de cereveza">
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
            <div class="col-12 col-md-4">
                <img class="imagen-main rounded" src="images/imagen2.jpg" alt="amigos bebiendo cerveza">
                <p class="pt-4 pb-4">La cerveza, consumida con moderación, puede tener algunos para la salud.
                    Contiene
                    nutrientes beneficiosos como ácido fólico, proteínas, carbohidratos, fibra soluble, fósforo,
                    silicio, potasio y sodio. Además, un estudio concluyó que las personas que consumían cerveza
                    habitualmente de forma moderada tenían menor incidencia de diabetes mellitus e hipertensión,
                    y mayor cantidad de colesterol bueno que aquellas que no la bebían.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img class="imagen-main rounded" src="images/coldbeeer.jpg" alt="cerveza fria">
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
        <div id="contact">
            <h2>CONTACTO</h2>
            <p>¿Tienes alguna pregunta o comentario? ¡Contáctanos!</p>
        </div>
    </main>
    <footer class="bg-black text-center text-white py-3">
        <h3>© 2023 BEERFINDER<br>Todos los derechos reservados.</h3>
    </footer>
    <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            let ageVerificationModal = new bootstrap.Modal(document.getElementById('ageVerificationModal'));
            ageVerificationModal.show();
            document.getElementById('yesBtn').addEventListener('click', function() {
                ageVerificationModal.hide();
            });
            document.getElementById('noBtn').addEventListener('click', function() {
                window.history.back();
            });
        });
    </script> -->
</body>

</html>