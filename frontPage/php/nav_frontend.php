<?php 
    include_once 'php/tools.php';
    $welcomeLink =
    "
        <a href='index.php'>Welcome</a>
    ";
    $loginLink = 
    "   
        <a href='../loginPage/index.php'>Login</a>
    ";


    $pageOutput =
            $welcomeLink.$loginLink;


    echo $pageOutput;


?>