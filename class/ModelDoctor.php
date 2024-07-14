<?php
require_once "../db/db.php";
class Doctor{
    
    public $db;

    public function __construct() {
        $this->db = Db::conectar();
    }

    public function ListarDoctor() {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("SELECT * FROM doctores");

            $prepar->execute();

            return $prepar->fetchAll(PDO::FETCH_ASSOC);

            unset($prepar);
        } catch(PDOException $e) {
            echo "error en lista de datos: ". $e;
            return null;
        }
    }


    public function guardarDoctor($datos) {
        try {
            $prepar = $this->db->prepare("INSERT INTO doctores (nombre, apellido, especialidad, correo_electronico, username, password, telefono) 
                                          VALUES (:nombre, :apellido, :especialidad, :correo_electronico, :username, :password, :telefono)");
    
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':apellido', $datos["apellido"], PDO::PARAM_STR);
            $prepar->bindParam(':especialidad', $datos["especialidad"], PDO::PARAM_STR);
            $prepar->bindParam(':correo_electronico', $datos["correo_electronico"], PDO::PARAM_STR);
            $prepar->bindParam(':username', $datos["username"], PDO::PARAM_STR);
            $prepar->bindParam(':password', $datos["password"], PDO::PARAM_STR);
            $prepar->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
    
            if ($prepar->execute()) {
                // Redireccionar a home.php con un mensaje de confirmación
                header('Location: ../vistaAdmi/home.php');
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
    

    public function eliminarDoctor($datos) {
        try {
            //listar datos de mi base de datos..... dbejmplo
            $prepar = $this->db->prepare("DELETE FROM doctores WHERE id = :id");

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
    
    public function updateDoctor($datos) {
        try {
            $prepar = $this->db->prepare("UPDATE doctores SET nombre = :nombre, apellido = :apellido, especialidad = :especialidad, correo_electronico = :correo_electronico, username = :username, password = :password, telefono = :telefono WHERE id = :id");
    
            $prepar->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
            $prepar->bindParam(':apellido', $datos["apellido"], PDO::PARAM_STR);
            $prepar->bindParam(':especialidad', $datos["especialidad"], PDO::PARAM_STR);
            $prepar->bindParam(':correo_electronico', $datos["correo_electronico"], PDO::PARAM_STR);
            $prepar->bindParam(':username', $datos["username"], PDO::PARAM_STR);
            $prepar->bindParam(':password', $datos["password"], PDO::PARAM_STR);
            $prepar->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
            $prepar->bindParam(':id', $datos["id"], PDO::PARAM_INT);
    
            if($prepar->execute()){
                header('Location: ../vistaAdmi/home.php');
                exit(); 
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