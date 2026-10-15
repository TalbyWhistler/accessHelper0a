
// global variable for the requester email once submitted
let userSubmittedEmail='';

// global variable for the name of the resource once submitted 
let userSubmittedResource='';


// function to test connection to the script file
function testFunction()
{
    console.log("Test function javascript");
    callBackend('testFunction','',console.log);
}


// function to fetch the resource list to populate the drop down menu
function fetchResourceList()
{
    callBackend('fetchResourceList','',handleFetchResourceList);
}


// handles the resourceList data and populates the dropDown

function handleFetchResourceList(data)
{
    let outputOpener=`<select onchange="fetchResourceInfo()"name="resourceDropdown" id="resourceDropdown">`;
    let outputCloser=`</select>`;
    let outputMiddle='<option value=""></option>';
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

// gets first name ,last name , title etc of the approver from the resource name
function fetchResourceInfo()
{
    console.log("Fetch resource info");
    let resourceName=document.getElementById("resourceDropdown").value;
    userSubmittedResource=resourceName;
    console.log(document.getElementById("resourceDropdown").value);
    let params={"resourceName":resourceName};
    let functionName="fetchResourceInfo";
    callBackend(functionName,params,handleFetchResourceInfo);
    //callBackend("fetchResourceInfo")
    if (checkUserInfoPopulation())
    {
        conjureSubmitRequestButton();
        console.log("True true!"); 
    }

}

// handles the resource info once fetched and lists it in the resourceListTextArea textbox

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
        `${data[i]["firstName"]} ${data[i]["lastName"]} ${data[i]["title"]}\n`;
    }

    let totalOutput=
          outputMiddle;
    document.getElementById("resourceListTextArea").innerHTML=totalOutput;
}

// handles the submit button on the requester user email(or name)input.
function handleUserSubmit()
{
    console.log('Handle user submit');
    let submittedEmail=document.getElementById("userEmailInput").value;
    let params={"userEmail":submittedEmail};
    userSubmittedEmail=submittedEmail;
    callBackend('userLookupByEmail',params,handleUserLookupInfo );
    if (checkUserInfoPopulation())
    {
        conjureSubmitRequestButton();
        console.log("True true");
    }
}

// handles the user email info lookup and prints out in userInfoTextArea wether there is additional information or not

function handleUserLookupInfo(data)
{
    //console.log(data);
    if (data.length==0)
    {
        //console.log('No additional requester info.');
        document.getElementById("userInfoTextArea").innerHTML=userSubmittedEmail.length>0?userSubmittedEmail:'' + 'No additional requester info.';
    }
    else 
    {
        console.log(data);
        let userInfo=data[0]["firstName"] + " " + data[0]["lastName"] + " " + data[0]["title"] + " " + data[0]["team"]; 
        document.getElementById("userInfoTextArea").innerHTML=userInfo;

    }
    //checkUserInfoPopulation();
}

// to check wether the requester input and resource choice are both populated
function checkUserInfoPopulation()
{

    let populated0=userSubmittedEmail;
    let populated1=document.getElementById("resourceDropdown").value;
    if(populated0 && populated1)
    {
        console.log("Both user resource request areas are populated");
        return true;
    }
    return false;
}


// conjures the submit request button (once checkUserInfoPopulation is true)
function conjureSubmitRequestButton()
{
    let submitRequestButton=
    `<button onclick='handleSubmitRequest()'>Submit</button>`;
    document.getElementById("dropDownSubmitButtonArea").innerHTML=submitRequestButton;
}

// handles the submitted request of both a requester and a resource this should transit the request to the database.  zeros out the inputs.
function handleSubmitRequest()
{
    console.log("User submitted email ",userSubmittedEmail);
    console.log("User submitted resource name ",userSubmittedResource);
    document.getElementById("dropDownSubmitButtonArea").innerHTML='';
    //let inputArray=['userEmailInput','userInfoTextArea','resourceListTextArea'];
    

    document.getElementById("userEmailInput").value='';
    document.getElementById("userInfoTextArea").innerHTML='';
    document.getElementById("resourceListTextArea").innerHTML='';

    functionName='createRequest';
    params={"requesterId":userSubmittedEmail,"resourceId":userSubmittedResource};
    callBackend(functionName,params,mainPageInit)
}

function fetchPendingRequests()
{
    let functionName='fetchPendingRequests';
    callBackend(functionName,'',handleFetchPending);
}


function sendPendingRequests()
{
    console.log("Send pending requests button has been hit");
}


function handleFetchPending(data)
{
    console.log(data);
    let outputMessage='';

    for (let i=0;i<data.length;i++)
    {
        outputMessage=outputMessage+data[i]["requester"] + "-" + data[i]["resource"];
    }
    document.getElementById("pendingTextArea").innerHTML=outputMessage;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
    fetchPendingRequests();
}



mainPageInit();