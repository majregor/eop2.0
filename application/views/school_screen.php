<?php
/**
 *  User Management View
 *
 * This is the main user management view for managing and registering users, schools and districts.
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
    include('forms/school.php');
}
?>

<div>
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedSchoolId" value="" />
    <table id="schoolManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="100%" style="display: block; font-size:13px;">

        <thead>
            <tr>
                <th>School Name</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>District</th>");
                    }
                ?>
                <th>EOP</th>
                <th>Modify School</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($schools as $key=>$value): ?>
            <tr>
                <td>
                    <?php echo $value['name']; ?>
                </td>
                 <?php if($role['create_district']=='y'): ?>
                    <td>
                         <?php echo $value['district_id'] ?>
                    </td>
                <?php endif; ?>
                
                <td>
                    View
                </td>
               
                <td>
                     <?php echo (($value['read_only']=='n')? 'No':'Yes'); ?>
                </td>
                <td>
                    <a class="resetUserPasswordLink"
                       param1="<?php echo($value['screen_name']); ?>"
                       id="<?php echo($value['id']); ?>" href="/user">
                        Edit
                    </a>
                </td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>School Name</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>District</th>");
                    }
                ?>
                <th>EOP</th>
                <th>Modify School</th>
            </tr>
        </tfoot>

    </table>
</div>



<div id="update-user-dialog" title="Update User Profile">
    <?php
        include("forms/update_user.php");
    ?>
</div>


<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        

        $('#schoolManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });


        /**
         * Form Validation
         *
         */

        $("#user_form").validate({
            rules: {
                phone:{
                    phoneUS: true
                },
                user_password: "required",
                user_password_conf: {
                    equalTo: "#user_password"
                }
            }
        });



        

        /**
         *
         * Update User Profile functionality
         */
            $(".modifyUserProfileLink").click(function(){
                var id = $(this).attr('id');
                var first_name = $(this).attr('param1');
                var last_name = $(this).attr('param2');
                var email = $(this).attr('param3');
                var user_name = $(this).attr('param4');
                var phone = $(this).attr('param5');
                var role = $(this).attr('param6');
                var district = $(this).attr('param7');
                var school = $(this).attr('param8');
                var access = $(this).attr('param9');

                $('#first_name_update').val(first_name);
                $('#last_name_update').val(last_name);
                $('#email_update').val(email);
                $('#username_update').val(user_name);
                $('#phone_update').val(phone);
                $('#slctuserrole_update').val(role);
                $('#sltdistrict_update').val(district);
                $('#sltschool_update').val(school);
                $('#user_access_permission_update').val(access);
                $('#user_id_update').val(id);

                //Open the update user dialog form
                $("#update-user-dialog").dialog('open');
                return false;
            });

            $("#update-user-dialog").dialog({
                resizable:      false,
                minHeight:      300,
                minWidth:       500,
                modal:          true,
                autoOpen:       false,
                show:           {
                    effect:     'scale',
                    duration: 300
                }
            });

            function submit_update_user_form(){

                var form_data = {
                    user_id                 : $('#user_id_update').val(),
                    first_name              : $('#first_name_update').val(),
                    last_name               : $('#last_name_update').val(),
                    email                   : $('#email_update').val(),
                    username                : $('#username_update').val(),
                    phone                   : $('#phone_update').val(),
                    role_id                 : $('#slctuserrole_update').val(),
                    school_id               : $('#slctschool_update').val(),
                    access                  : $('#user_access_permission_update').val(),
                    ajax                    : '1'
                };
                $.ajax({
                    url: "<?php echo base_url('user/update'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(response) {
                        location.reload();
                    }
                });

                $('#update-user-dialog').dialog("close");
                return false;
            }

    });
</script>