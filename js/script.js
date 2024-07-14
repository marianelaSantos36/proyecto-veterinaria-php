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
                        <button class="btn btn-danger" onclick="eliminarDoctor(${doctor.id})">Eliminar</button>
                    </td>
                </tr>`;
        });
        document.getElementById("listaDoctores").innerHTML = tableRows;
    })
    .catch(error => console.error('Error:', error));
}
// Llama a función de listar doctores 
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