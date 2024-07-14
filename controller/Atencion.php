<?php 
include "../class/ModelAtencion.php";
include "../conf/interfaz.php";



//abstract 
class AtencionController// implements Controller
{
    static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alan = new Atencion();
            $datos = [
                "mascota_id" => $_POST["mascota_id"],
                "doctor_id" => $_POST["doctor_id"],
                "fecha" => $_POST["fecha"],
                "diagnostico" => $_POST["diagnostico"],
                "tratamiento" => $_POST["tratamiento"]
            ];
            header('Content-Type: application/json');
            return $alan->guardarAtencion($datos);
        }
    }
    static function listar(){
        $alan = new Atencion();
        header('Content-Type: application/json');
        return $alan->listarAtencion();
    }
}

/**
 * GET, solo para listar datos.
 * enviar datos por la url.
 */
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $perList = AtencionController::listar();
    echo json_encode($perList);
}
//para mandar datos de manera cifrado.



/*/*
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $perList = AtencionController::eliminar();
    echo json_encode($perList);
}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $perList = AtencionController::editar();
    echo $perList;
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $perList = AtencionController::editar();
    echo $perList;
}*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si es una solicitud para guardar un nuevo doctor o editar uno existente
    $perList = AtencionController::guardar();
    //echo $perList;
}

