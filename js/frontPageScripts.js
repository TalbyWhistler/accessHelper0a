function testFunction0()
{
    console.log("TEEEESTO");
    console.log("And then some");
}




function pageInit() 
{
    testFunction0();
}

function testFunction()
{
    console.log("Test function");
    params={testParameter:5};
    callBackend("testFunction",params,console.log);
}

function callBackend(functionName,params,callback)
{
    let fetchTarget='php/mainPageBackend.php';
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


pageInit();