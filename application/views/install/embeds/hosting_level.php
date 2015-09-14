<?php
    echo form_open('app/install', array('class'=>'hosting_level_form', 'id'=>'hosting_level_form'));
?>
    <h3 class="title">Select a hosting level or profile</h3>
    <p>
        <?php
            $data = array(
                'name'        => 'pref_hosting_level',
                'id'          => 'state-radio',
                'value'       => 'state',
                'checked'     => FALSE,
                'style'       => ''
            );
            echo form_radio($data);
        ?>
        <label for="state-radio" class="inputlabel">State Level</label>
        <br>
        <label for="state-radio">Install EOP Assist at the State Level</label>
    </p>

    <p>
        <?php
            $data = array(
                'name'        => 'pref_hosting_level',
                'id'          => 'district-radio',
                'value'       => 'district',
                'checked'     => TRUE,
                'style'       => ''
            );
        echo form_radio($data);
        ?>
        <label for="district-radio" class="inputlabel">District Level</label>
        <br>
        <label for="district-radio">Install EOP Assist at the District Level</label>
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