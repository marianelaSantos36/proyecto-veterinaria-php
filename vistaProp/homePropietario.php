<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Doctor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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
            <h2>¡DATOS PROPIETARIO!</h2>
        </div>
        <div class="navbar-text d-none d-lg-block">
            <h2>¡DATOS PROPIETARIO!</h2>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <a href="loginAdmi.php" class="btn btn-primary btn-lg mr-2">Ver reportes</a>
            <a href="../inicio.php" class="btn btn-danger btn-lg mr-2">Cerrar Sesión</a>
        </form>
    </div>
</nav>


<?php
// Verificar si hay un mensaje en la URL
if (isset($_GET['mensaje'])) {
    $mensaje = htmlspecialchars($_GET['mensaje']);
    echo "<div id='mensaje' class='alert alert-success'>$mensaje</div>";
}
?>


<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">

        <!-- Formulario para  hacer CRUD -->
        <h3>Registro de Propietario</h3>
        <form action="../controller/Propietario.php" method="POST" id="formGuardarDoctor">
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="apellido" required placeholder="Apellido">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" name="telefono" required placeholder="Teléfono">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="correo_electronico" required placeholder="Correo electrónico">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Doctor</button>
        </form>
        <br>
        <h3>Editar Propietario</h3>
        <form action="../controller/Propietario.php" method="POST" id="formEditarDoctor">
            <input type="hidden" id="idDoctorEditar" name="id">
            <div class="form-group">
                <input type="text" class="form-control" id="nombreEditar" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="apellidoEditar" name="apellido" required placeholder="Apellido">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" id="telefonoEditar" name="telefono" required placeholder="Teléfono">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="correoEditar" name="correo_electronico" required placeholder="Correo electrónico">
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar Doctor</button>
        </form>
      </div>
      <div class="col-md-8">
        <div class="table-responsive">
          <h3>Lista de Propietarios</h3>
          <?php
            require_once "../class/ModelPropietario.php";
            $doctor = new Propietario();
            $doctores = $doctor->listarPropietario();
            if ($doctores) {
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nombre</th>';
                echo '<th>Apellido</th>';
                echo '<th>Teléfono</th>';
                echo '<th>Correo Electrónico</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($doctores as $doctor) {
                    echo '<tr>';
                    echo '<td>' . $doctor['id'] . '</td>';
                    echo '<td>' . $doctor['nombre'] . '</td>';
                    echo '<td>' . $doctor['apellido'] . '</td>';
                    echo '<td>' . $doctor['telefono'] . '</td>';
                    echo '<td>' . $doctor['correo_electronico'] . '</td>';
                    echo '<td><button class="btn btn-primary" onclick="editarDoctor(' . $doctor['id'] . ', \'' . $doctor['nombre'] . '\', \'' . $doctor['apellido'] .  '\', \'' . $doctor['telefono'].'\', \'' . $doctor['correo_electronico']  . '\')">Editar</button></td>';
                    echo '<td><button class="btn btn-danger" onclick="eliminarDoctor(' . $doctor['id'] . ')">Eliminar</button></td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontraron doctores en la base de datos.</p>';
            }
            ?>
    
      </div>
    </div>
  </div>
</div>
<script src="../js/scriptProp.js"></script>  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>