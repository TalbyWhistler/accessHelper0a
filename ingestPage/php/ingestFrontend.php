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
    $readUploadButton=createButton("processButton","submitButton","submitButton","Read Upload File");
    

    $outputAreaTitle=createElement('h3','dbOutputTitle','title','Existing Owners and Resources');
    $dbOutputArea=createElement('p','dbOutputArea','outputArea','');
    $uploadOutputArea=createElement('p','uploadOutputArea','outputArea','');

    
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
    $panelOutput=
            $headline.
            $br.
            $uploadForm.
           // $br.
            $indicator.
            $br.
            $readUploadButton;


    $ingestPanel=createElement('div','ingestContainer','areaContainer',$panelOutput);

    $totalOutput=
            $ingestPanel.
            $outputAreaTitle.
            $dbOutputArea.
            $uploadOutputArea.
            $scriptLink;

    echo $totalOutput;


?>