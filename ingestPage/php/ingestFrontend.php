<?php 
    include 'php/tools.php';
    $headline=createElement('h2','ingestionHeadline','title','Access List Upload');
    $scriptLink='<script src="js/ingestScripts.js"></script>';
    $uploadForm = 
    '
    <form action="/action_page.php">
    <input type="file" id="inputSpreadsheet" name="upload">
   
    </form>
    ';
    // <input type="submit">
    $br='</br>';
    $totalOutput=
            $headline.
            $br.
            $uploadForm.
            $scriptLink;


    $ingestContainer=createElement('div','ingestContainer','areaContainer',$totalOutput);


    echo $ingestContainer;


?>