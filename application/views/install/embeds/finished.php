<?php
    echo form_open('app/install', array('class'=>'verify_requirements_form', 'id'=>'verify_requirements_form'));
?>
    <h3 class="title">Configuration Completed</h3>

<p>
    Your have finalised the install process.
    <?php echo urldecode($this->session->userdata('user_email')); ?>
</p>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'verify_requirements_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'verify_requirements_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>