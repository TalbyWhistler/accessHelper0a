


function testFunction()
{
    console.log("Test function javascript");
    callBackend('testFunction','',console.log);
}

function fetchResourceList()
{
    callBackend('fetchResourceList','',handleFetchResourceList);
}

function handleFetchResourceList(data)
{
    let outputOpener=`<select onchange="fetchResourceInfo()"name="resourceDropdown" id="resourceDropdown">`;
    let outputCloser=`</select>`;
    let outputMiddle='';
    console.log(data);
    for(let i = 0;i<data.length;i++)
    {
        console.log(data[i]["resourceName"]);
        outputMiddle=outputMiddle+
        `
            <option value="${data[i]["resourceName"]}">${data[i]["resourceName"]}</option>
        `;
    }

    let totalOutput=
        outputOpener+
        outputMiddle+
        outputCloser;
    document.getElementById("dropDownArea").innerHTML=totalOutput;

}


function fetchResourceInfo()
{
    console.log("Fetch resource info");
    let resourceName=document.getElementById("resourceDropdown").value;
    console.log(document.getElementById("resourceDropdown").value);
    let params={"resourceName":resourceName};
    let functionName="fetchResourceInfo";
    callBackend(functionName,params,handleFetchResourceInfo);
    //callBackend("fetchResourceInfo")
}

function handleFetchResourceInfo(data)
{
    console.log(data);
    let outputOpener=
    `
        <ul>
    `;

    let outputCloser=
    `
        </ul>
    `;

    let outputMiddle = '';

    for (let i = 0;i < data.length;i++)
    {
        outputMiddle=outputMiddle+
        `${data[i]["firstName"]} ${data[i]["lastName"]} ${data[i]["title"]}`;
    }

    let totalOutput=
          outputMiddle;
    document.getElementById("resourceListTextArea").innerHTML=totalOutput;
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



function attachStyleSheet()
{
    console.log("ATTACH style sheet");
    const styleSheetLocation='css/mainPageStyles.css';
    const styleLink=document.createElement('link');
    styleLink.rel='stylesheet';
    styleLink.type='text/css';
    styleLink.href=styleSheetLocation;
    document.head.appendChild(styleLink);  
}




function mainPageInit()
{
    console.log("mainPageInit");
    attachStyleSheet();
    fetchResourceList();
}



mainPageInit();