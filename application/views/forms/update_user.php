<?php
/**
 *  Form that manages user profile updates/edits
 */

echo form_open('user/update', array('class'=>'update_user_form', 'id'=>'update_user_form'));

?>
<style type="text/css">
    fieldset label{ display: inline-block; min-width: 120px;}
    fieldset p{ margin:10px 0px;}

</style>

<fieldset>
    <input type="hidden" name="user_id_update" id="user_id_update" value="">
    <input type="hidden" name="role_id_update" id="role_id_update" value="">
    <legend>Personal Information</legend>
    <p>
        <span class="required">*</span>
        <label for="first_name_update">First Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'first_name_update',
            'id'        =>  'first_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
        ?>

    </p>
    <p>
        <span class="required">*</span>
        <label for="last_name_update">Last Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'last_name_update',
            'id'        =>  'last_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span class="required">*</span>
        <label for="email_update">Email:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'email_update',
            'id'        =>  'email_update',
            'required'  =>  'required',
            'minlength' =>  '3',
            'type'      =>  'email',
            'size'      =>  '36'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span class="required">*</span>
        <label for="username_update">user ID:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'username_update',
            'id'        =>  'username_update',
            'required'  =>  'required',
            'minlength' =>  '2',
            'size'      =>  '30'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span>&nbsp;</span>
        <label for="phone_update">Phone Number:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'phone_update',
            'id'        =>  'phone_update',
            'size'      =>  18
        );
        echo form_input($inputAttributes);
        ?>
    </p>
</fieldset>

<fieldset>
    <legend for="slctuserrole_update">EOP Access</legend>
    <p>
        <label for="slctuserrole_update">User's Role</label>
        <?php
        $options = array();
        $options['empty'] = '--Select--';
        foreach($roles as $rowIndex => $row){
            $options[$row['role_id']] = $row['title'];
        }

        $otherAttributes = 'id="slctuserrole_update" disabled="disabled" style=""';
        reset($options);
        $first_key = key($options);
        echo form_dropdown('slctuserrole_update', $options, "$first_key", $otherAttributes);
        ?>
    </p>
    <?php if($role['level']<2): ?>
    <p id="districtInputHolder">
        <label for="sltdistrict_update">District</label>
        <?php
        $options = array();
        $options['empty'] = '--Select--';
        foreach($districts as $rowIndex => $row){
            $options[$row['id']] = $row['name'];
        }

        $otherAttributes = 'id="sltdistrict_update" style=""';
        reset($options);
        $first_key = key($options);
        echo form_dropdown('sltdistrict_update', $options, "$first_key", $otherAttributes);
        ?>
    </p>


    <p id="SchoolInputHolder">
        <label for="sltschool_update">School:</label>
        <?php
        $options = array();
        $options['empty'] = '--Select--';
        foreach($schools as $rowIndex => $row){
            $options[$row['id']] = $row['name'];
        }

        $otherAttributes = 'id="sltschool_update" style=""';
        reset($options);
        $first_key = key($options);
        echo form_dropdown('sltschool_update', $options, "$first_key", $otherAttributes);
        ?>
    </p>

    <?php endif; ?>

    <p>
        <label for="user_access_permission_update">View Only:</label>
        <?php
        $options = array(
            'y'      => 'Yes',
            'n'      =>  'No'
        );

        $otherAttributes = 'id="user_access_permission_update" style=""';
        echo form_dropdown('user_access_permission_update', $options, 'y', $otherAttributes);
        ?>

    </p>
</fieldset>
<?php
$attributes = array(
    'name'  =>  'update_user_submit',
    'value' =>  'Update',
    'id'    =>  'update_user_submit',
    'style' =>  ''
);
?>
<?php echo form_submit($attributes); ?>

<?php echo(form_close()); ?>