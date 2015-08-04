
<div id="container">

    <div id="logos">
        <p class="logotxt">EOP ASSIST</p>

        <a href="http://www.ed.gov/" target="_blank" title="Department of Education"><img class="DOEDlogo" src="<?php echo base_url(); ?>assets/img/DOElogo.png"></a>
        <a href="http://rems.ed.gov/" target="_blank" title="Readiness and Emergency Management for Schools"><img class="REMSlogo" src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png"></a>
    </div>


    <fieldset id="signin_menu">

        <p class="logintxttop">The U.S. Department of Education contracted for final products and deliverables that were developed under the ED-ESE-12-O-0036 contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.<br><br>For more information about EOP ASSIST, please contact the REMS TA Center at <a href="mailto:info@remstacenter.org" title="info@remstacenter.org">info@remstacenter.org</a> or on our toll-free telephone number, 1-855-781-REMS [7367]. Our hours of operation are Monday to Friday, 9:00 a.m. to 5:00 p.m., Eastern Time.
        </p>

        <?php
            echo form_open('login/validate', array('class'=>'login_form', 'id'=>'login_form'));
        ?>
            
            <h3 class="title">   Please enter your credentials and click the Sign in button below.</h3>

        <?php if($this->session->flashdata('error')): ?>
            <h3 class='error'><?php echo ($this->session->flashdata('error')); ?></h3>
        <?php endif; ?>
        <br/>
            <h3>
                <span style="color:red">* &nbsp;</span>
                <span style="color:#59B"><strong>Required Field</strong></span>
            </h3>
            <h5>
                <!-- User Authentication is enforced. Please enter credentials to login.-->
            </h5>
            <hr style="height: 0px; color: #59B;background-color:#598; margin: 20px 0px; width: 100% " />
            <label for="username"><span style="color:#59B"><strong>User ID:</strong> &nbsp;<font color="red">*</font></span></label>
            <?php
            $userNameInput = array(
                    'name'      =>  'username',
                    'id'        =>  'username',
                    'value'     =>  '',
                    'required'  =>  'required',
                    'onfocus'   =>  '',
                    'style'     =>  "color:#59B",
                     'minlength' =>  '3'
                );
                echo form_input($userNameInput);
            ?>
            </p>
            <p>
                <label for="password"><strong><span style="color:#59B">Password: &nbsp;<font color="red">*</font></span></strong></label>
                <?php
                    $userPasswordInput = array(
                        'name'      =>  'password',
                        'id'        =>  'password',
                        'value'     =>  '',
                        'required'  =>  'required',
                        'minlength' =>  '6',
                        'onfocus'   =>  '',
                        'style'     =>  "color:#59B"
                    );
                    echo form_password($userPasswordInput);
                ?>
                <!--<div style="float:right;">p strength</div>-->
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



        <p class="logintxtbtm">EOP ASSIST is being made available to the public pursuant to the following conditions.   The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to use and distribute the software created pursuant to the ED-ESE-12-O-0036 contract, for only non-commercial and educational purposes.  This license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding whether a proposed use is allowable under this license or want to request a particular use, please contact Madeline Sullivan at (202) 453-6705.<br><br>
            THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST EXTENT PERMISSIBLE UNDER FEDERAL LAW.</p>

    </fieldset>
    <p class="DOEcr">2015 &copy; United States Department of Education</p>
</div>
