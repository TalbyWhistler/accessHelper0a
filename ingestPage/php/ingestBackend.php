<?php 
    include 'operations.php';
    $rawInput=file_get_contents('php://input');
    $jsonInput=json_decode($rawInput,true);
    $function=$jsonInput["function"];
    $returnMessage='No backend function activated in ingestBackend';
    switch($function)
    {
        case 'ingestTestFunction':
            {
                $functionParams=$jsonInput["params"];
                $testParameter=$functionParams["testParameter"];
                $secondParameter=$functionParams["secondParameter"];
                $returnMessage="Test Parameter was " .$testParameter . " and second parameter was " . $secondParameter . testOperation();
                
                break;
            }  
        case 'readUpload':
            {
                $returnMessage="backend readUpload activated";
                $returnMessage=readUpload();
                //$returnMessage=clearUploadDirectory();
                break;
            }
        case 'readResources':
            {
                $returnMessage="Read resources has activated";
                $returnMessage=readFromResource2();
                break;
            }
        
    }
    echo json_encode($returnMessage);

?>