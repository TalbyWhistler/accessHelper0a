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




function fetchResources()
{
    console.log("Fetch resources");
    callBackend("readResources","",printResources);
}

function printResources(resourceOutput)
{
    let outputOpen=`<table>`;
    let outputClose=`</table>`;
    //let outputMiddle='';
    let outputMiddle=
    `
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Title</th>
            <th>Resource</th>
            <th>email</th>
        </tr>
    `;
    //console.log(resourceOutput[0]);
    for(let i=0;i<resourceOutput.length;i++)
    {
        console.log(resourceOutput[i]);
        outputMiddle=outputMiddle+
        `<tr>
            <td>${resourceOutput[i]["approverFirstName"]}</td>
            <td>${resourceOutput[i]["approverLastName"]}</td>
            <td>${resourceOutput[i]["approverTitle"]}</td>
            <td>${resourceOutput[i]["resourceName"]}</td>
            <td>${resourceOutput[i]["approverEmail"]}</td>

        <tr>
        `
    }
    let totalOutput=outputOpen+outputMiddle+outputClose;
    document.getElementById("dbOutputArea").innerHTML=totalOutput;
}

function submitButton()
{
    console.log("TESTO!!!");  
    callBackend("readUpload","",printFileInfo);
}


function mergeUpload()
{
    console.log("FUnction merge upload");
    let confirmButton=
    `
        <p>Upload these file values to database?</p>
        <button id="confirmUpload" onclick="uploadConfirm()">Confirm</button>
        <button id="cancelUpload" onclick="uploadCancel()">Cancel</button>
    `;
    document.getElementById("confirmButtonArea").innerHTML=confirmButton;
}

function uploadConfirm()
{
    console.log("Upload confirm hit");
}

function uploadCancel()
{
    console.log("Upload cancel hit");
    document.getElementById("confirmButtonArea").innerHTML='';
}


function printFileInfo(fileInfo)
{
    //console.log(fileInfo);
    let inputDataLinesArray=fileInfo.split("\n");
    //let inputDataArray=fileInfo.split(',');
    
    let outputOpener=
    `
        <h3>Upload Resources</h3>
        <table>
        <tr>
            <th>firstName</th><th>lastName</th><th>title</th><th>resource</th><th>email</th>
        </tr>
    `;
    let outputCloser=
    `
        </table>
    `;
    let outputMiddle='';

     let mergeButton=
    `
        <button onclick="mergeUpload()">Merge Upload</button>
    `;

    let confirmButtonArea=
    `
        <p id="confirmButtonArea"></p>
    `;


    for(let i=0;i<inputDataLinesArray.length;i++)
    {
        let lineArray=inputDataLinesArray[i].split(',');
        console.log(lineArray[0]);
        outputMiddle=outputMiddle+
        `
            <tr>
                <td>${lineArray[0]}</td><td>${lineArray[1]}</td><td>${lineArray[2]}</td><td>${lineArray[3]}</td><td>${lineArray[4]}</td>
            </tr>
        `;
    }
    let totalOutput=outputOpener+outputMiddle+outputCloser+
    mergeButton+confirmButtonArea;
   
    document.getElementById("uploadOutputArea").innerHTML=totalOutput;


    
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

function ingestInit()
{
    console.log("Ingest init");

    attachStyleSheet();
    fetchResources();
}

ingestInit();
