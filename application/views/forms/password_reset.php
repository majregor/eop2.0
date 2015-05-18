<?php
/**
 * Password Reset form
 */

echo form_open('user/resetpwd', array('class'=>'pwd_form', 'id'=>'pwd_form'));
?>
<table border="0" width="100%" cellpadding="10">
    <tr>
        <td></td>
        <td><input type="hidden" id="user_id_reset" value="" name="user_id_reset"></td>
    </tr>
    <tr>
        <td>First Name:</td>
        <td><span id="first_name"></span></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><span id="last_name"></span></td>
    </tr>
    <tr>
        <td>User ID:</td>
        <td><span id="user_name"></span> </td>
    </tr>
    <tr>
        <td>Enter New Password:</td>
        <td>
            <?php
            $userPasswordInput = array(
                'name'      =>  'user_password_reset',
                'id'        =>  'user_password_reset',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6'
            );
            echo form_password($userPasswordInput);
            ?>
        </td>
    </tr>
    <tr>
        <td>Confirm New Password:</td>
        <td>
            <?php
            $userPasswordInput = array(
                'name'      =>  'user_password_conf_reset',
                'id'        =>  'user_password_conf_reset',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6'
            );
            echo form_password($userPasswordInput);
            ?>
        </td>
    </tr>
    <tr>

        <td>
            <?php
            $attributes = array(
                'name'  =>  'reset_pwd',
                'value' =>  'Reset Password',
                'id'    =>  'reset_pwd',
                'style' =>  ''
            );
            ?>
            <?php echo form_submit($attributes); ?>
        </td>
        <td>

        </td>
    </tr>
</table>
<?php
echo form_close();
?>