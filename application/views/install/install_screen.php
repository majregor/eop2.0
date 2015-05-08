
<div id="container">

    <p class="logotxt">EOP ASSIST Installation</p>


    <fieldset id="signin_menu">


        <p class="logintxttop">The U.S. Department of Education contracted for final products and deliverables that were developed under the ED-ESE-12-O-0036 contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.<br /><br />
            EOP ASSIST is being made available to the public pursuant to the following conditions.   The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to use and distribute the software created pursuant to the ED-ESE-12-O-0036 contract, for only non-commercial and educational purposes.  This license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding whether a proposed use is allowable under this license or want to request a particular use, please contact Madeline Sullivan at (202) 453-6705.</p>


        <form method="post" id="signin" name="signin" action="ValidateUser.php" onsubmit="return isLoginFormBlank();">
            <input type="hidden" id ="messageToUser" value="<?php
            if (!empty($_SESSION['messageToUser'])) {
                echo $_SESSION['messageToUser'];
                unset($_SESSION['messageToUser']);
            }
            ?>" />
            <h3 style="color:#59B">
                Please enter your credentials and click the Sign in button below.
            </h3>
            <br />
            <h3>
                <font color="red">* &nbsp;</font>
                <span style="color:#59B"><strong>Required Field</strong></span>
            </h3></p>
            <h5>
                <!-- User Authentication is enforced. Please enter credentials to login.-->
            </h5>
            <hr style="height: 0px; color: #59B;background-color:#598; margin: 20px 0px; width: 100% " />
            <label for="username"><span style="color:#59B"><strong>User ID:</strong> &nbsp;<font color="red">*</font></span></label>

            <input id="username" name="username" value="" title="user id" tabindex="4" type="text" style="color:#59B" onfocus=""/>
            </p>
            <p>
                <label for="password"><strong><span style="color:#59B">Password: &nbsp;<font color="red">*</font></span></strong></label>
                <input id="password" name="password" value="" title="password" tabindex="5" type="password" style="color:#59B" onfocus=""/>
            </p>
            <p>Forgot User ID and/or Password?<p>
            <p>Please contact your District Administrator or School Administrator</p>
            <p class="remember">
                <input class="signin_submit" value="Sign in" tabindex="6" type="submit"/>
                <input class="signin_submit" value="Clear" tabindex="7" type="reset"/>
            </p>
            <div id="extraContent"></div>

            <!--  <p class="forgot"><a href="#" id="forgotUserIdLink">Forgot your User ID?</a> | <a href="#" id="forgotPasswordLink" >Forgot your password?</a> |-->
            <!--<a href="#" id="signupLink">Sign up</a>-->
            <div id="forgotPasswordDiv"></div>
            <hr style="height: 0px; color: #59B;background-color:#598; margin: 20px 0px; width: 100% " />
            <!--<p style="color:#59B;font-weight: bolder"><font color="red">*</font> Required Field</p>-->

            <div id="requestNewAccessDiv"></div>
        </form>

        <div id="logos">
            <a href="http://rems.ed.gov/" target="_blank"><img class="REMSlogo" src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png"></a>
            <a href="http://www.ed.gov/" target="_blank"><img class="DOEDlogo" src="<?php echo base_url(); ?>assets/img/DOElogo.png"></a>
        </div>

        <p class="logintxtbtm">THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST EXTENT PERMISSIBLE UNDER FEDERAL LAW.</p>

    </fieldset>
    <p class="DOEcr">2015 &copy; United States Department of Education</p>
</div>
