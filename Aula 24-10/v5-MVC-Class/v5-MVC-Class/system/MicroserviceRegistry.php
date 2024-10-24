<?php

class MicroserviceRegistry{
    private static $registry = [];

    public static function set($key, $value){
        self::registry[$key] = $value;
    }

    public static function get($key){
        if(isset(self::$registry[$key]))
            return self::$registry[$key];
        return NULL;
    }

    public static function has($key){
        return isset(self::$registry[$key]);
    }

    public static function connect($service,$data){
        $options = [
            'https' => [
                'method' =>'POST',
                'header' =>'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query ($data),
            ],
        ];

        $context = stream_context_create($options);

        $response = json_decode(file_get_contents ($service,FALSE,$context));

        return $response;
    }
}