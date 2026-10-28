<?php 


function testFunction()
{
    return "Operations test function succeeded";
}

function fetchApprovedRequests()
{
    include_once 'connect.php';
    $status='Yes';
    $stmt=$conn->prepare('select * from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    
    $outputArray=[];
    if($stmt->execute())
        {
        $results=$stmt->get_result();
        while($row=$results->fetch_assoc())
            {
                $requesterId=$row["requesterId"];
                $resourceId=$row["resourceId"];
                $unitArray=['requesterId'=>$requesterId,'resourceId'=>$resourceId];
                array_push($outputArray,$unitArray);
            }
             return $outputArray;
        }
    return false;
}

function fetchRejectedRequests()
{
    include_once 'connect.php';
    $status='No';
    $stmt=$conn->prepare('select * from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    
    $outputArray=[];
    if($stmt->execute())
        {
        $results=$stmt->get_result();
        while($row=$results->fetch_assoc())
            {
                $requesterId=$row["requesterId"];
                $resourceId=$row["resourceId"];
                $unitArray=['requesterId'=>$requesterId,'resourceId'=>$resourceId];
                array_push($outputArray,$unitArray);
            }
             return $outputArray;
        }
    return false;
}

function fetchNeedInfoRequests()
{
    include_once 'connect.php';
    $status='NeedInfo';
    $stmt=$conn->prepare('select * from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    
    $outputArray=[];
    if($stmt->execute())
        {
        $results=$stmt->get_result();
        while($row=$results->fetch_assoc())
            {
                $requesterId=$row["requesterId"];
                $resourceId=$row["resourceId"];
                $unitArray=['requesterId'=>$requesterId,'resourceId'=>$resourceId];
                array_push($outputArray,$unitArray);
            }
             return $outputArray;
        }
    return false;
}

function purgeApproved()
{
    include_once 'connect.php';
    $status='Yes';
    $stmt=$conn->prepare('delete from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    if($stmt->execute())
        {
            return 'Approved list purged';
        }
        else 
            {
                return 'issue';
            }
}

function purgeRejected()
{
    include_once 'connect.php';
    $status='No';
    $stmt=$conn->prepare('delete from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    if($stmt->execute())
        {
            return 'Rejected list purged';
        }
        else 
            {
                return 'issue';
            }
    
}

function purgeNeedInfo()
{
    include_once 'connect.php';
    $status='NeedInfo';
    $stmt=$conn->prepare('delete from request2 where requestStatus=?');
    $stmt->bind_param("s",$status);
    if($stmt->execute())
        {
            return 'Rejected list purged';
        }
        else 
            {
                return 'issue';
            }
}


function createRequest($requester,$resource)
{
    // get approver info
    include_once 'connect.php';
    $stmt=$conn->prepare("select * from orguserinfo where email=?");
    $stmt->bind_param("s",$requester);
    $requesterInfoArray=[];
    $resourceInfoArray=[];
    if ($stmt->execute())
        {
            $results=$stmt->get_result();
            //$returnMessage = 'Create request operations fired with values '.$requester .' '.$resource;
            while($row=$results->fetch_assoc())
                {
                    $email=$row["email"];
                    $firstName=$row["firstName"];
                    $lastName=$row["lastName"];
                    $team=$row["team"];
                    $title=$row["title"];
                    $unitArray=['email'=>$email,'firstName'=>$firstName,'lastName'=>$lastName,'team'=>$team,'title'=>$title];
                    array_push($requesterInfoArray,$unitArray);
                }
            $stmt=$conn->prepare("select * from resource2 where resourceName=?");
            $stmt->bind_param("s",$resource);
            if ($stmt->execute())
                {
                    $results=$stmt->get_result();
                    while($row=$results->fetch_assoc())
                        {
                            $approverEmail=$row["approverEmail"];
                            $approverFirstName=$row["approverFirstName"];
                            $approverLastName=$row["approverLastName"];
                            $approverTitle=$row["approverTitle"];
                            $resourceName=$row["resourceName"];
                            $unitArray=[
                                "email"=>$approverEmail,
                                "firstName"=>$approverFirstName,
                                "lastName"=>$approverLastName,
                                "title"=>$approverTitle,
                                "resource"=>$resourceName
                                ];
                            array_push($resourceInfoArray,$unitArray);
                        }
                }
                else 
                    {
                        $returnMessage = ' no execute';
                    }
        }
        else 
            {
                $returnMessage = 'no Execute';
            }
    // get requester info if available
    // create a request record
    $fn=$resourceInfoArray[0]["firstName"];
    $ln=$resourceInfoArray[0]["lastName"];
    $jt=$resourceInfoArray[0]["title"];
    $rfn=$requesterInfoArray[0]["firstName"];
    $rln=$requesterInfoArray[0]["lastName"];
    $rt=$requesterInfoArray[0]["title"];
    $re=$resourceInfoArray[0]["resource"];
    $rem=$requesterInfoArray[0]["email"];
    $reTe=$requesterInfoArray[0]["team"];
    $status='pending';
    $testRequestMessage =
    "
        To $fn $ln,
        This is a request for $rfn $rln, $rt to get access to the $re resource.
    ";
    // translate the above into a database/database entry
    $stmt=$conn->prepare("insert into request2(requesterId,requesterTitle,requesterTeam,resourceId,requestStatus) values(?,?,?,?,?)");
    $stmt->bind_param("sssss",$rem,$rt,$reTe,$re,$status);
    if($stmt->execute())
        {
            $returnMessage="Record updated";
        }
        else 
            {
                $returnMessage="Error updating";
            }
    $returnMessage = $testRequestMessage;
  
    return $returnMessage;
}



function fetchPendingRequests()
{
    $returnMessage='';
    include_once 'connect.php';
    $requestStatus='pending';
    $stmt=$conn->prepare("select * from request2 where requestStatus=?");
    $stmt->bind_param("s",$requestStatus);
    $outputArray=[];
    if ($stmt->execute())
        {
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $requesterId=$row["requesterId"];
                    $resourceId=$row["resourceId"];
                    $unitArray=['requester'=>$requesterId,'resource'=>$resourceId];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }
}


function fetchsentRequests()
{
    $returnMessage='';
    include_once 'connect.php';
    $requestStatus='sent';
    $stmt=$conn->prepare("select * from request2 where requestStatus=?");
    $stmt->bind_param("s",$requestStatus);
    $outputArray=[];
    if ($stmt->execute())
        {
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $requesterId=$row["requesterId"];
                    $resourceId=$row["resourceId"];
                    $unitArray=['requester'=>$requesterId,'resource'=>$resourceId];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }
}

function userLookupByEmail($userEmail)
{
    include_once 'connect.php';
    $returnMessage='User lookup by email operations has fired with value '.$userEmail;
    $stmt=$conn->prepare('select * from orguserinfo where email=?');
    $stmt->bind_param("s",$userEmail);
    $outputArray=[];
    if ($stmt->execute())
        {
            //$returnMessage='Statement executed';
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $unitArray=
                    [
                        "firstName"=>$row["firstName"],
                        "lastName"=>$row["lastName"],
                        "title"=>$row["title"],
                        "team"=>$row["team"]
                    ];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }
        else 
            {
                $returnMessage="Statment didn't execute";
            }
    return $returnMessage;
}

function fetchResourceInfo($resourceName)
{
    //return "Fetch resource info operations has fired with resource ".$resourceName;
    include_once 'connect.php';
    $stmt=$conn->prepare("select * from resource2 where resourceName=?");
    $stmt->bind_param("s",$resourceName);
    $outputArray=[];
    if ($stmt->execute())
        {
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $unitArray=[
                    'firstName'=>$row["approverFirstName"],
                    'lastName'=>$row["approverLastName"],
                    'title'=>$row["approverTitle"],
                    'resourceName'=>$row["resourceName"],
                    'approverEmail'=>$row["approverEmail"]
                    ];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }   
        else 
            {
                return "Statement didn't execute";
            }
}

function fetchResourceList()
{
    include_once 'connect.php';
    $stmt=$conn->prepare("select resourceName from resource2");
    $outputArray=[];
    if($stmt->execute())
        {
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $unitArray=["resourceName"=>$row["resourceName"]];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }
        else 
            {

            }
}



function sendPendingRequests()
{
    // transfers requests from one list to the next but the emails have to go out during this process.
    include_once 'connect.php';
    $returnMessage = 'sendPendingRequests operations has fired';
    $stmt=$conn->prepare("select * from request2");
    $pendingArray=[];
    $sentStatus='sent';
    if ($stmt->execute())
        {
            $returnMessage="";
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $unitArray=[
                        'requesterId'=>$row["requesterId"],
                        'resourceId'=>$row["resourceId"]
                    ];
                    array_push($pendingArray,$unitArray);
                }
            for($i=0;$i<sizeof($pendingArray);$i++)
                {
                    $stmt=$conn->prepare("update request2 set requestStatus=? where requesterId=? and resourceId=?");
                    $stmt->bind_param("sss",$sentStatus,$pendingArray[$i]['requesterId'],$pendingArray[$i]['resourceId']);
                    if ($stmt->execute())
                        {
                          //  composeMail($pendingArray[$i]['requesterId'],$pendingArray[$i]['resourceId']);
                        }
                }
        }
        else 
            {
                $returnMessage="Part 1 didn't execute";
            }
    return $returnMessage;
}


function composeMail($requesterId,$resourceId)
{
    // check for requester information
    include_once 'connect.php';
    $returnMessage=
    "
        Test compose mail has fired with parameters $requesterId and $resourceId
    ";
    $requesterArray=[];
    $resourceArray=[];
    
    $stmt=$conn->prepare("select * from orguserinfo where email=?");
    $stmt->bind_param("s",$requesterId);
    if($stmt->execute())
        {
            $results=$stmt->get_result();
            while ($row=$results->fetch_assoc())
                {
                    $firstName=$row["firstName"];
                    $lastName=$row["lastName"];
                    $team=$row["team"];
                    $title=$row["title"];
                    $unitArray=[
                        'firstName'=>$firstName,
                        'lastName'=>$lastName,
                        'team'=>$team,
                        'title'=>$title
                    ];
                    array_push($requesterArray,$unitArray);
                }
        }
    
    $stmt=$conn->prepare("select * from resource2 where resourceName=?");
    $stmt->bind_param("s",$resourceId);
    if($stmt->execute())
        {
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $firstName=$row["approverFirstName"];
                    $lastName=$row["approverLastName"];
                    $title=$row["approverTitle"];
                    
                    $resource=$row["resourceName"];
                    $email=$row["approverEmail"];
                    $unitArray=[
                            'firstName'=>$firstName,
                            'lastName'=>$lastName,
                            'title'=>$title,
                            'resource'=>$resource,
                            'email'=>$email
                    ];
                    array_push($resourceArray,$unitArray);
                }
        }

        /*
    $emailText=
    "
        Greetings $resourceArray[0]['firstName'] $resourceArray[0]['lastName'],
             I'm writing to ask if it is permissable to give $requesterArray[0]['firstName'] $requesterArray[0]['lastName'] (who is a $requesterArray[0]['title'] on the $requesterArray[0]['team'] team) access to the $resourceArray[0]['resourceName'] resource.
    ";
    */
    $subject ="Request to access ".$resourceArray[0]['resource'];
    $to=$resourceArray[0]['email'];

    $emailText = "Hello ". 
                $resourceArray[0]['firstName'] ." ".
                $resourceArray[0]['lastName'].",\n". 
                "I'm writing to ask if it is permissable to give ".$requesterArray[0]['firstName']." ". $requesterArray[0]['lastName'].
                "(who is a ".$requesterArray[0]['title'] ." on the ". $requesterArray[0]['team']." team)". 
                " access to the ".$resourceArray[0]['resource']." resource."."\n". 
                "Please click on the appropriate link below to indicate your wishes.  Thank you!";


    $headers="From: webmaster@example.com"; 
   
   /// mail($to,$subject,$emailText,$headers);
    return $emailText;


    /*
    MailerSend api body
    {
    "from": {
      "email": "test@test-69oxl5epko2l785k.mlsender.net",
      "name": "MailerSend"
    },
    "to": [
      {
        "email": "stephen.tatone@mohawkcollege.ca",
        "name": "Stephen Tatone"
      }
    ],
    "subject": "Hello from {{company}}!",
    "text": "This is just a friendly hello from your friends at {{company}}.",
    "html": "<b>This is just a friendly hello from your friends at {{company}}.</b>",
    "personalization": [
      {
        "email": "stephen.tatone@mohawkcollege.ca",
        "data": {
          "company": "MailerSend"
        }
      }
    ]
  }
    */

}

?>