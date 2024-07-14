<?php
require_once "../db/db.php";
class Propietario{
    
    public $db;

    public function __construct() {
        $this->db = Db::conectar();
    }

    public function listarPropietario() {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("SELECT * FROM propietarios");

            $prepar->execute();

            return $prepar->fetchAll(PDO::FETCH_ASSOC);

            unset($prepar);
        } catch(PDOException $e) {
            echo "error en lista de datos: ". $e;
            return null;
        }
    }


    public function guardarPropietario($datos) {
        try {
            $prepar = $this->db->prepare("INSERT INTO propietarios (nombre, apellido, telefono, correo_electronico) 
                                          VALUES (:nombre, :apellido,:telefono, :correo_electronico)");
    
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':apellido', $datos["apellido"], PDO::PARAM_STR);
            $prepar->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
            $prepar->bindParam(':correo_electronico', $datos["correo_electronico"], PDO::PARAM_STR);    
            if ($prepar->execute()) {
                // Redireccionar a home.php con un mensaje de confirmación
                header('Location: ../vistaProp/homePropietario.php');
                exit();
            } else {
                return json_encode(array("estado" => 400, "report" => "NO se pudo realizar la operacion"));
            }
        } catch (PDOException $e) {
            return json_encode(array("estado" => 400, "report" => "Error al conectar a la base de datos: " . $e->getMessage()));
        } finally {
            $this->db = null; // Cerrar la conexión
        }
    }
    

    public function eliminarPropietario($datos) {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("DELETE FROM propietarios WHERE id = :id");

            $prepar -> bindParam(':id', $datos, PDO::PARAM_INT);

            if($prepar->execute()){
                return json_encode(
                    array("estado" => 200, 
                    "report"=> "ok")
                );
            }else{
                return json_encode(
                    array("estado" => 400, 
                    "report"=> "NO se pudo realizar la operacion")
                );
            }
            //unset($prepar);

        } catch(PDOException $e) {
            echo "error al conectar a la base de datos: ". $e;
            return null;
        }
    }
    
    public function updatePropietario($datos) {
        try {
            $prepar = $this->db->prepare("UPDATE propietarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo_electronico = :correo_electronico WHERE id = :id");
    
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':apellido', $datos["apellido"], PDO::PARAM_STR);
            $prepar->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
            $prepar->bindParam(':correo_electronico', $datos["correo_electronico"], PDO::PARAM_STR);
            $prepar->bindParam(':id', $datos["id"], PDO::PARAM_INT);
    
            if($prepar->execute()){
                // Redireccionar a home.php con un mensaje de confirmación
                header('Location: ../vistaProp/homePropietario.php');
                exit(); // Asegura que el script se detenga después de redirigir
            } else {
                return json_encode(
                    array("estado" => 400, 
                    "report"=> "NO se pudo realizar la operacion")
                );
            }
        } catch(PDOException $e) {
            echo "error al conectar a la base de datos: ". $e;
            return null;
        }
    }
    
    

}