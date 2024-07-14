<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redireccionar al formulario de login
    header('Location: ../loginDoctor.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Control del Doctor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
   <!--MENU-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../img/logo.png" alt="" width="60px">
            Clínica Veterinaria Fairy
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <div class="navbar-text d-lg-none">
            <h2>¡Bienvenido, Doctor <?php echo $_SESSION['username']; ?>!</h2>
            </div>
            <div class="navbar-text d-none d-lg-block">
            <h2>¡Bienvenido, Doctor <?php echo $_SESSION['username']; ?>!</h2>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <a href="../inicio.php" class="btn btn-danger btn-lg mr-2">Cerrar Sesión</a>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        
        <div class="row">
            <div class="col-md-4">
                <h3>REGISTROS</h3>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="../vistaProp/homePropietario.php" class="btn btn-primary btn-block">Registrar Nueva Propietario</a>
                    </li>
                    <li class="mb-3">
                        <a href="../vistaMascota/homeMascota.php" class="btn btn-primary btn-block">Registrar Nuevo mascota</a>
                    </li>
                    <li class="mb-3">
                        <a href="../vistaAtencion/homeAtencion.php" class="btn btn-primary btn-block">Registrar Atención a Mascota</a>
                    </li>
                    <!-- Agrega más opciones según las acciones disponibles -->
                </ul>


            </div>
            <div class="col-md-8">
                <h3>REPORTES PARA DOCTORES</h3>
                <p>aqui se realizara los reportes para los doctores</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
