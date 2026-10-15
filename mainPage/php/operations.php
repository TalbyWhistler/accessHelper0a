<?php 


function testFunction()
{
    return "Operations test function succeeded";
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

    $testRequestMessage =
    "
        To $fn $ln,
        This is a request for $rfn $rln, $rt to get access to the $re resource.
    ";
    // translate the above into a database/database entry
    $returnMessage = $testRequestMessage;
  
    return $returnMessage;
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

?>