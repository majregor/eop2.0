
    <div id="left-pane" style="width:30%; float:left; display:block;">
        <p>
        <a href="http://rems.ed.gov/" target="_blank"><img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" width="161" height="59" class="REMSlogo"></a>
        </p>
        <ul class="task-list">
            <li id="step_hosting_level" class="<?php echo(($step=='hosting_level')? 'active':(null == $this->session->userdata('pref_hosting_level'))? '':'done'); ?>">
                Choose Hosting Level
            </li>
            <li id="step_verify_requirements" class="<?php echo(($step=='verify_requirements')? 'active':(null == $this->session->userdata('requirements_verified'))? '':'done'); ?>">
                Verify Requirements
            </li>
            <li class="">Database Settings</li>
            <li>Admin Account</li>
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
                    $('#step_hosting_level').removeClass('active').addClass('done');
                    $('#step_verify_requirements').addClass('active');

                }
            });

            return false;
        });


    </script>