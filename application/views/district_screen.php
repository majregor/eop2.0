<?php
/**
 *  District Management View
 *
 * This is the main district management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */

//print_r($role);
//echo $this->session->userdata('host_state');


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

if(isset($viewform)){
    include('forms/district.php');
}
?>

<!-- Show only for Super admin and State Admin -->
<?php if($this->session->userdata['role']['level'] < 3): ?>

    <div style="margin:10px 5px 20px 0px;"><a href="<?php echo base_url(); ?>district/add">Add New District</a></div>
<?php endif; ?>
<div>
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedDistrictId" value="" />
    <table id="districtManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="100%" style="width:100%;display: block; font-size:13px;">

        <thead>
            <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;District&nbsp;&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Screen&nbsp;&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;Modify&nbsp;&nbsp;District&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($districts as $key=>$value): ?>
            <tr>
                <td>
                    <?php echo $value['name']; ?>
                </td>
                
                <td>
                    <?php echo $value['screen_name']; ?>
                </td>
               

                <td>
                    <a class="modifyDistrictProfileLink"
                       param1="<?php echo($value['name']); ?>"
                       param2="<?php echo($value['screen_name']); ?>"
                       id="<?php echo($value['id']); ?>" href="/district">
                        Edit
                    </a>
                </td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>District Name</th>
                <th>Screen Name</th>
                <th>Modify District</th>
            </tr>
        </tfoot>

    </table>
</div>



<div id="update-district-dialog" title="Update District Profile">
    <?php
        include("forms/update_district.php");
    ?>
</div>


<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        

        $('#districtManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });


        /**
         * Form Validation
         *
         */

        $("#district_form").validate();

        $("#update_district_form").validate({

            submitHandler: submit_update_district_form
        });



        /**
         *
         * Update District Profile functionality
         */
            $(".modifyDistrictProfileLink").click(function(){
                var id = $(this).attr('id');
                var name = $(this).attr('param1');
                var screen_name = $(this).attr('param2');


                $('#district_name_update').val(name);
                $('#screen_name_update').val(screen_name);
                $('#district_id_update').val(id);

                //Open the update district dialog form
                $("#update-district-dialog").dialog('open');
                return false;
            });

            $("#update-district-dialog").dialog({
                resizable:      false,
                minHeight:      200,
                minWidth:       300,
                modal:          true,
                autoOpen:       false,
                show:           {
                    effect:     'scale',
                    duration: 300
                }
            });

            function submit_update_district_form(){

                var form_data = {
                    district_id             : $('#district_id_update').val(),
                    district_name           : $('#district_name_update').val(),
                    screen_name             : $('#screen_name_update').val(),
                    ajax                    : '1'
                };
                $.ajax({
                    url: "<?php echo base_url('district/update'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(response) {
                        location.reload();
                    }
                });

                $('#update-district-dialog').dialog("close");
                return false;
            }

    });
</script>