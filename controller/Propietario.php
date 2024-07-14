<?php 
include "../class/ModelPropietario.php";
include "../conf/interfaz.php";



//abstract 
class PropietarioController
{
    static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alan = new Propietario();
            $datos = [
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "telefono" => $_POST["telefono"],
                "correo_electronico" => $_POST["correo_electronico"]
            ];
            header('Content-Type: application/json');
            return $alan->guardarPropietario($datos);
        }
    }
    static function eliminar(){
        $alan = new Propietario();
        $datos = $_GET["id"];
        header('Content-Type: application/json');
        return($alan->eliminarPropietario($datos));
        # code...
    }
    static function editar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $alan = new Propietario();
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
            return $alan->updatePropietario($datos);
        }
    }
    /*static function listar(){
        $alan = new Propietario();
        header('Content-Type: application/json');
        return $alan->listarPropietario();
    }*/
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $perList = PropietarioController::eliminar();
    echo json_encode($perList);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si es una solicitud para guardar un nuevo doctor o editar uno existente
    if (isset($_POST['id'])) {
        $perList = PropietarioController::editar();
    } else {
        $perList = PropietarioController::guardar();
    }
    echo $perList;
}

