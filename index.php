<!DOCTYPE html>
<html lang="en">
<?php
$conexion = new mysqli("localhost", "super", "123456", "beerfinder");
if ($conexion->connect_error) {
    die("Error en la conexion con la base de datos" . $conexion->connect_error);
}
$consulta = "SELECT id_marca, nombre FROM marcas_cerveza ORDER BY nombre";
$resultado = $conexion->query($consulta);
$valor = "";
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $valor .= "<option value='" . $fila['nombre'] . "'>" . ucwords($fila['nombre']) . "</option>";
    }
}
$conexion->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER</title>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="icon" href="ico/favicon.ico" type="image/x-icon">
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
    <header class="d-flex justify-content-center">
        <nav class="navbar navbar-expand-sm m-4">
            <a href="index.php">
                <img class="logo img-fluid mx-auto d-block" src="images/beerfinder.png" alt="logo beerfinder">
            </a>
        </nav>
    </header>
    <main class="px-2">
        <div class="background-image d-flex flex-column">
            <form class="form w-60 form-control-lg" action="locales/cargar_locales.php" method="get">
                <div class="mb-3">
                    <label for="selectOption" class="form-label fw-semibold display-5">¿QUE CERVEZA TE APETECE?</label>
                    <select class="form-select" id="selectOption" name="marcaCerveza" required>
                        <option class="text-center" value="" selected>Escoge una</option>
                        <?= $valor; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success fw-semibold">ENCUENTRALA</button>
            </form>
        </div>
        <div class="row pt-5 d-flex">
            <div class="col-12 col-md-4">
                <img class="imagen-main" src="images/imagen1.jpg" alt="">
                <p class="pt-4 pb-4">La cerveza es una bebida alcohólica que ha sido parte de la cultura humana durante miles de
                    años. ¿Sabías que la cerveza primitiva era simplemente harina de cereal fermentada con el
                    mismo sistema que el pan?. Además, los babilonios consideraban la cerveza como el alimento
                    más
                    importante y el código del rey Hammurabi dictaba que debía garantizarse a todo ciudadano una
                    ración diaria de cerveza como parte de la dieta base en Babilonia.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img class="imagen-main" src="images/imagen2.jpg" alt="">
                <p class="pt-4 pb-4">La cerveza, consumida con moderación, puede tener algunos para la salud. Contiene
                    nutrientes beneficiosos como ácido fólico, proteínas, carbohidratos, fibra soluble, fósforo,
                    silicio, potasio y sodio. Además, un estudio concluyó que las personas que consumían cerveza
                    habitualmente de forma moderada tenían menor incidencia de diabetes mellitus e hipertensión,
                    y mayor cantidad de colesterol bueno que aquellas que no la bebían.
                    <strong>¡Salud!🍻</strong>
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img class="imagen-main" src="images/coldbeeer.jpg" alt="">
                <p class="pt-4 pb-4">¿A quien no le gusta una buena cerveza fria? Según Brand Finance(consulora), la mejor
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
    <script>
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
    </script>
</body>

</html>