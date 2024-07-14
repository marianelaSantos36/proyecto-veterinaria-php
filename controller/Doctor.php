<?php 
include "../class/ModelDoctor.php";
include "../conf/interfaz.php";

//abstract 
class DoctorController implements Controller
{
    static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alan = new Doctor();
            $datos = [
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "especialidad" => $_POST["especialidad"],
                "correo_electronico" => $_POST["correo_electronico"],
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "telefono" => $_POST["telefono"]
            ];
            header('Content-Type: application/json');
            return $alan->guardarDoctor($datos);
        }
    }
    static function eliminar(){
        $alan = new Doctor();
        $datos = $_GET["id"];
        header('Content-Type: application/json');
        return($alan->eliminarDoctor($datos));
        # code...
    }
    static function editar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $alan = new Doctor();
            $datos = [
                "id" => $_POST["id"],
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "especialidad" => $_POST["especialidad"],
                "correo_electronico" => $_POST["correo_electronico"],
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "telefono" => $_POST["telefono"]
            ];
            header('Content-Type: application/json');
            return $alan->updateDoctor($datos);
        }
    }
    static function listar(){
        $alan = new Doctor();
        header('Content-Type: application/json');
        return $alan->ListarDoctor();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $perList = DoctorController::listar();
    echo json_encode($perList);
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $perList = DoctorController::eliminar();
    echo json_encode($perList);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $perList = DoctorController::editar();
    } else {
        $perList = DoctorController::guardar();
    }
    echo $perList;
}

