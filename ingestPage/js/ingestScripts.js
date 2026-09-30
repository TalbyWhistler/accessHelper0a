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

ingestInit();
