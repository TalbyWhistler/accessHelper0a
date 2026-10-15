<?php 

    include 'operations.php';
    $rawInput=file_get_contents('php://input');
    $jsonInput=json_decode($rawInput,true);
    $function=$jsonInput["function"];
    $returnMessage='No backend function activated in ingestBackend';
    switch($function)
    {
            case('testFunction'):
                $returnMessage=testFunction();
                break;
            case('fetchResourceList'):
                $returnMessage=fetchResourceList();
                break;
            case('fetchResourceInfo'):
                $params=$jsonInput["params"];
                $resourceName=$params["resourceName"];
                $returnMessage=fetchResourceInfo($resourceName);

                break;
    }
    echo json_encode($returnMessage);


?>