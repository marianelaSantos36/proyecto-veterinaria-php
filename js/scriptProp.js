function eliminarDoctor(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este Propietario?')) {
        fetch('../controller/Propietario.php?id=' + id, {
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
  
  
  function actualizarDoctor() {
    var formData = new FormData(document.getElementById("formEditarDoctor"));
  
    fetch("../controller/Propietario.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); 
    })
    .catch(error => {
        console.error('Error:', error);
    });
  }
  