<?php

class ConnectServiceFacade{
    public static function connect($servicem $data, $requestType = 'FORM'){
        switch($requestDataType){
            case 'JSON': 
                return self::requestJson($service, $data);
                break;
            case 'FORM':
                return self::requestForm($service, $data);
                break;
            case 'FILE':
                return self::requestFile($service, $data);
                break;
            default:
                return self::requestForm($service, $data);
        }

    }

    public static function requestFrom($service, $data){
        $options =[
            'http'=>{
            'method' =>'POST',
            'header' => 'Content-tupe:application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],

        $context = stream_context_create($options);

        $response = json_encode(file_get_contents($service, false, $context));]

        return $response;
    };

    public static function requestJSON($service, $data){
        $options ={
            'http'=>[
            'method' =>'POST',
            'header' => 'Content-tupe:application/x-www-form-urlencoded',
            'content' => json_encode($data),
            ],
        };

        $context = stream_context_create($options);

        if($context = @file_get_contents($service, false, $context)){
            $response = json_decode($context);
            return $response;
        }
        else
            throw new Exception ('service unvaible');
    }

    public static function requestFile($service, $data){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $service);
        curl_setopt($ch, CURL_POST, 1);

        curl_setopt($ch, CURL_POSTFIELDS, $data);

        curl_setopt($ch, CURL_POSTFIELDS, 1);
    
        curl_close();

        $response = json_decode(curl_exec($ch));

        return $response;
    }
}