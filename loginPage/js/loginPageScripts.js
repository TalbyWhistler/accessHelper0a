function loginSubmit()
{
    console.log("Login submit button has been hit");
    let passwordInput=document.getElementById("passwordInput").value;
    let emailInput=document.getElementById("emailInput").value;
    console.log("Email is " + emailInput + " and password is " + passwordInput);
    let functionName='loginAttempt';
    let functionParams={email:emailInput,password:passwordInput};
    callLoginBackend(functionName,functionParams,console.log);
}




function callLoginBackend(functionName,params,callback)
{
    let fetchTarget='loginPage/php/loginPageBackend.php';
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