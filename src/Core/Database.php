<?php

namespace App\Core;

use App\Config\Config;
use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = Config::getDbDsn();
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                self::$instance = new PDO($dsn, Config::getDbUser(), Config::getDbPass(), $options);
            } catch (PDOException $e) {
                // In production, log error instead of displaying
                die('Database Connection Failed: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
