<?php 
        include_once 'tools.php';
        $title=createElement('h3','mainPageTitle','title','accessHelperMain');
        $testButton=createButton('testButton','button','testFunction','TESTO');

        $dropDownArea=createElement('p','dropDownArea','outputArea','');

        $scriptLink=
        '
            <script src="js/mainPageScripts.js"></script>
        ';

        $panelLabel=createElement('label','resourceListPanelLabel','panelLabel','Resources');

        $resourcesTextArea=
        '
            <textarea id="resourceListTextArea" name="resourceListTextArea" rows="2" cols="40"></textarea>  
        ';


        $resourceListPanelContents=
                    $panelLabel.
                    $dropDownArea.
                    $resourcesTextArea;
        $resourceListPanel=createElement('div','accessListPanel','panel',$resourceListPanelContents);


        
        $totalOutput=$title.
                    
                    $resourceListPanel.
                    $scriptLink;

        echo $totalOutput;


?>