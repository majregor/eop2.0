<form method="post" id="signin" name="signin" action="ValidateUser.php" onsubmit="return isLoginFormBlank();">
    <input type="hidden" id ="messageToUser" value="<?php
    if (!empty($_SESSION['messageToUser'])) {
        echo $_SESSION['messageToUser'];
        unset($_SESSION['messageToUser']);
    }
    ?>" />
    <h3 class="title">
    	Select a hosting level or profile</h3>
    
    
    <h5>
       <!-- User Authentication is enforced. Please enter credentials to login.-->
    </h5>
    
    <p>
    <input type="radio" name="hosting_level"> <span style="color:#59B"><strong>State Level</strong></span>
    <br>
    <label for="hosting_level">Install EOP Assist at the State Level</label>
    </p>
    <p>
     <input checked type="radio" name="hosting_level"> <span style="color:#59B"><strong>District Level</strong></span><br>
    <label for="hosting_level">Install 
      EOP Assist at the District Level</label>
    </p>
    <p>
      <input class="signin_submit" value="Save and Continue" tabindex="6" type="submit"/>
  </p>
</form>