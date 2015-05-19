<?php
/**
 *  Form that manages school profile updates/edits
 */

echo form_open('school/update', array('class'=>'update_school_form', 'id'=>'update_school_form'));

?>

<fieldset>
    <input type="hidden" name="school_id_update" id="school_id_update" value="">
    <legend>School Information</legend>
    <p>
        <span class="required">*</span>
        <label for="school_name_update">School Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'school_name_update',
            'id'        =>  'school_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
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
    'name'  =>  'update_school_submit',
    'value' =>  'Update',
    'id'    =>  'update_school_submit',
    'style' =>  ''
);
?>
<?php echo form_submit($attributes); ?>

<?php echo(form_close()); ?>