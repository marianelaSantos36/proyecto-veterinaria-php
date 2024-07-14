<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administrador</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    
    h3{
        color: black;
    }
    .table{
        background-color: white;
    }
    form {
    background-color: rgba(245, 245, 245, 0.8); 
    }
    body{
        background-image: url(../img/fondiii.jpg);
        background-size: cover; 
    }
</style>
<body>
    <!--NAVEGADOR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../img/logoU.png" alt="" width="60px">
            Clínica Veterinaria Fairy
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <div class="navbar-text d-lg-none">
                <h2>¡Bienvenido, Administrador!</h2>
            </div>
            <div class="navbar-text d-none d-lg-block">
                <h2>¡Bienvenido, Administrador!</h2>
            </div>
            <a href="loginAdmi.php" class="btn btn-primary btn-lg mr-2">Ver reportes</a>
                <a href="../inicio.php" class="btn btn-danger btn-lg mr-2">Cerrar Sesión</a>      
        </div>
    </nav>
    <!--TODO MI CONTENIDO-->
    <div class="container mt-5">
        <div class="row">
        <div class="col-md-4">
            <!-- PARA GUARDAR DOCTORES -->      
            <form id="registroDoctorForm">
                <h3>Registro de Doctor</h3>
                <div class="form-group">
                    <input type="text" class="form-control" name="nombre" required placeholder="Nombre">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="apellido" required placeholder="Apellido">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="especialidad" required placeholder="Especialidad">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="correo_electronico" required placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" required placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" required placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="telefono" required placeholder="Teléfono">
                </div>
                <button type="button" onclick="enviarFormularioRegistro()" class="btn btn-success">Guardar Doctor</button>
            </form>
            <br>
            <!--PARA EDITAR A LOS DOCTORES-->
            <form action="../controller/Doctor.php" method="POST" id="formEditarDoctor" onsubmit="event.preventDefault(); actualizarDoctor();">
                <h3>Editar Doctor</h3>
                <input type="hidden" id="idDoctorEditar" name="id">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombreEditar" name="nombre" required placeholder="Nombre">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="apellidoEditar" name="apellido" required placeholder="Apellido">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="especialidadEditar" name="especialidad" required placeholder="Especialidad">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="correoEditar" name="correo_electronico" required placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="usernameEditar" name="username" required placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="passwordEditar" name="password" required placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" id="telefonoEditar" name="telefono" required placeholder="Teléfono">
                </div>
                
                <button type="submit" class="btn btn-primary">Actualizar Doctor</button>
            </form>
        </div>
        <!--PARA LISTAR A MIS DOCTORES-->
        <div class="col-md-8">
            <div class="table-responsive">
            <h3 style="color: white;">Lista de Doctores</h3>
            <table class="table table-striped" id="listaDoctores">
                <!-- EDATOS DE DOCTOR -->
            </table>
            </div>
        </div>
    </div>
</div>

<script>
    //GUARDAR DOCTORES
    function enviarFormularioRegistro() {
        var formData = new FormData(document.getElementById("registroDoctorForm"));
        fetch("../controller/Doctor.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
                if (response.ok) {
                    location.reload();
                    alert('REGISTRO EXITOSO');
                } else {
                    alert('Error al registrar  doctor');
                }
            })
            .catch(error => console.error('Error:', error));
    }
    //FUNCION LISTAR DOCTORES
    const listarDoctores = () => {
        fetch("../controller/Doctor.php")
        .then(response => response.json())
        .then(data => {
            let tableRows = "";
            data.forEach(doctor => {
                tableRows += `
                    <tr>
                        <td>${doctor.id}</td>
                        <td>${doctor.nombre}</td>
                        <td>${doctor.apellido}</td>
                        <td>${doctor.especialidad}</td>
                        <td>${doctor.correo_electronico}</td>
                        <td>${doctor.username}</td>
                        <td>${doctor.password}</td>
                        <td>${doctor.telefono}</td>
                        <td>
                            <button class="btn btn-primary" onclick="editarDoctor(${doctor.id}, '${doctor.nombre}', '${doctor.apellido}', '${doctor.especialidad}', '${doctor.correo_electronico}', '${doctor.username}', '${doctor.password}', '${doctor.telefono}')">Editar</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="eliminarDoctor(${doctor.id})">Eliminar</button>
                        </td>
                    </tr>`;
            });
            document.getElementById("listaDoctores").innerHTML = tableRows;
        })
        .catch(error => console.error('Error:', error));
    }
    // Llamamos a función de listar doctores 
    document.addEventListener("DOMContentLoaded", function() {
        listarDoctores();
    });

    function eliminarDoctor(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este doctor?')) {
            fetch('../controller/Doctor.php?id=' + id, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Error al eliminar el doctor');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // PARA EDITAR SE VAYAN AL FORMULARIO DE EDITAR
    function editarDoctor(id, nombre, apellido, especialidad, correo, username, password, telefono) {
        document.getElementById("idDoctorEditar").value = id;
        document.getElementById("nombreEditar").value = nombre;
        document.getElementById("apellidoEditar").value = apellido;
        document.getElementById("especialidadEditar").value = especialidad;
        document.getElementById("correoEditar").value = correo;
        document.getElementById("usernameEditar").value = username;
        document.getElementById("passwordEditar").value = password;
        document.getElementById("telefonoEditar").value = telefono;
    }

    // PARA ENVIAR LOS DATOS A LA BASE DE DATOS
    function actualizarDoctor() {
        var formData = new FormData(document.getElementById("formEditarDoctor"));
        fetch("../controller/Doctor.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Error al actualizar el seleccionado doctor');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>