<?php

require_once __DIR__ . '/../config/config.php';

class Db
{
    // Istanza unica PDO (Singleton)
    private static ?PDO $instance = null;

    // Impedisce istanziazione della classe
    private function __construct() {}

    // Connessione al database
    public static function connect(): PDO
    {
        if (self::$instance === null) {

            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);

            } catch (PDOException $e) {

                error_log('DB CONNECTION ERROR: ' . $e->getMessage());

                die('Errore di connessione al database.');
            }
        }

        return self::$instance;
    }

    // Alias per compatibilità con vecchio codice
    public static function getConnection(): PDO
    {
        return self::connect();
    }
}