
function attachStyleSheet()
{
    console.log("ATTACH style sheet");
    const styleSheetLocation='css/loginStyles.css';
    const styleLink=document.createElement('link');
    styleLink.rel='stylesheet';
    styleLink.type='text/css';
    styleLink.href=styleSheetLocation;
    document.head.appendChild(styleLink);
    
}


function loginSubmit()
{
    console.log("Login submit button has been hit");
    let passwordInput=document.getElementById("passwordInput").value;
    let emailInput=document.getElementById("emailInput").value;
   // console.log("Email is " + emailInput + " and password is " + passwordInput);
    let functionName='loginAttempt';
    let functionParams={email:emailInput,password:passwordInput};
    callLoginBackend(functionName,functionParams,writeToStatusL);
   
}

function writeToStatusLogin(message)
{
    document.getElementById("loginStatusIndicator").innerHTML=message;
    setTimeout(checkForLogin(),2000);
    
}


function writeToStatus(message)
{
    document.getElementById("statusIndicator").innerHTML=message;
}

function writeToStatusL(message)
{
    document.getElementById("statusIndicator").innerHTML=message;
    checkForLogin();
}

function callLoginBackend(functionName,params,callback)
{
    let fetchTarget='php/loginPageBackend.php';
    let inputPackage={function:functionName,params:params};
    
    inputPackage=JSON.stringify(inputPackage);
    fetch(fetchTarget,
        {
            method:'POST',
            headers:{'Content-Type':'Application/json'},
            body:inputPackage
        }
    )
    .then(response=>response.json())
    .then(data=>callback(data));
}


function writeToLoggedIn(message)
{
    document.getElementById("loginStatusIndicator").innerHTML=message;
}

function checkForLogin()
{
    console.log("Checking if logged in");
    console.log("For real");
    callLoginBackend("checkIfLoggedIn","",writeToLoggedIn);
}


function loginPageInit()
{
    checkForLogin();
    attachStyleSheet();
}

function handleLogoutSubmit()
{
    console.log("logout");
    callLoginBackend("logout","",writeToStatusL);
    
     //setTimeout(checkForLogin,2000);
}

function testFunction0a()
{
    console.log("Test function");
    checkForLogin();
}



loginPageInit();