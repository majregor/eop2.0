<?php
/**
 *  Form that manages district profile updates/edits
 */

echo form_open('district/update', array('class'=>'update_district_form', 'id'=>'update_district_form'));

?>

<fieldset>
    <input type="hidden" name="district_id_update" id="district_id_update" value="">
    <legend>School Information</legend>
    <p>
        <span class="required">*</span>
        <label for="district_name_update">School Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'district_name_update',
            'id'        =>  'district_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes)

        ?>
    </p>
    <p>
        <span class="required">*</span>
        <label for="screen_name_update">Last Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'screen_name_update',
            'id'        =>  'screen_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
        ?>
    </p>

</fieldset>

<?php
$attributes = array(
    'name'  =>  'update_district_submit',
    'value' =>  'Update',
    'id'    =>  'update_district_submit',
    'style' =>  ''
);
?>
<?php echo form_submit($attributes); ?>

<?php echo(form_close()); ?>