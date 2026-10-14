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


    function clearUploadDirectory()
    {
        $current_dir = getcwd();
        $upload_dir = $current_dir.'\..\upload\\';
        $returnMessage = '';
        $dir_info = scandir($upload_dir);
        //$returnMessage=$dir_info;
        //$returnMessage=$upload_dir.$dir_info[2];
       // $filePointer=fopen($upload_dir.$dir_info[2],"rw");
        /*
        if(unlink($upload_dir.$dir_info[2]));
            {
                $returnMessage=$dir_info[2]. ' deleted.';
            }
        */
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

?>