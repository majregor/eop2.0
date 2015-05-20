<?php
/**
 *  State Access Management View
 *
 * This is the main district management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */
//echo $stateWideStateAccess;

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<?php
    if((null != $this->session->flashdata('error'))):
?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp; ! <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp; ! <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>



<?php 
// Include the admin menu
include('embeds/admin_menu.php');

?>

<div>
    <table width="100%" class="adminTable">
        <tr>
            <td></td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <tr>
            <td>State Access to School EOPs</td>
            <td>
                <span id="state_access_icon" class="<?php echo (($stateWideStateAccess=='write' || $stateWideStateAccess=='read')? 'approved_button':'revoked_button'); ?>"></span>
                <span id="access-label"><?php echo (($stateWideStateAccess=='write' || $stateWideStateAccess=='read')? 'Enabled':'Disabled'); ?></span>
            </td>
            <td>
                <div id="" class="approval-holder">
                    <?php if($stateWideStateAccess == 'write' || $stateWideStateAccess == 'read'): ?>
                        <button value="" class="btn-revoke"><em class="leftImage revoke"></em>Disable</button>
                    <?php endif; ?>
                    <?php if($stateWideStateAccess == 'deny'): ?>
                     <button value="" class="btn-approve"><em class="leftImage approve"></em>Enable</button>
                    <?php endif; ?>

                </div>
            </td>
        </tr>
    </table>
</div>






<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        $(document).on("click", '.btn-approve', function(event){
            var form_data = {
                ajax                    : '1'
            };
            $.ajax({
                url: "<?php echo base_url('access/grant_statewide_access'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {
                    if(response == 1){
                       $('#access-label').html('Enabled');
                       $('#state_access_icon').removeClass('revoked_button');
                       $('#state_access_icon').addClass('approved_button');
                        var btnString = "<button value='' class='btn-revoke'><em class='leftImage revoke'></em>Disable</button>";
                        $('.approval-holder').html(btnString);
                    }
                    else{
                        alert('Operation failed, Please refresh page and try again!')
                    }
                }
            });

            $('#update-district-dialog').dialog("close");
            return false;
        });

        $(document).on("click", '.btn-revoke', function(event){
            var form_data = {
                ajax                    : '1'
            };
            $.ajax({
                url: "<?php echo base_url('access/revoke_statewide_access'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {
                    if(response == 1){
                        $('#access-label').html('Disabled');
                        $('#state_access_icon').removeClass('approved_button');
                        $('#state_access_icon').addClass('revoked_button');
                        var btnString = "<button value='' class='btn-approve'><em class='leftImage approve'></em>Enable</button>";
                        $('.approval-holder').html(btnString);
                    }
                    else{
                        alert('Operation failed, Please refresh page and try again!')
                    }
                }
            });

            $('#update-district-dialog').dialog("close");
            return false;
        });




    });
</script>