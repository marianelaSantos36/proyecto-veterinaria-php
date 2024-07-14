<?php
require_once "../db/db.php";
class Mascota{
    
    public $db;

    public function __construct() {
        $this->db = Db::conectar();
    }

    public function listarMascota() {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("SELECT * FROM mascotas");

            $prepar->execute();

            return $prepar->fetchAll(PDO::FETCH_ASSOC);

            unset($prepar);
        } catch(PDOException $e) {
            echo "error en lista de datos: ". $e;
            return null;
        }
    }


    public function guardarMascotas($datos) {
        try {
            $prepar = $this->db->prepare("INSERT INTO mascotas (nombre, especie, raza, edad, propietario_id) 
                                          VALUES (:nombre, :especie, :raza, :edad, :propietario_id)");
    
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':especie', $datos["especie"], PDO::PARAM_STR);
            $prepar->bindParam(':raza', $datos["raza"], PDO::PARAM_STR);
            $prepar->bindParam(':edad', $datos["edad"], PDO::PARAM_INT);  
            $prepar->bindParam(':propietario_id', $datos["propietario_id"], PDO::PARAM_INT);   
            if ($prepar->execute()) {
                // Redireccionar a home.php con un mensaje de confirmación
                header('Location: ../vistaMascota/homeMascota.php');
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
    

    public function eliminarMascota($datos) {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("DELETE FROM mascotas WHERE id = :id");

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
    
    public function updateMascota($datos) {
        try {
            $prepar = $this->db->prepare("UPDATE mascotas SET nombre = :nombre, especie = :especie, raza = :raza, edad = :edad, propietario_id= :propietario_id WHERE id = :id");
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':especie', $datos["especie"], PDO::PARAM_STR);
            $prepar->bindParam(':raza', $datos["raza"], PDO::PARAM_STR);
            $prepar->bindParam(':edad', $datos["edad"], PDO::PARAM_INT);  
            $prepar->bindParam(':propietario_id', $datos["propietario_id"], PDO::PARAM_INT);   
            $prepar->bindParam(':id', $datos["id"], PDO::PARAM_INT);
    
            if($prepar->execute()){
                // Redireccionar a home.php con un mensaje de confirmación
                header('Location: ../vistaMascota/homeMascota.php');
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