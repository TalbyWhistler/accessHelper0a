<?php 

    include 'db_operations.php';
    $rawInput=file_get_contents('php://input');
    $jsonInput=json_decode($rawInput,true);
    $function=$jsonInput["function"];
    $returnMessage='No backend function activated';
    switch($function)
    {
        case 'loginAttempt':
            {
                
                $functionParams=$jsonInput["params"];
                $email=$functionParams["email"];
                $password=$functionParams["password"];
               
                //$returnMessage='Login has fired with email '. $email .' and password '.$password;
                $returnMessage=loginFunction($email,$password);
                break;
            }
    }

    echo json_encode($returnMessage);

?>