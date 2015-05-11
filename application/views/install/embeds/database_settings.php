<?php
echo form_open('app/install', array('class'=>'database_settings_form', 'id'=>'database_settings_form'));
?>
    <h3 class="title">Database Setup</h3>
    <p>
        <label><span class="inputlabel">Database Type</span> &nbsp; <span class="required">*</span></label><br>
                The type of database where your EOP Data will be stored in.
    </p>

    <p>
        <?php echo form_radio('database_type', 'mysql', TRUE); ?> MySQL
        <?php echo form_radio('database_type', 'sqlite', FALSE); ?> SQLite
        <?php echo form_radio('database_type', 'psql', FALSE); ?> PostgreSQL
        <?php echo form_radio('database_type', 'sqlserver', FALSE); ?>SQL Server

</p>
                        <p>
                        <label><span style="color:#59B; font-weight:bold;">Database Name</span> &nbsp;<font color="red">*</font></label><br>
                        <input type="text" name="database_name">
    The name of the database your data will be stored in. It must exist on your server before EOP can be installed.
                        </p>
                  <p>
                        <label><span style="color:#59B; font-weight:bold;">Database Username</span> &nbsp;<font color="red">*</font></label>
                        <br>
                        <input type="text" name="database_name">
    The database username set with administration priviledges on the database selected.</p>
                    <p>
                        <label><span style="color:#59B; font-weight:bold;">Database Password</span> &nbsp;<font color="red">*</font></label><br>
                        <input type="password" name="database_password">
    The name of the database your data will be stored in. It must exist on your server before EOP can be installed.
                  </p>
                      <p>
                      <input class="signin_submit" value="Save and Continue" tabindex="6" type="submit"/>
                      </p>
<?php
echo form_close();
?>