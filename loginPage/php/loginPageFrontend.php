<?php
      //  include 'tools.php';
      $title=createElement('h2','loginTitle','title','Login Area');
      $emailInput=createInput('emailInput','userInput');
      $passwordInput='<input type="password" id="passwordInput" class="input"/>';
      $emailLabel=createElement('label','emailLabel','inputLabel','Email');
      $passwordLabel=createElement('label','passwordLabel','inputLabel','Password');



      $loginSubmit=createButton('loginSubmit','submitButton','loginSubmit','Login');
      $br='<br>';
      $statusIndicator=createElement('label','loginStatusIndicator','statusIndicator','Ok');
     
      $scriptLink='<script src="loginPage/js/loginPageScripts.js" ></script>';



      $loginPanelContents=$emailLabel.
        $br.
        $emailInput.
        $br.
        $passwordLabel.
        $br.
        $passwordInput.
        $br.
        $loginSubmit.
        $br.
        $statusIndicator;
      $loginPanel=createElement('div','loginPanelContainer','panelContainer',$loginPanelContents);
      $loginForm=createElement('form','loginForm','form',$loginPanel);

      $totalOutput=
            $title.
            $loginPanel.
            $scriptLink;

      echo $totalOutput;
?>