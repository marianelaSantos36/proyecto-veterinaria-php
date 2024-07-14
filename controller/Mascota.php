<?php 
include "../class/ModelMascota.php";
include "../conf/interfaz.php";



//abstract 
class MascotaController// implements Controller
{
    static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alan = new Mascota();
            $datos = [
                "nombre" => $_POST["nombre"],
                "especie" => $_POST["especie"],
                "raza" => $_POST["raza"],
                "edad" => $_POST["edad"],
                "propietario_id" => $_POST["propietario_id"]
            ];
            header('Content-Type: application/json');
            return $alan->guardarMascotas($datos);
        }
    }
    static function eliminar(){
        $alan = new Mascota();
        $datos = $_GET["id"];
        header('Content-Type: application/json');
        return($alan->eliminarMascota($datos));
        # code...
    }
    static function editar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $alan = new Mascota();
            $datos = [
                "id" => $_POST["id"],
                "nombre" => $_POST["nombre"],
                "especie" => $_POST["especie"],
                "raza" => $_POST["raza"],
                "edad" => $_POST["edad"],
                "propietario_id" => $_POST["propietario_id"]
            ];
            header('Content-Type: application/json');
            return $alan->updateMascota($datos);
        }
    }
    static function listar(){
        $alan = new Mascota();
        header('Content-Type: application/json');
        return $alan->listarMascota();
    }
}

/**
 * GET, solo para listar datos.
 * enviar datos por la url.
 */
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $perList = MascotaController::listar();
    echo json_encode($perList);
}
//para mandar datos de manera cifrado.




if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $perList = MascotaController::eliminar();
    echo json_encode($perList);
}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $perList = MascotaController::editar();
    echo $perList;
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $perList = MascotaController::editar();
    echo $perList;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si es una solicitud para guardar un nuevo doctor o editar uno existente
    if (isset($_POST['id'])) {
        $perList = MascotaController::editar();
    } else {
        $perList = MascotaController::guardar();
    }
    echo $perList;
}

