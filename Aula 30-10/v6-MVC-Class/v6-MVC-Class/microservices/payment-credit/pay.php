<?php

header('Content-Type: application/json');

try
{    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $creditCardNumber = $_POST['creditCardNumber'];
        $amount = $_POST['amount'];

        $response = ['message' => 'Payment completed successfully [$ '.$amount.'].'];
        
        echo json_encode($response);
    }
    else
        throw new Exception ('Method not permitted. Use POST to send data.');

}
catch (Exception $e) 
{
    echo json_encode(['error' => $e->getMessage()]);
}
