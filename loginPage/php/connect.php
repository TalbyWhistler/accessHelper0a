<?php 
     
//unchartedwatersb = dos 
//unchartedwatersc = nes
//unchartedwatersd = gen

$DBservername="localhost";
//$servername="%waters";
$DBusername = "webUser1";
$DBpassword = "watersWeb";
//$dbName = "unchartedWatersb";
$DBName = "accessHelper0a";


$conn = new mysqli($DBservername,$DBusername,$DBpassword,$DBName);
$returnValue=false;
if ($conn->connect_error)
    {
       // echo "</br>connect false";
    }
    else 
        {
            //echo "</br>connect true";
           $returnValue=true;
        }

return $returnValue;

?>