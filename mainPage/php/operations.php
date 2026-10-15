<?php 


function testFunction()
{
    return "Operations test function succeeded";
}

function userLookupByEmail($userEmail)
{
    $returnMessage='User lookup by email operations has fired with value '.$userEmail;
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