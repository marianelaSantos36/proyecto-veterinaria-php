<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Para registro De atencion</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .container{
        background-image: url(../img/logoU.png);
    }
</style>
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
            <!-- Aquí puedes agregar elementos de menú si los necesitas -->
        </ul>
        <div class="navbar-text d-lg-none">
            <h2>¡REGISTRO ATENCION!</h2>
        </div>
        <div class="navbar-text d-none d-lg-block">
            <h2>¡REGISTRO ATENCION!</h2>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <a href="../vistaDoctor/HomeDoctor.php" class="btn btn-primary btn-lg mr-2">Volver Atras</a>
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
        <h3>Registro de Mascotas</h3>
        <!-- Formulario para guardar un nuevo doctor -->
        <form action="../controller/Atencion.php" method="POST" id="formGuardarDoctor">
            <div class="form-group">
                <input type="text" class="form-control" name="mascota_id" required placeholder="Id mascota">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="doctor_id" required placeholder="Id doctor">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="fecha" required placeholder="fecha">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="diagnostico" required placeholder="diagnostico">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="tratamiento" required placeholder="tratamiento">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Mascota</button>
        </form>
        <br>
        
      </div>
      <div class="col-md-8">
        <div class="table-responsive">
          <h3>Lista de atencion</h3>
        
          <?php
            require_once "../class/ModelAtencion.php";
            $doctor = new Atencion();
            $doctores = $doctor->listarAtencion();
            if ($doctores) {
                // Mostrar los datos en una tabla HTML
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Id mascota</th>';
                echo '<th>Id doctor</th>';
                echo '<th>fecha</th>';
                echo '<th>diagnostico</th>';
                echo '<th>tratamiento</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Mostrar a los doctores de la base de datos
                foreach ($doctores as $doctor) {
                    echo '<tr>';
                    echo '<td>' . $doctor['mascota_id'] . '</td>';
                    echo '<td>' . $doctor['doctor_id'] . '</td>';
                    echo '<td>' . $doctor['fecha'] . '</td>';
                    echo '<td>' . $doctor['diagnostico'] . '</td>';
                    echo '<td>' . $doctor['tratamiento'] . '</td>';
                    // Agregar botones de editar y eliminar para cada doctor
                    /*echo '<td><button class="btn btn-primary" onclick="editarDoctor(' . $doctor['id'] . ', \'' . $doctor['mascota_id'] . '\', \'' . $doctor['doctor_id'] . '\', \'' . $doctor['fecha'] . '\', \'' . $doctor['dignostico'] . '\', \'' . $doctor['tratamiento'] . '\', \''  . '\')">Editar</button></td>';
                    echo '<td><button class="btn btn-danger" onclick="eliminarDoctor(' . $doctor['id'] . ')">Eliminar</button></td>';
                    */echo '</tr>';
                }


                echo '</tbody>';
                echo '</table>';
            } else {
                // Mensaje por si no se obtiene nada 
                echo '<p>No se encontraron mascotaas en la base de datos.</p>';
            }
            ?>
          <h3>Lista de Doctores</h3>
        
        <?php
          require_once "../class/ModelDoctor.php";
          $doctor = new Doctor();
          $doctores = $doctor->ListarDoctor();
          if ($doctores) {
              // Mostrar los datos en una tabla HTML
              echo '<table class="table table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th>ID</th>';
              echo '<th>Nombre</th>';
              echo '<th>Apellido</th>';
              echo '<th>Especialidad</th>';
              echo '<th>Correo Electrónico</th>';
              echo '<th>Username</th>';
              echo '<th>Contraseña</th>';
              echo '<th>Teléfono</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';

              // Mostrar a los doctores de la base de datos
              foreach ($doctores as $doctor) {
                  echo '<tr>';
                  echo '<td>' . $doctor['id'] . '</td>';
                  echo '<td>' . $doctor['nombre'] . '</td>';
                  echo '<td>' . $doctor['apellido'] . '</td>';
                  echo '<td>' . $doctor['especialidad'] . '</td>';
                  echo '<td>' . $doctor['correo_electronico'] . '</td>';
                  echo '<td>' . $doctor['username'] . '</td>';
                  echo '<td>' . $doctor['password'] . '</td>';
                  echo '<td>' . $doctor['telefono'] . '</td>';
                  // Agregar botones de editar y eliminar para cada doctor
                  echo '<td><button class="btn btn-primary" onclick="editarDoctor(' . $doctor['id'] . ', \'' . $doctor['nombre'] . '\', \'' . $doctor['apellido'] . '\', \'' . $doctor['especialidad'] . '\', \'' . $doctor['correo_electronico'] . '\', \'' . $doctor['username'] . '\', \'' . $doctor['password'] . '\', \'' . $doctor['telefono'] . '\')">Editar</button></td>';
                  echo '<td><button class="btn btn-danger" onclick="eliminarDoctor(' . $doctor['id'] . ')">Eliminar</button></td>';
                  echo '</tr>';
              }


              echo '</tbody>';
              echo '</table>';
          } else {
              echo '<p>No se encontraron doctores en la base de datos.</p>';
          }
          ?>   <h3>Lista de mascotas</h3>
            
            <?php
            require_once "../class/ModelMascota.php";
            $doctor = new Mascota();
            $doctores = $doctor->listarMascota();
            if ($doctores) {
                // Mostrar los datos en una tabla HTML
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nombre</th>';
                echo '<th>Apellido</th>';
                echo '<th>Especie</th>';
                echo '<th>raza</th>';
                echo '<th>edad</th>';
                echo '<th>Id prop</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($doctores as $doctor) {
                    echo '<tr>';
                    echo '<td>' . $doctor['id'] . '</td>';
                    echo '<td>' . $doctor['nombre'] . '</td>';
                    echo '<td>' . $doctor['especie'] . '</td>';
                    echo '<td>' . $doctor['raza'] . '</td>';
                    echo '<td>' . $doctor['edad'] . '</td>';
                    echo '<td>' . $doctor['propietario_id'] . '</td>';
                    echo '<td><button class="btn btn-primary" onclick="editarDoctor(' . $doctor['id'] . ', \'' . $doctor['nombre'] . '\', \'' . $doctor['especie'] . '\', \'' . $doctor['raza'] . '\', \'' . $doctor['edad'] . '\', \'' . $doctor['propietario_id'] . '\', \''  . '\')">Editar</button></td>';
                    echo '<td><button class="btn btn-danger" onclick="eliminarDoctor(' . $doctor['id'] . ')">Eliminar</button></td>';
                    echo '</tr>';
                }


                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontraron mascotaas en la base de datos.</p>';
            }
            ?>
         
          
    
      </div>
    </div>
  </div>
</div>
<!--<script src="../js/scriptMas.js"></script>  
        -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>