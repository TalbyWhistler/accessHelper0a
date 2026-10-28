<?php 
    include_once 'php/tools.php';
    $welcomeLink =
    "
        <a href='../frontPage/index.php'>Welcome</a>
    ";
    $loginLink = 
    "   
        <a href='index.php'>Login</a>
    ";


    $pageOutput =
            $welcomeLink.$loginLink;


    echo $pageOutput;


?>