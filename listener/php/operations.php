<?php 
function handleResponse($org,$request,$response)
{
   // return "Operations handleREsopnse for $org, $request, $response";
    include_once 'connect.php';
    switch($response)
    {
        case('Yes'):
            {

               
                $stmt=$conn->prepare("update request2 set requestStatus=? where requestId=?");
                $status='Yes';
                $stmt->bind_param("si",$status,$request);
                if ($stmt->execute())
                    {
                         return "Processing yes for $org and $request";
                    }
                break;
            }
        case("No"):
            {
                $stmt=$conn->prepare("update request2 set requestStatus=? where requestId=?");
                $status='No';
                $stmt->bind_param("si",$status,$request);
                if ($stmt->execute())
                    {
                         return "Processing No for $org and $request";
                    }
                break;
            }
        case("NeedInfo"):
            {
                $stmt=$conn->prepare("update request2 set requestStatus=? where requestId=?");
                $status='NeedInfo';
                $stmt->bind_param("si",$status,$request);
                if ($stmt->execute())
                    {
                         return "Processing NeedInfo for $org and $request";
                    }
                // return "Processing need info for $org and $request";
                break;
            }
    }
        
}



?>