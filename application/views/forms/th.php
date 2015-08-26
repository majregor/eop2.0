<?php
/**
 * th FORM
 *
 * Thread and Hazard Form
 * For creating a new Threat and Hazard
 */
?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

    <h1>Create Threats and Hazards</a></h1>
    <!-- <a href="#.php" id="hideTeamManagementFormLinkId"></a> -->

<?php
if($this->session->userdata['role']['read_only']=='n') {
    echo form_open('plan/add/entity/th', array('class' => 'thManagementForm', 'id' => 'thManagementForm'));
    ?>
    <fieldset class="th">

        <table class="thform">
            <tr>
                <td colspan="2">
                    <p>Please use the form below to record threats and hazards generated from the data sources listed above and any other relevant data sources. You will need to add each threat and hazard separately. Type the name of the threat or hazard in the designated field and then click the Save button to record that threat or hazard in the table below. Repeat this process as many times as necessary to add all threats and hazards.</p>
                    <p>If your team has already recorded threats and hazards and wishes to modify the information, please click the Edit button for the respective threat or hazard. A pre-populated field will appear with previously saved information. After editing the available field, click the Update button. Repeat this process, as needed.</p>

                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name' => 'txtth',
                        'id' => 'txtth',
                        'required' => 'required',
                        'minlength' => '3',
                        'size' => '70'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
            </tr>
            <tr>

                <td align="left">
                    <?php
                    $attributes = array(
                        'name' => 'btnsave',
                        'value' => 'Save',
                        'id' => 'btnsave',
                        'style' => ''
                    );
                    ?>
                    <?php echo form_submit($attributes); ?>

                    <?php
                    $attributes = array(
                        'name' => 'btnreset',
                        'value' => 'Reset',
                        'id' => 'btnreset',
                        'style' => ''
                    );
                    ?>
                    <?php echo form_reset($attributes); ?>
                </td>
                <td align="left">&nbsp;</td>
            </tr>

        </table>
    </fieldset>
<?php
}
echo form_close();
?>