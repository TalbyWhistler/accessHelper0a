<?php 
function testFunction()
    {
        include 'trading_db_connect.php';
        $stmt=$conn->prepare("select distinct city from commodity");
        $returnMessage='';
        $stmt=$conn->prepare("select distinct city from commodities");
        $outputArray=[];
        if ($stmt->execute())
            {
               // $returnMessage='data';
                $results=$stmt->get_result();
                while ($row=$results->fetch_assoc())
                    {
                        $returnMessage=$returnMessage.' '.$row["city"];
                        array_push($outputArray,$row["city"]);
                    }
                return $outputArray;
            }
            else 
                {
                    $returnMessage='no data';
                }
       
        
        return $returnMessage;
    }

?>