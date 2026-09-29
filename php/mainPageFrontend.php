<?php 
    include 'tools.php';
    $headline=createElement("h1","mainHeadLine","title","accessHelper");
    $testButton0=createButton("testButton0","button","testFunction","Test Button");

    $fullOutput = 
        $headline.
        $testButton0;

    echo $fullOutput;
?>