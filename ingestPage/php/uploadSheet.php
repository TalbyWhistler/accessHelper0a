<?php 
    //echo 'UPLOAD SHEET!@';
    include_once 'operations.php';
   
    $target_dir = "upload\\";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file_tmp = $_FILES["fileToUpload"]["tmp_name"];
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $allowedTypes = array('txt');
    if (in_array($fileType,$allowedTypes))
        {
            echo '</br> This is an allowed file type';
            
        }
        else 
            {
                $uploadOk =  0;
            }

    if($uploadOk)
       {
        clearUploadDirectory();
        chdir('..');
        echo "<br/> Upload is reading ok";
        echo "<br />" . getcwd() . '\\' . $target_file;
        //echo "<br />" . $target_dir;
        if (file_exists( $target_file_tmp))
            {
                echo "<br/> Found the file";
                if(move_uploaded_file($target_file_tmp,$target_file))
                    {
                        echo "</br> Moved the file";
                    }
                    else 
                        {
                            $uploadOk = 0;
                        }
            }
       }
       else 
        {
            echo "<br/>Upload is reading not ok.";
            $uploadOk = 0;
        }

    $headerMessage="Location: ..//index.php?success=".$uploadOk;
    header($headerMessage);    
    //header("Location: ..//index.php?success=1");



    /*




    if (isset($_POST["submit"]) && $fileType !='')
        {
           
            if($fileType=='txt')
                {
                    echo "Target dir:" . $target_dir;
                    echo "</br> Target file temp name:" . $target_file_tmp;
                    echo "<br/> File:" . $target_file;
                    echo "<br/> File type is txt";
                    $uploadOk=1;
                }
        }
    else 
        {
            $uploadOk=0;
            echo "No submit?";
            echo $target_dir ;
            echo '<br/>';
            echo $fileType;
            echo '<br/>';
            echo $target_file;      
        }

     if($uploadOk)
       {
        chdir('..');
        echo "<br/> Upload is reading ok";
        echo "<br />" . getcwd() . '\\' . $target_file;
        //echo "<br />" . $target_dir;
        if (file_exists( $target_file_tmp))
            {
                echo "<br/> Found the file";
                if(move_uploaded_file($target_file_tmp,$target_file))
                    {
                        echo "</br> Moved the file";
                    }
            }
       }
       else 
        {
            echo "<br/>Upload is reading not ok.";
        }
    */      
?>