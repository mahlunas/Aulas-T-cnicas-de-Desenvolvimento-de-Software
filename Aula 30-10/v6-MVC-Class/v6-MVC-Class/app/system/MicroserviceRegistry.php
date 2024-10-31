<?php

class MicroserviceRegistry {
    private static $registry = [];

    public static function set($key, $value)
    {
        self::$registry[$key] = $value;
    }

    public static function get($key) 
    {
        if (isset(self::$registry[$key])) 
            return self::$registry[$key];
        
        return null;
    }

    public static function has($key)
    {
        return isset(self::$registry[$key]);
    }
}
