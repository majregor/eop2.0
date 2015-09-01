<style>
    .content p{
        margin: 1em;
        width:95%;
        font-size: 12px;
        color: #444444;
    }
</style>
<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('error'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<div class=" boxed-group" style="text-align:center; margin-top:20px;">
    <h3 id="pane-title">EOP ASSIST 1.0 Database Information</h3>
    <div class="boxed-group-inner clearfix" style="padding: 10px;">

        <div class="left" style="width:35%; text-align: left;">


            <p>EOP ASSIST uses a database system that allows large amounts of data to be stored and retrieved in a fast and efficient manner.
            </p>

            <p>EOP ASSIST's database structure has been changed in order to provide new useful features that were not part of the recent version. This migration module will automatically migrate your data from the old database system into a new database system that is usable by EOP 2.0, it only requires that your old database be available.<br>Please check your database details and enter them here.
            </p>
        </div>
        <div class="right" style="width:60%; text-align: left;">

            <?php  echo form_open('migrate/run', array('class'=>'database_form', 'id'=>'database_form'));  ?>
            <input type="hidden" name="form_name" value="database_form">
            <p>
                <span class="required">*</span>
                <label for="district_name_update">Database Type</label>
                <br>
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_type',
                    'id'        =>  'database_type',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '65%',
                    'value'     =>   'MySQL',
                    'disabled' =>   'disabled'
                );
                echo form_input($inputAttributes)

                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Host</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_host',
                    'id'        =>  'database_host',
                    'value'     =>  'localhost',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Name</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_name',
                    'id'        =>  'database_name',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Username</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_user_name',
                    'id'        =>  'database_user_name',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Password</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_password',
                    'id'        =>  'database_password',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <?php
                $attributes = array(
                    'name'  =>  'btnsave',
                    'value' =>  'Migrate',
                    'id'    =>  'btnsave',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

                <?php
                $attributes = array(
                    'name'  =>  'btnreset',
                    'value' =>  'Reset',
                    'id'    =>  'btnreset',
                    'style' =>  ''
                );
                ?>
                <?php echo form_reset($attributes); ?>
            </p>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>


