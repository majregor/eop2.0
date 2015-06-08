<?php
echo form_open('plan/update/entity/th', array('class'=>'updateThForm', 'id'=>'updateThForm'));
?>
    <style type="text/css">
        fieldset p{ margin:10px 0px;}
    </style>
    <fieldset id="updatethform">
        <input type="hidden" id="updateid" name="updateid"/>

        <legend>Threat and Hazard</legend>
            <p>
                <label for="updatetxtname"> Name:</label>

                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtname',
                        'id'        =>  'updatetxtname',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
            </p>
    </fieldset>

        <?php
        $attributes = array(
            'name'  =>  'updatebtnsave',
            'value' =>  'Save',
            'id'    =>  'updatebtnsave',
            'style' =>  ''
        );
        ?>


<?php echo form_submit($attributes); ?>

<?php
echo form_close();
?>