<?php
echo form_open('app/install', array('class'=>'admin_account_form', 'id'=>'admin_account_form'));
?>
    <h3 class="title">Super Admin Setup</h3>

    <p>
        <label><span class="inputlabel">User Name</span> <span class="required">*</span> </label><br>
        <?php
            $usernameInput = array(
                'name'      =>  'user_name',
                'id'        =>  'user_name',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
        echo form_input($usernameInput);
        ?>
        The username will be used to login as a super administrator.
    </p>
    <p>
        <label><span class="inputlabel">State</span> <span class="required">*</span> </label><br>
        <?php
            $this->load->helper('state');
            echo state_dropdown('state', 'AL', 'host_state');
        ?>
        Select the state.
    </p>
    <?php if($this->session->userdata('pref_hosting_level')=='district'): ?>
        <p>
            <label><span class="inputlabel">District</span> <span class="required">*</span> </label><br>
            <?php
            $districtInput = array(
                'name'      =>  'district_name',
                'id'        =>  'district_name',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
            echo form_input($districtInput);
            ?>
            School district name
        </p>
    <?php endif; ?>
    <p>
        <label><span class="inputlabel">Email</span> <span class="required">*</span> </label><br>
        <?php
        $userEmailInput = array(
            'name'      =>  'user_email',
            'id'        =>  'user_email',
            'value'     =>  '',
            'required'  =>  'required',
            'type'      =>  'email'
        );
        echo form_input($userEmailInput);
        ?>
        Administrator email
    </p>
    <p>
        <label><span class="inputlabel"> User Password</span> <span class="required">*</span> </label><br>
        <?php
            $userPasswordInput = array(
                'name'      =>  'user_password',
                'id'        =>  'user_password',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6'
            );
            echo form_password($userPasswordInput);
        ?>
    </p>
    <p>
        <label><span class="inputlabel">Confirm Password</span> <span class="required">*</span> </label><br>
        <?php
        $userPasswordConfInput = array(
            'name'      =>  'user_password_conf',
            'id'        =>  'user_password_conf',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '6'
        );
        echo form_password($userPasswordConfInput);
        ?>
    </p>
    <p>
        <?php
        $attributes = array(
            'name'  =>  'admin_account_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'admin_account_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
echo form_close();
?>