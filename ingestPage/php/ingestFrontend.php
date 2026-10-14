<?php 
    include 'php/tools.php';

    if(isset($_GET["success"]))
        {
                $success=$_GET["success"]; 
                if($success==1)
                    {
                        $indicatorMessage="File uploaded.";
                    }
                    else if ($success==0)
                        {
                            $indicatorMessage="Upload error.";
                        }
                    else
                        {
                            $indicatorMessage="Error";
                        }
        }
        else 
            {
                $indicatorMessage="Ok";
            }
    $headline=createElement('h2','ingestionHeadline','title','Access List Upload');
    $scriptLink='<script src="js/ingestScripts.js"></script>';
    $indicator=createElement('label','uploadIndicator','indicator',$indicatorMessage);
    $testButton=createButton("processButton","submitButton","testButton","TESTO");
    $uploadForm = 
    '
    <form action="php/uploadSheet.php" method="post" enctype="multipart/form-data">
    <input type="file" id="fileToUpload" name="fileToUpload"/>
    <br/>
    <input type="submit" id="submit" name="submit" value="Upload File"/>
   
    </form>
    ';
    // <input type="submit">
    $br='</br>';
    $totalOutput=
            $headline.
            $br.
            $uploadForm.
           // $br.
            $indicator.
            $br.
            $testButton.
            $scriptLink;


    $ingestContainer=createElement('div','ingestContainer','areaContainer',$totalOutput);


    echo $ingestContainer;


?>