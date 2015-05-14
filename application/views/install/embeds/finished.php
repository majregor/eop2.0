<?php
    echo form_open('app/install', array('class'=>'finished_form', 'id'=>'finished_form'));
?>
    <h3 class="title">Configuration Completed</h3>
<?php if(isset($error)): ?>
    <h3 class='error'><?php echo ($error); ?></h3>
<?php endif; ?>

<p>
    Your have finalised the install process.
    <?php echo urldecode($this->session->userdata('user_email')); ?>
</p>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'finished_form_submit',
            'value' =>  'Login',
            'class' =>  'signin_submit',
            'id'    =>  'finished_form_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>