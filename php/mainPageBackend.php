<?php 
    
    include 'operations.php';
    $rawInput=file_get_contents('php://input');
    $jsonInput=json_decode($rawInput,true);
    $function=$jsonInput["function"];
    $returnMessage='';
    switch($function)
    {
        case 'testFunction':
            {
                $functionParams=$jsonInput["params"];
                $testParameter=$functionParams["testParameter"];
                $returnMessage="Test Parameter was " .$testParameter;
                break;
            }  
    }
    echo json_encode($returnMessage);
?>