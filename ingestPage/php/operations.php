<?php 
    function testOperation()
    {
        return "PHP operations on the ingest page are functional";
    }



    function readUpload()
    {
        $current_dir = getcwd();
        
        $dir_info = scandir($current_dir.'\..\upload');
        $filename = $dir_info[2];
        $filepath=$current_dir.'\..\upload\\';

        
        $size=filesize($filepath.$filename);
       // $filedata=fread($filepath.$filename,$size);

        $readFile=fopen($filepath.$filename,"r");

        $filedata=fread($readFile,$size);
        
        $returnMessage = "";
        return $filedata; 
        //$current_dir .'\..';
        

    }

    function mergeRecord($firstName,$lastName,$title,$resource,$email)
    {
        $returnMessage='MergeRecord has fired in operations';
        include_once 'connect.php';
        $stmt=$conn->prepare("insert into resource2(approverFirstName,approverLastName,approverTitle,resourceName,approverEmail) values(?,?,?,?,?)");
        $stmt->bind_param("sssss",$firstName,$lastName,$title,$resource,$email);
        if($stmt->execute())
            {
                $returnMessage='Record updated';
            }
            else 
                {
                    $returnMessage='There was a problem updating the record.';
                }
        return $returnMessage;
    }

    function clearUploadDirectory()
    {
        $current_dir = getcwd();
        $upload_dir = $current_dir.'\..\upload\\';
        $returnMessage = '';
        $dir_info = scandir($upload_dir);
        
        if (sizeof($dir_info)>2)
            {
                for($i=2;$i<sizeof($dir_info);$i++)
                {
                    if(unlink($upload_dir.$dir_info[$i]))
                        {
                            $returnMessage=$returnMessage.$dir_info[$i] . " deleted.";
                        }
                }
            }
            else 
                {
                    $returnMessage="No uploads to clear.";
                }
        
        return $returnMessage;
    }


    function readFromResource2()
    {
        include_once 'connect.php';
        $returnMessage="Read resources operations has activated";
        $stmt=$conn->prepare("select * from resource2");
        $outputArray=[];
        if($stmt->execute())
            {
                $results=$stmt->get_result();
                while($row=$results->fetch_assoc())
                    {
                        $unitArray=['approverFirstName'=>$row["approverFirstName"],'approverLastName'=>$row["approverLastName"],'approverTitle'=>$row["approverTitle"],'resourceName'=>$row["resourceName"],'approverEmail'=>$row["approverEmail"]];
                        array_push($outputArray,$unitArray);
                    }
            }

        $returnMessage=$outputArray;
        
    /*
        stmt=$conn->prepare("select * from notes");
    $outputArray=[];
    if ($stmt->execute())
        {
            
            $results=$stmt->get_result();
            while($row=$results->fetch_assoc())
                {
                    $unitArray=['note'=>$row["note"]];
                    array_push($outputArray,$unitArray);
                }
            return $outputArray;
        }
        else 
            {
                return "statement didn't execute";
            }
}
            */
        return $returnMessage;
    }

?>