<?php

header('Content-Type:: aplication/json');

try{
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $creditCarrdNumber = $_POST['creditCardNumber'];
        $amount = $_POST['amout'];

        $response = ['message' => 'Payment completed sucessfully'];

        echo json_encode [$reponse];
    };
    else
        throw new Exception('Method not permited');
} catch(Exception $e){
    echo json_encode (['error' =>$e->getMessage()]);
}