<?php

abstract class Db {
    private static  $dsn = 'mysql:host=localhost;dbname=dbveterinaria';
    private static $usuario = 'root';
    private static $contrasena = '';
    public static $conexion;

    static function conectar() {
        try {
            self::$conexion = new PDO(self::$dsn, self::$usuario, self::$contrasena);

            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$conexion;
        } catch  (PDOException $e) {
            echo "error al conectar a la base de datos: " . $e->getMessage();
            return null;
        }
    }
    static function desconectar() {
        self::$conexion = null;
    }

    public function __destruct() {
        self::desconectar(); 
    }
}

