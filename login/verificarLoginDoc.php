<?php
session_start();
require_once "../db/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = Db::conectar();

    try {
        // Preguntar si los datos del formulario estan en la base de datos
        $consulta = $db->prepare("SELECT * FROM doctores WHERE username = :username AND password = :password");
        $consulta->bindParam(':username', $username);
        $consulta->bindParam(':password', $password);
        $consulta->execute();
        $doctor = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($doctor) {
            // si es verdadero 
            $_SESSION['username'] = $username;
            // Respuesta JSON de que esta bien
            echo json_encode(array("success" => true));
            exit();
        } else {
            // Si incorrecto mandar JSON  de que Fallo
            echo json_encode(array("success" => false));
            exit();
        }
    } catch (PDOException $e) {
        // Si no se conecta a base de datos
        echo json_encode(array("success" => false, "error" => "Error al conectar a la base de datos: " . $e->getMessage()));
        exit();
    }
}

// Si se accede al script de forma incorrecta
echo json_encode(array("success" => false, "error" => "Acceso no permitido"));
exit();
?>
