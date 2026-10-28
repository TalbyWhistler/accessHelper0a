<?php 

    include 'operations.php';
    $rawInput=file_get_contents('php://input');
    $jsonInput=json_decode($rawInput,true);
    $function=$jsonInput["function"];
    $returnMessage='No backend function activated in ingestBackend';
    switch($function)
    {
            case('listener'):
                $returnMessage="TEST LISTENER";
                $params=$jsonInput["params"];
                $org=$params["orgId"];
                $request=$params["requestId"];
                $response=$params["response"];
                $returnMessage="The listener hears this response from $org and request $request and response of $response";
                $returnMessage=handleResponse($org,$request,$response);

                break;
        
    }
    echo json_encode($returnMessage);


?>