function attachStyleSheet()
{
    console.log("ATTACH style sheet");
    const styleSheetLocation='css/ingestStyles.css';
    const styleLink=document.createElement('link');
    styleLink.rel='stylesheet';
    styleLink.type='text/css';
    styleLink.href=styleSheetLocation;
    document.head.appendChild(styleLink);  
}


function ingestInit()
{
    console.log("Ingest init");
    attachStyleSheet();
}



function testButton()
{
    console.log("TESTO!!!");
    let params={"testParameter":3,"secondParameter":2};
   // callBackend("ingestTestFunction",params,console.log);


    //callBackend("readUpload",'',printFileInfo);
    callBackend("readUpload","",console.log);
}

function printFileInfo(fileInfo)
{
    //console.log(fileInfo);
    let inputDataArray=fileInfo.split(',');
    let outputMessage = 
    `
        Greetings ${inputDataArray[1]}, I must humbly request your services as ${inputDataArray[3]} to permit access  to ${inputDataArray[0]};
    `;
    console.log(outputMessage);
}


function callBackend(functionName,params,callback)
{
    let fetchTarget='php/ingestBackend.php';
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


ingestInit();
