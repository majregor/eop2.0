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
    <fieldset>

        <table class="thform">
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
                </td>
            </tr>
        </table>
    </fieldset>
<?php
}
echo form_close();
?>