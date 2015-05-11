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
            <td></td>
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