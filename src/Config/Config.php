<?php

namespace App\Config;

use App\Core\Env;

class Config {
    // Database Configuration
    public static function getDbHost(): string { return Env::get('DB_HOST', 'localhost'); }
    public static function getDbPort(): string { return Env::get('DB_PORT', '5432'); }
    public static function getDbName(): string { return Env::get('DB_NAME', 'din_db'); }
    public static function getDbUser(): string { return Env::get('DB_USER', 'postgres'); }
    public static function getDbPass(): string { return Env::get('DB_PASS', 'password'); }

    // Application Configuration
    public static function getAppUrl(): string { return rtrim(Env::get('APP_URL', 'http://localhost/DIN/public'), '/'); }
    public static function getAppName(): string { return Env::get('APP_NAME', 'DANTWORF INSPIRES NETWORK'); }
    public static function getAppEnv(): string { return Env::get('APP_ENV', 'development'); }

    public static function getDbDsn(): string {
        return sprintf("pgsql:host=%s;port=%s;dbname=%s", self::getDbHost(), self::getDbPort(), self::getDbName());
    }
}
