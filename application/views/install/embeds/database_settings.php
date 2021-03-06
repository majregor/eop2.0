<?php
    echo form_open('app/install', array('class'=>'database_settings_form', 'id'=>'database_settings_form'));
?>
    <h3 class="title">Database Setup</h3>
    <?php if(isset($error)): ?>
        <h3 class='error'><?php echo ($error); ?></h3>
    <?php endif; ?>
   
    <p>
        <label><span class="inputlabel">Database Type</span> &nbsp; <span class="required">*</span></label><br>
                The type of database where your EOP Data will be stored in.
    </p>

    <p>

        <?php


            $data = array(
                'name'        => 'database_type',
                'id'          => 'mysqlradio',
                'value'       => 'mysqli',
                'checked'     => TRUE,
                'style'       => ''
            );
        echo form_radio($data); ?> <label for="mysqlradio">MySQL</label>
        <?php
            $data = array(
                'name'        => 'database_type',
                'id'          => 'sqlradio',
                'value'       => 'sqlsrv',
                'checked'     => FALSE,
                'style'       => ''
            );
        echo form_radio($data); ?> <label for="sqlradio">MS SQL Server</label>

    </p>
    <p>
        <label><span class="inputlabel">Database Host</span> <span class="required">*</span> </label><br>
        <?php
            $databaseHostInput = array(
                'name'      =>  'host_name',
                'id'        =>  'host_name',
                'value'     =>  'localhost',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
        echo form_input($databaseHostInput);
        ?>
        The name or ip address of the database host. 
    </p>
    <p>
        <label><span class="inputlabel">Database Name</span> <span class="required">*</span> </label><br>
        <?php
            $databaseNameInput = array(
                'name'      =>  'database_name',
                'id'        =>  'database_name',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
        echo form_input($databaseNameInput);
        ?>
        The name of the database your data will be stored in. It must exist on your server before EOP can be installed.
    </p>
    <p>
        <label><span class="inputlabel">Database Username</span> <span class="required">*</span> </label><br>
        <?php
        $databaseUserNameInput = array(
            'name'      =>  'database_username',
            'id'        =>  'database_username',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '3'
        );
        echo form_input($databaseUserNameInput);
        ?>
        The database username set with administration priviledges on the database selected.
    </p>
    <p>
        <label><span class="inputlabel">Database User Password</span> <span class="required">*</span> </label><br>
        <?php
            $databasePasswordInput = array(
                'name'      =>  'database_password',
                'id'        =>  'database_password',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6'
            );
            echo form_password($databasePasswordInput);
        ?>
    </p>
    <p>
        <label><span class="inputlabel">Confirm Password</span> <span class="required">*</span> </label><br>
        <?php
        $databasePasswordConfInput = array(
            'name'      =>  'database_password_conf',
            'id'        =>  'database_password_conf',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '6'
        );
        echo form_password($databasePasswordConfInput);
        ?>
    </p>
    <p>
        <?php
        $attributes = array(
            'name'  =>  'database_settings_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'database_settings_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
echo form_close();
?>