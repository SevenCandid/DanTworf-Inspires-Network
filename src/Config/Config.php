<?php

namespace App\Config;

use App\Core\Env;

class Config {
    // Database Configuration (reads from .env file)
    public static function getDbHost(): string { return Env::get('DB_HOST', 'localhost'); }
    public static function getDbPort(): string { return Env::get('DB_PORT', '3306'); }
    public static function getDbName(): string { return Env::get('DB_NAME', 'din_db'); }
    public static function getDbUser(): string { return Env::get('DB_USER', 'root'); }
    public static function getDbPass(): string { return Env::get('DB_PASS', ''); }

    // Application Configuration
    public static function getAppUrl(): string { return rtrim(Env::get('APP_URL', 'http://localhost'), '/'); }
    public static function getAppName(): string { return Env::get('APP_NAME', 'DANTWORF INSPIRES NETWORK'); }
    public static function getAppEnv(): string { return Env::get('APP_ENV', 'development'); }

    // MySQL DSN
    public static function getDbDsn(): string {
        return sprintf(
            "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
            self::getDbHost(),
            self::getDbPort(),
            self::getDbName()
        );
    }
}
