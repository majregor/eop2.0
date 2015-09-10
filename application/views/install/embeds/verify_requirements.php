<?php
    echo form_open('app/install', array('class'=>'verify_requirements_form', 'id'=>'verify_requirements_form'));
?>
    <h3 class="title">Verify System Requirements</h3>

<table>
    <thead>
    <tr>
        <th></th>
    </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <?php

                $php        =   $status['php'];
                $errors     =   isset($status['fatal_errs'])? $status['fatal_errs'] : array();
                $warnings   =   isset($status['warnings']) ? $status['warnings'] : array();
                ?>
                <h3>PHP Version: <?php echo($php['version']); ?></h3>
                <div id="errorDiv">
                    <?php echo (count($errors)>0)? '<h3>Required</h3>': '<div id="errorDiv"><div class="notify notify-green"> All required libraries installed and loaded successfully</div></div>'; ?>
                    <?php foreach($errors as $error): ?>
                        <div class="notify notify-red"> <?php echo ("Required library <strong><em>".$error['library']."</em></strong> -- ".$error['message']); ?></div>
                    <?php endforeach; ?>
                </div>

                <div id="errorDiv">
                    <h3>Warning</h3>
                    <?php foreach($warnings as $warning): ?>
                        <div class="notify notify-yellow"><?php echo ("<strong><em>".$warning['library']."</em></strong> -- ".$warning['message']); ?></div>
                    <?php endforeach; ?>
                </div>
            </td>
        </tr>
    </tbody>

    <tfoot>
    <tr>
        <th></th>
    </tr>
    </tfoot>
</table>

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