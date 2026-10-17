<?php 
        include_once 'tools.php';
        $br='</br>';
        $title=createElement('h3','mainPageTitle','title','accessHelperMain');
       // $testButton=createButton('testButton','button','testFunction','TESTO');

        /////////  Requester info panel ////////////////////////
       
        $userInfoLabel=createElement('label','userInfoLabel','label','Requester Info');
        $userEmailInput=
        '
            <input id="userEmailInput" type="text"/>
        ';

        $userSubmitButton=createButton('userSubmitButton','button','handleUserSubmit','Submit');
        $userInfoTextArea='<textarea id="userInfoTextArea" name="userInfoTextArea" rows="2" cols="40"></textarea>';  


        $userInfoPanelContents=
            $userInfoLabel.$userEmailInput.$userSubmitButton.
            $br.
            $userInfoTextArea;

        //////////// Resources Panel ////////////////////////////////////
        $userInfoPanel=createElement('div','userInfoPanel','panel',$userInfoPanelContents);
        $panelLabelResources=createElement('label','resourceListPanelLabel','panelLabel','Resources');

        $resourcesTextArea=
        '
            <textarea id="resourceListTextArea" name="resourceListTextArea" rows="2" cols="40"></textarea>  
        ';

        $dropDownArea=createElement('p','dropDownArea','outputArea','');
        $dropDownSubmitButtonArea=createElement('p','dropDownSubmitButtonArea','outputArea','');

        $resourceListPanelContents=
                    $panelLabelResources.
                    $dropDownArea.$dropDownSubmitButtonArea.
                    $resourcesTextArea;
        $resourceListPanel=createElement('div','accessListPanel','panel',$resourceListPanelContents);

        ////////////////////////////pending requests panel ////////////////////////////////////
        $pendingLabel=createElement('label','pendingRequestLabel','label','Pending Requests');
        $pendingTextArea='<textarea id="pendingTextArea" name="pendingTextArea" rows="4" cols="40"></textarea>';
        $sendRequestsButton=createButton('sendRequestsButton','button','sendPendingRequests','Send Requests');
        $pendingRequestsPanelContents=
                        $pendingLabel.
                        $br.
                        $pendingTextArea.$sendRequestsButton;

        $pendingRequestsPanel=createElement('div','pendingRequestsPanel','panel',$pendingRequestsPanelContents);
        
        ///////////////////////sent requests panel/////////////////////////////////////////
        $sentLabel=createElement('label','sentRequestLabel','label','Sent Requests');
        $sentTextArea='<textarea id="sentTextArea" name="sentTextArea" rows="4" cols="40"></textarea>';
        $sentRequestPanelContents=
                            $sentLabel.
                            $br.
                            $sentTextArea;
        $sentRequestsPanel=createElement('div','sentRequestsPanel','panel',$sentRequestPanelContents);

        ////////////////////approved requests panel/////////////////////////////////////////////

        $approvedLabel=createElement('label','approvedLabel','label','approved');
        $approvedTextArea='<textarea id="approvedTextArea" name="approvedTextArea" rows="4" cols="40"></textarea>';
        $approvedPurge=createButton('approvedPurge','button','purgeApproved','Purge List');


        $approvedPanelContents=
                        $approvedLabel.$approvedPurge.
                        $br.
                        $approvedTextArea;
        $approvedPanel=createElement('div','approvedPanel','panel',$approvedPanelContents);

        $scriptLink=
        '
            <script src="js/mainPageScripts.js"></script>
        ';

       ////////////////////rejected requests panel //////////////////////////////////////////////////
       $rejectedLabel=createElement('label','rejectedLabel','label','rejected');
       $rejectedPurge=createButton('rejectedPurge','button','purgeRejected','Purge List');
       $rejectedTextArea='<textarea id="approvedTextArea" name="approvedTextArea" rows="4" cols="40"></textarea>';

        $rejectedPanelContents=
                    $rejectedLabel.$rejectedPurge.
                    $br.
                    $rejectedTextArea;
        $rejectedPanel=createElement('div','rejectedPanel','panel',$rejectedPanelContents);
       
        //////////////need info panel ////////////////////////////////
        $needInfoLabel=createElement('label','needInfoLabel','label','needMoreInfo');
        $needInfoPurge=createButton('needInfoPurge','button','purgeNeedInfo','Purge List');
        $needInfoTextArea='<textarea id="needInfoTextArea" name="needInfoTextArea" rows="4" cols="40"></textarea>';
        $needInfoPanelContents=
                            $needInfoLabel.$needInfoPurge.
                            $br.
                            $needInfoTextArea;
        $needInfoPanel=createElement('div','needInfoPanel','panel',$needInfoPanelContents);


        ///////////////test compose mail////////////////////////////////
        $testMailButton=createButton('testComposeMailButton','button','testComposeMail','Test Mailer');
        
        $totalOutput=$title.
                    $userInfoPanel.
                    $resourceListPanel.
                    $pendingRequestsPanel.
                    $sentRequestsPanel.
                    $approvedPanel.
                    $rejectedPanel.
                    $needInfoPanel.
                    $testMailButton.
                    $scriptLink;

        echo $totalOutput;


?>