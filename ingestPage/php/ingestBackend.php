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
        case 'submitMergeRecord':
                
            {
                $params=$jsonInput["params"];
                $firstName=$params["firstName"];
                $lastName=$params["lastName"];
                $title=$params["title"];
                $resource=$params["resource"];
                $email=$params["email"];
                $returnMessage=mergeRecord($firstName,$lastName,$title,$resource,$email);
                break;
            }
        
    }
    echo json_encode($returnMessage);

?>