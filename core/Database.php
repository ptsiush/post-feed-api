<?php
class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
