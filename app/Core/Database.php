<?php

namespace App\Core;

use mysqli;

class Database {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            self::$instance = new mysqli($config['host'], $config['user'], $config['pass'], $config['db']);
            
            if (self::$instance->connect_error) {
                die("Connection failed: " . self::$instance->connect_error);
            }
        }
        return self::$instance;
    }
}
