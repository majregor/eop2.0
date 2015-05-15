<?php
/**
 *  User Management Form
 *
 * Displays form for adding and editing users.
 *
 */
?>

<h1>Create User</h1>
<?php
    echo form_open('user/add', array('class'=>'user_form', 'id'=>'user_form'));
?>
    <div id="errorDiv"></div>
    <table border="1" width="100%" rules="all">
        <tr>
            <td width="15%"><span class="required">*</span> First Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'first_name',
                    'id'        =>  'first_name',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '70'
                );
                echo form_input($inputAttributes);
                ?>

            </td>
        </tr>
        <tr>
            <td><span class="required" >*</span> Last Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'last_name',
                    'id'        =>  'last_name',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="required">*</span> Email:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'email',
                    'id'        =>  'email',
                    'required'  =>  'required',
                    'minlength' =>  '3',
                    'type'      =>  'email',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'phone',
                    'id'        =>  'phone',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="required">*</span> User ID:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'username',
                    'id'        =>  'username',
                    'required'  =>  'required',
                    'minlength' =>  '2',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td><span class="required" >*</span> Password:</td>
            <td>
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
                 &nbsp;&nbsp; Confirm Password:
                <?php
                $userPasswordInput = array(
                    'name'      =>  'user_password_conf',
                    'id'        =>  'user_password_conf',
                    'value'     =>  '',
                    'required'  =>  'required',
                    'minlength'  =>  '6'
                );
                echo form_password($userPasswordInput);
                ?>
            </td>
        </tr>

        <tr>
            <td><span class="required">*</span> User Role:</td>
            <td>
                <div id="userRoleDiv_MODIFIED">
                    <?php
                        $options = array();
                        foreach($roles as $rowIndex => $row){
                            $options[$row['role_id']] = $row['title'];
                        }

                        $otherAttributes = 'id="slctuserrole" style=""';
                        reset($options);
                        $first_key = key($options);
                        echo form_dropdown('slctuserrole', $options, "$first_key", $otherAttributes);
                    ?>

                </div>
            </td>
        </tr>
        <tr id="districtRow" style="display:none">
            <td><span class="required">*</span>District:</td>
            <td>
                <select name="slctzone" id="slctzone" style="width:100%">
                    <option value="" selected="selected">--Select--</option>
                    <?php
                    while($zoneRow = mysqli_fetch_object($zoneList)){
                        ?>
                        <option value="<?php echo $zoneRow->id;?>"><?php echo $zoneRow->display_name;?></option>
                    <?php
                    }//end while loop
                    ?>
                </select>
            </td>
        </tr>
        <tr id="subDistrictRow" style="display:none">
            <td><span class="required">*</span>School:</td>
            <td>
                <select name="slctsubdistrict" id="slctsubdistrict" style="width:100%">
                    <option value="" selected="selected">--Select--</option>

                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'user_form_submit',
                    'value' =>  'Save',
                    'id'    =>  'user_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

            </td>
        </tr>
    </table>
<?php
echo form_close();
?>