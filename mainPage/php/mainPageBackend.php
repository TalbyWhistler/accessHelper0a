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
            case('userLookupByEmail'):
                $params=$jsonInput["params"];
                $userEmail=$params["userEmail"];
                $returnMessage="userLookupByMail backend has fired with value ".$userEmail;
                $returnMessage=userLookupByEmail($userEmail);
                break;
            case('createRequest'):
                $params=$jsonInput["params"];
                $requesterId=$params["requesterId"];
                $resourceName=$params["resourceId"];
                $returnMessage=createRequest($requesterId,$resourceName);
                break;
            case('fetchPendingRequests'):              
                $returnMessage=fetchPendingRequests();
                break;
            case('fetchSentRequests'):
                $returnMessage=fetchSentRequests();
                break;
            case('sendPendingRequests'):
                $returnMessage=sendPendingRequests();
                break;
            case('testComposeMail'):
               // $returnMessage='test compose mailer backend has fired';
                $returnMessage=composeMail('stephen.tatone@mohawkcollege.ca','The Blue Room');
                break;
            case('fetchApprovedRequests'):
                $returnMessage=fetchApprovedRequests();
                //$returnMessage='fetch Approved requests backend';
                break;
            case('fetchRejectedRequests'):
                $returnMessage='fetch rejected backend has fired';
                $returnMessage=fetchRejectedRequests();
                break;
            case('fetchNeedInfoRequests'):
                $returnMessage='fetch NeedInfo backend has fired';
                $returnMessage=fetchNeedInfoRequests();
                break;
            case('purgeApproved'):
                {
                    $returnMessage=purgeApproved();
                    break;
                }
            case('purgeRejected'):
                {
                    $returnMessage=purgeRejected();
                    break;
                }
            case('purgeNeedInfo'):
                {
                    $returnMessage=purgeNeedInfo();
                    break;
                }
    }
    echo json_encode($returnMessage);


?>