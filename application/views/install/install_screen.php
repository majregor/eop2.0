<?php
$step1 = ($this->session->userdata('pref_hosting_level')) ? $this->session->userdata('pref_hosting_level') : null;
$step2 = ($this->session->userdata('requirements_verified'))? $this->session->userdata('requirements_verified') : null;
$step3 = ($this->session->userdata('database_settings_set'))? $this->session->userdata('database_settings_set') : null;
$step4 = ($this->session->userdata('step_admin_account'))? $this->session->userdata('step_admin_account') : null;

?>
    <div id="left-pane" style="width:30%; float:left; display:block;">
        <p>
        <a href="http://rems.ed.gov/" target="_blank"><img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" width="161" height="59" class="REMSlogo"></a>
        </p>
        <ul class="task-list">
            <li id="step_hosting_level" class="<?php echo ($step=='hosting_level')? 'active': (is_null($step1)? '':'done'); ?>">
                Choose Hosting Level
            </li>
            <li id="step_verify_requirements" class="<?php echo ($step == 'verify_requirements')? 'active':(is_null($step2)? '':'done'); ?>">
                Verify Requirements
            </li>
            <li id="step_database_settings" class="<?php echo ($step == 'database_settings')? 'active' : (is_null($step3) ? '' : 'done'); ?>">
                Database Settings
            </li>
            <li id="step_admin_account" class="<?php echo ($step == 'admin_account')? 'active' : (is_null($step4) ? '' : 'done'); ?>">
                Admin Account
            </li>
            <li>Configure  App</li>
            <li>FInished</li>
        </ul>
        <h3>
        <font color="red">* &nbsp;</font>
        <span style="color:#59B"><strong>Required Field</strong></span>
        </h3>
    </div><!-- ENd left-pane -->

    <div id="right-pane" style="width:70%; float:left; display:block;">
    <?php
        if($screen=='hosting_level'){
            include('embeds/hosting_level.php');
        }
    elseif($screen == 'verify_requirements'){
        include('embeds/verify_requirements.php');
    }
    elseif($screen=='database_settings'){
        include('embeds/database_settings.php');
    }
    elseif($screen=='admin_account'){
        include('embeds/admin_account.php');
    }
    ?>
    </div>


    <script type="text/javascript">
        $('#hosting_level_form').submit(function() {
            var selectedVal;
            var selectedOption = $("input[type='radio'][name='pref_hosting_level']:checked");
            if (selectedOption.length > 0) {
                selectedVal = selectedOption.val();
            }
            var form_data = {
                pref_hosting_level: selectedVal,
                ajax: '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);
                    $('#step_hosting_level').removeClass('active').addClass('done');
                    $('#step_verify_requirements').addClass('active');

                }
            });

            return false;
        });


        $('#verify_requirements_form').submit(function() {


            var form_data = {
                ajax: '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);
                    $('#step_verify_requirements').removeClass('active').addClass('done');
                    $('#step_database_settings').addClass('active');

                }
            });

            return false;
        });

        function submit_database_settings_form() {
            var selectedDbVal;
            var selectedDbOption = $("input[type='radio'][name='database_type']:checked");
            if (selectedDbOption.length > 0) {
                selectedDbVal = selectedDbOption.val();
            }

            var form_data = {
                pref_database_type      : selectedDbVal,
                database_name           : $('#database_name').val(),
                database_username       : $('#database_username').val(),
                database_password       : $('#database_password').val(),
                ajax                    : '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);
                    $('#step_database_settings').removeClass('active').addClass('done');
                    $('#step_admin_account').addClass('active');

                }
            });
            alert('you tried to submit me');

            return false;
        }

        /**
         * JQuery form validation
         */
        jQuery.validator.setDefaults({
            //debug: true,
            //success: "valid"
        });

        $("#database_settings_form").validate({
            rules: {
                database_password: "required",
                database_password_conf: {
                    equalTo: "#database_password"
                }
            },
            submitHandler: submit_database_settings_form
        });


    </script>