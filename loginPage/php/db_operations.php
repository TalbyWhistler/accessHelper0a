<?php 

function loginFunction($email,$password)
{
    include 'connect.php';
    $returnMessage =  "" . $email . " " . $password;
    return $returnMessage;
}



?>