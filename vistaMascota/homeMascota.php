<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Para registro mascotas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!--NAVEGADOR-->
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
                <h2>¡REGISTRO MASCOTAS!</h2>
            </div>
            <div class="navbar-text d-none d-lg-block">
                <h2>¡REGISTRO MASCOTAS!</h2>
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

        <!-- REGISTRO DE MASCOTAS -->
        <!--<h3>Registro de Mascotas</h3>
        <form action="../controller/Mascota.php" method="POST" id="formGuardarDoctor">
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="especie" required placeholder="especie">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="raza" required placeholder="raza">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="edad" required placeholder="Edad">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="propietario_id" required placeholder="Id de propietario">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Mascota</button>
        </form>-->
        <form id="registroMascForm">
            <h3>Registro de Mascota</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="especie" required placeholder="especie">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="raza" required placeholder="raza">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="edad" required placeholder="Edad">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="propietario_id" required placeholder="Id de propietario">
            </div>
            <button type="button" onclick="enviarFormularioRegistro()" class="btn btn-success">Guardar Macota</button>
            </form>
        <br>
        <h3>Editar Mascota</h3>
        <!-- EDITAR MASCOTA -->
        <form action="../controller/Mascota.php" method="POST" id="formEditarDoctor">
            <input type="hidden" id="idDoctorEditar" name="id">
            <div class="form-group">
                <input type="text" class="form-control" id="nombreEditar" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="especieEditar" name="especie" required placeholder="especie">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="razaEditar" name="raza" required placeholder="raza">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="edadEditar" name="edad" required placeholder="Edad">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="propietario_idEditar" name="propietario_id" required placeholder="Id de propietario">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Mascotas</button>
        </form>


      </div>
      <div class="col-md-8">
        <div class="table-responsive">
          <h3>Lista de Mascotas</h3>
        
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

                // Mostrar a los doctores de la base de datos
                foreach ($doctores as $doctor) {
                    echo '<tr>';
                    echo '<td>' . $doctor['id'] . '</td>';
                    echo '<td>' . $doctor['nombre'] . '</td>';
                    echo '<td>' . $doctor['especie'] . '</td>';
                    echo '<td>' . $doctor['raza'] . '</td>';
                    echo '<td>' . $doctor['edad'] . '</td>';
                    echo '<td>' . $doctor['propietario_id'] . '</td>';
                    // Agregar botones de editar y eliminar para cada doctor
                    echo '<td><button class="btn btn-primary" onclick="editarDoctor(' . $doctor['id'] . ', \'' . $doctor['nombre'] . '\', \'' . $doctor['especie'] . '\', \'' . $doctor['raza'] . '\', \'' . $doctor['edad'] . '\', \'' . $doctor['propietario_id'] . '\', \''  . '\')">Editar</button></td>';
                    echo '<td><button class="btn btn-danger" onclick="eliminarDoctor(' . $doctor['id'] . ')">Eliminar</button></td>';
                    echo '</tr>';
                }


                echo '</tbody>';
                echo '</table>';
            } else {
                // Mensaje por si no se obtiene nada 
                echo '<p>No se encontraron mascotaas en la base de datos.</p>';
            }
            ?>
            <h3>Lista de Propietarios</h3>
          <?php
            require_once "../class/ModelPropietario.php";
            $doctor = new Propietario();
            $doctores = $doctor->listarPropietario();
            if ($doctores) {
                // Mostrar los datos en una tabla HTML
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

                // Mostrar a los doctores de la base de datos
                foreach ($doctores as $doctor) {
                    echo '<tr>';
                    echo '<td>' . $doctor['id'] . '</td>';
                    echo '<td>' . $doctor['nombre'] . '</td>';
                    echo '<td>' . $doctor['apellido'] . '</td>';
                    echo '<td>' . $doctor['telefono'] . '</td>';
                    echo '<td>' . $doctor['correo_electronico'] . '</td>';
                    // Agregar botones de editar y eliminar para cada doctor
                   echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                // Mensaje por si no se obtiene nada 
                echo '<p>No se encontraron doctores en la base de datos.</p>';
            }
            ?>
    
      </div>
    </div>
  </div>
</div>
<script src="../js/scriptMas.js"></script>  
<script>
    function enviarFormularioRegistro() {
        var formData = new FormData(document.getElementById("registroMascForm"));
        fetch("../controller/Mascota.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
                if (response.ok) {
                    location.reload();
                    alert('REGISTRO EXITOSO');
                } else {
                    alert('Error al registrar  mascota');
                }
            })
            .catch(error => console.error('Error:', error));
    }
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el elemento del mensaje por su ID
        var mensaje = document.getElementById('mensaje');
        
        // Ocultar el mensaje después de 5 segundos
        setTimeout(function() {
            mensaje.style.display = 'none';
        }, 5000); // 5000 milisegundos = 5 segundos
    });

    function editarDoctor(id, nombre, especie, raza,  edad, propietario_id) {
        document.getElementById('idDoctorEditar').value = id;
        document.getElementById('nombreEditar').value = nombre;
        document.getElementById('especieEditar').value = especie;
        document.getElementById('razaEditar').value = raza;
        document.getElementById('edadEditar').value = edad;
        document.getElementById('propietario_idEditar').value = propietario_id;
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>