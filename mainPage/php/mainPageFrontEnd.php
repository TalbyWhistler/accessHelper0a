<?php 
        include_once 'tools.php';
        $title=createElement('h3','mainPageTitle','title','accessHelperMain');
        $testButton=createButton('testButton','button','testFunction','TESTO');

        $sendRequestsButton=createButton('sendRequestsButton','button','sendPendingRequests','Send Requests');
        
        $userSubmitButton=createButton('userSubmitButton','button','handleUserSubmit','Submit');
        $userInfoLabel=createElement('label','userInfoLabel','label','Requester Info');
        $br='</br>';
        $userEmailInput=
        '
            <input id="userEmailInput" type="text"/>
        ';

        $userInfoTextArea='<textarea id="userInfoTextArea" name="userInfoTextArea" rows="2" cols="40"></textarea>';  


        $userInfoPanelContents=
            $userInfoLabel.$userEmailInput.$userSubmitButton.
            $br.
            $userInfoTextArea;
        $userInfoPanel=createElement('div','userInfoPanel','panel',$userInfoPanelContents);

        $pendingLabel=createElement('label','pendingRequestLabel','label','Pending Requests');
        $pendingTextArea='<textarea id="pendingTextArea" name="pendingTextArea" rows="4" cols="40"></textarea>';
       
        $pendingRequestsPanelContents=
                        $pendingLabel.
                        $br.
                        $pendingTextArea.$sendRequestsButton;

        $pendingRequestsPanel=createElement('div','pendingRequestsPanel','panel',$pendingRequestsPanelContents);
        



        $dropDownArea=createElement('p','dropDownArea','outputArea','');
        $dropDownSubmitButtonArea=createElement('p','dropDownSubmitButtonArea','outputArea','');

        $scriptLink=
        '
            <script src="js/mainPageScripts.js"></script>
        ';

        $panelLabelResources=createElement('label','resourceListPanelLabel','panelLabel','Resources');

        $resourcesTextArea=
        '
            <textarea id="resourceListTextArea" name="resourceListTextArea" rows="2" cols="40"></textarea>  
        ';


        $resourceListPanelContents=
                    $panelLabelResources.
                    $dropDownArea.$dropDownSubmitButtonArea.
                    $resourcesTextArea;
        $resourceListPanel=createElement('div','accessListPanel','panel',$resourceListPanelContents);


        
        $totalOutput=$title.
                    $userInfoPanel.
                    $resourceListPanel.
                    $pendingRequestsPanel.
                    $scriptLink;

        echo $totalOutput;


?>