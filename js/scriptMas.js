function eliminarDoctor(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este Propietario?')) {
        fetch('../controller/Mascota.php?id=' + id, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.ok) {
                // Actualizar la pagina
                location.reload();
            } else {
                // Mostrar un mensaje de error si no se elimina al doctor
                alert('Error al eliminar el Mascota');
            }
        })
        .catch(error => console.error('Error:', error));
    }
  }
  function editarDoctor(id, nombre, especie, raza,  edad, propietario_id) {
    document.getElementById('idDoctorEditar').value = id;
    document.getElementById('nombreEditar').value = nombre;
    document.getElementById('especieEditar').value = especie;
    document.getElementById('razaEditar').value = raza;
    document.getElementById('edadEditar').value = edad;
    document.getElementById('propietario_idEditar').value = propietario_id;
  }
  
  function actualizarDoctor() {
    // Obtener los datos del formulario
    var formData = new FormData(document.getElementById("formEditarDoctor"));
  
    // Realizar una petición AJAX para enviar los datos al servidor
    fetch("../controller/Mascota.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del servidor
        console.log(data); // Puedes mostrar un mensaje de éxito o manejar errores aquí
    })
    .catch(error => {
        console.error('Error:', error);
    });
  }
  