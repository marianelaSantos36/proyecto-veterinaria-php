<?php
session_start();

// Simulación de base de datos de usuarios
$usuarios = array(
    'usuario1' => 'contraseña1',
    'usuario2' => 'contraseña2',
    // ADMINISTRADORES POR DEFECTO
);

// Verifica si se enviaron datos de inicio de sesión
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // VERIFICAR SI USUARIO Y CONTRASEÑA SON CORRECTOS 
    if (array_key_exists($username, $usuarios) && $usuarios[$username] == $password) {
        // Inicia sesión y redirige al usuario a la página de inicio
        $_SESSION['username'] = $username;
        header('Location: ../vistaAdmi/home.php');
        exit;
    } else {
        // Si el usuario o la contraseña son incorrectos, muestra un mensaje de error
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
