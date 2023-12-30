<?php

class Database
{
    private static $prefijo = '';
    private static $dbName = 'crud_mvc_oop';
    private static $dbHost = 'localhost';
    private static $port = '3306';
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'root';
    private static $conn = null;

    public function __construct()
    {
        // die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if (null == self::$conn) {
            try {

               self::$conn = new PDO("mysql:host=" . self::$dbHost . ";port=" . self::$port . ";dbname=" . self::$prefijo . self::$dbName, self::$dbUsername, self::$dbUserPassword);

            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }
}

?>
