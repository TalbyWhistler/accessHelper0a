<?php
      //  include 'tools.php';
      $title=createElement('h2','loginTitle','title','Login Area');
      $emailInput=createInput('emailInput','userInput');
      $passwordInput='<input type="password" id="passwordInput" class="input"/>';
      $emailLabel=createElement('label','emailLabel','inputLabel','Email');
      $passwordLabel=createElement('label','passwordLabel','inputLabel','Password');
      $logoutButton=createButton('logoutButton','submitButton','handleLogoutSubmit','Logout');



      $loginSubmit=createButton('loginSubmit','submitButton','loginSubmit','Login');
      $br='<br>';
      $statusIndicator=createElement('label','statusIndicator','statusIndicator','Ok');
     
      $scriptLink='<script src="loginPage/js/loginPageScripts.js" ></script>';
      $loginIndicator=createElement('label','loginStatusIndicator','statusIndicator','');

      $testButton0a=createButton('testButton0','testButton','testFunction0a','Test Button 0a');


      $loginPanelContents=$loginIndicator.
      $br.
      $emailLabel.
        $br.
        $emailInput.
        $br.
        $passwordLabel.
        $br.
        $passwordInput.
        $br.
        $loginSubmit.$logoutButton.
        $br.
        $statusIndicator;
        
        
      $loginPanel=createElement('div','loginPanelContainer','panelContainer',$loginPanelContents);
      $loginForm=createElement('form','loginForm','form',$loginPanel);

      $totalOutput=
            $title.
            $loginPanel.
          //  $testButton0a.
            $scriptLink;

      echo $totalOutput;
?>