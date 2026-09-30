<?php 

function loginFunction($email,$password)
{
    include 'connect.php';
    $stmt=$conn->prepare("select password,status from logintable where email = ?");
    $stmt->bind_param("s",$email);
    $returnMessage = '';

    if ($stmt->execute())
        {
            $results=$stmt->get_result();
            while ($row=$results->fetch_assoc())
                {
                    $returnMessage=$returnMessage. $row["password"];
                }
        }
        else 
            {
                $returnMessage="Problem with database query";
            }
    return $returnMessage;
}

function attemptLogin($email,$password)
{
    include 'connect.php';
   // return "$usernameInput $passwordInput";
  //  $insertName='TalbyWhistler';
    $stmt=$conn->prepare("SELECT COUNT(*) as 'total' FROM logintable WHERE email=? and PASSWORD=?");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $result=$stmt->get_result();
    $resultsArray=[];
    while($row=$result->fetch_assoc())
        {
            $count=$row["total"];
            array_push($resultsArray,$count);
        }
    if ($resultsArray[0]==1)
        {
            $COOKIE_NAME='accessHelper';
            $testToken='123456';
            $cookieValues=['email'=>$email,'token'=>$testToken];
            $jsonValues=json_encode($cookieValues);
            setcookie($COOKIE_NAME,$jsonValues);
            $stmt=$conn->prepare("update logintable set logindate=current_date(),logintoken=? where email=? and password=?");
            $stmt->bind_param("sss",$testToken,$email,$password);
            
            if($stmt->execute())
                {
                    return 'Login successful';
                }
        }
    else 
        {
            return 'Invalid login.';
        }
}


function checkIfLoggedIn()
{
    include 'connect.php';
    $cookieValues=$_COOKIE["accessHelper"]??'';
    $cookieUsername=$_COOKIE["accessHelper"]??'';
    $jsonValues=json_decode($cookieValues,true);
  //  return json_encode($jsonValues);
    $loggedInUser=$jsonValues["email"]??'';
    $loggedInToken=$jsonValues["token"]??'';
  //  return json_encode($jsonValues["username"]);
   // $cookieUsername=$_COOKIE["linuxLab"];
   // $cookieToken=$_COOKIE["linuxLab"]["token"]??'';
   // return $cookieUsername;
    $stmt=$conn->prepare("select count(*) as 'total' from logintable where logintoken=? and email=? and logindate=current_date()");
    $stmt->bind_param("ss",$loggedInToken,$loggedInUser);
    $stmt->execute();
    $outputArray=[];
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc())
        {
            $value=$row["total"];
            array_push($outputArray,$value);
        }
    if($outputArray[0]>0)
        {
            return ' logged in.';
        }
    else 
        {
            return ' not logged in.';
        }
}


function logout()
{
    include 'connect.php';
    $cookieUsername=$_COOKIE["accessHelper"]["email"]??'';
    $cookieToken=$_COOKIE["accessHelper"]["token"]??'';
    $cookieValues=['email'=>'','token'=>''];
    $jsonValues=json_encode($cookieValues);
    setcookie('accessHelper',$jsonValues);
    return 'Successfully logged out.';
}


?>