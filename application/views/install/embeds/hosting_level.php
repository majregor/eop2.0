<?php
    echo form_open('app/install', array('class'=>'hosting_level_form', 'id'=>'hosting_level_form'));
?>
    <h3 class="title">Select a hosting level or profile</h3>
    <p>
        <?php echo form_radio('pref_hosting_level', 'state', FALSE); ?>
        <span class="inputlabel">State Level</span>
        <br>
        <label for="hosting_level">Install EOP Assist at the State Level</label>
    </p>

    <p>
        <?php echo form_radio('pref_hosting_level', 'district', TRUE); ?>
        <span class="inputlabel">District Level</span>
        <br>
        <label for="hosting_level">Install EOP Assist at the District Level</label>
    </p>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'hosting_level_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'hosting_level_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>