<?php
/**
 *  User Management View
 *
 * This is the main user management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */

//print_r($role);

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
    include('forms/user.php');
}
?>

<div>
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedUserId" value="" />
    <table id="userManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="100%" style="display: block; font-size:13px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>User&nbsp;ID</th>
                <th>Status</th>
                <th>User Role</th>
                <th>School</th>
                <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>District</th>");
                    }
                ?>
               
                <th>View Only</th>
                <th>Password</th>
                <th>Modify User</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($users as $key=>$value): ?>
            <tr>
                <td>
                    <?php echo $value['first_name']." ".$value['last_name']; ?>
                </td>
                <td>
                    <?php echo $value['email']; ?>
                </td>
                <td>
                    <?php echo $value['username']; ?>
                </td>
                <td>
                    <?php echo $value['status']; ?>
                </td>
                <td>
                    <?php echo $value['role']; ?>
                </td>
                <td>
                    <?php echo $value['school'] ?>
                </td>
                <?php if($role['create_district']=='y'): ?>
                    <td>
                         <?php echo $value['district'] ?>
                    </td>
                <?php endif; ?>
                <td>
                     <?php echo (($value['read_only']=='n')? 'No':'Yes'); ?>
                </td>
                <td>
                    <a class="resetUserPasswordLink"
                       param1="<?php echo($value['first_name']); ?>"
                       param2="<?php echo($value['last_name']); ?>"
                       param3="<?php echo($value['username']); ?>"
                       id="<?php echo($value['user_id']); ?>" href="/user">
                        Reset
                    </a>
                </td>
                <td>
                    <a class="modifyUserProfileLink"
                       param1="<?php echo($value['first_name']); ?>"
                       param2="<?php echo($value['last_name']); ?>"
                       param3="<?php echo($value['email']); ?>"
                       param4="<?php echo($value['username']); ?>"
                       param5="<?php echo($value['phone']); ?>"
                       param6="<?php echo($value['role_id']); ?>"
                       param7="district"
                       param8="<?php echo($value['school_id']); ?>"
                       param9="access"
                       id="<?php echo($value['user_id']); ?>" href="/user">
                        Edit
                    </a>
                     &nbsp;|&nbsp;
                    <?php if($value['status'] == 'active'): ?>
                        <a class="blockUserLink"
                           id="<?php echo($value['user_id']); ?>" href="/user">
                            Block
                        </a>

                    <?php elseif($value['status'] == 'blocked' || !isset($value['status'])): ?>
                        <a class="unblockUserLink"
                           id="<?php echo($value['user_id']); ?>" href="/user">
                            Activate
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>User ID</th>
                <th>Status</th>
                <th>User Role</th>
                <th>School</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>District</th>");
                    }
                ?>
                <th>View Only</th>
                <th>Password</th>
                <th>Modify User</th>
            </tr>
        </tfoot>

    </table>
</div>

<div id="reset-pwd-dialog" title="Reset Password">
    <?php
        include("forms/password_reset.php");
    ?>
</div>

<div id="update-user-dialog" title="Update User Profile">
    <?php
        include("forms/update_user.php");
    ?>
</div>

<div id="block-user-dialog" title="Block User">
    <p>This action will block this user. Press OK to Continue.</p>
</div>
<div id="unblock-user-dialog" title="Block User">
    <p>This will activate the user. Press OK to Continue</p>
</div>

<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        

        $('#userManagementTbl').DataTable({
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

        $("#pwd_form").validate({
            rules: {
                user_password_reset: "required",
                user_password_conf_reset: {
                    equalTo: "#user_password_reset"
                }
            },
            submitHandler: submit_pwd_form
        });

        $("#update_user_form").validate({
            rules: {
                phone_update:{
                    phoneUS: true
                }
            },
            submitHandler: submit_update_user_form
        });




        /**
         *
         * Reset Password functionality
         */
        $(".resetUserPasswordLink").click(function(){
            var id = $(this).attr('id');
            var first_name = $(this).attr('param1');
            var last_name = $(this).attr('param2');
            var user_name = $(this).attr('param3');

            $('#first_name').html(first_name);
            $('#last_name').html(last_name);
            $('#user_name').html(user_name);
            $('#user_id_reset').val(id);

            //Open the reset password dialog form
            $("#reset-pwd-dialog").dialog('open');
            return false;
        });

        $("#reset-pwd-dialog").dialog({
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

        function submit_pwd_form(){

            // TO use encodeURIComponent() only when we use a concocted string but as for now the formdata ensures
            // that jquery takes care of the encoding
            var form_data = {
                user_id               : $('#user_id_reset').val(),
                new_password              : $('#user_password_reset').val(),
                ajax                    : '1'
            };

            $.ajax({
                url: "<?php echo base_url('user/resetpwd'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {
                    location.reload();
                }
            });

            $('#reset-pwd-dialog').dialog("close");
            return false;

        }



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


            /**
            * Block User functionality
            */

            $('.blockUserLink').click(function(){
                var id = $(this).attr('id');
                $('#selectedUserId').val(id);
                blockUserDialog.dialog('open');
                return false;
            });

            $('.unblockUserLink').click(function(){
                var id = $(this).attr('id');
                $('#selectedUserId').val(id);
                unblockUserDialog.dialog('open');
                return false;
            });

            function getSelectedId(){
                return selectedUserId;
            }

            var blockUserDialog = $( "#block-user-dialog" ).dialog({
             autoOpen: false,
             modal: true,
             buttons: {
                 "Block User": function(){
                    var form_data = {
                        ajax:       '1',
                        user_id:    $('#selectedUserId').val() 
                    };
                    $.ajax({
                        url: "<?php echo base_url('user/block'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            location.reload();
                        }
                    });
                 },
                 Cancel: function() {
                     $( this ).dialog( "close" );
                     }
                 }
             });

            var unblockUserDialog = $( "#unblock-user-dialog" ).dialog({
             autoOpen: false,
             modal: true,
             buttons: {
                 "Activate User": function(){
                    
                    var form_data = {
                        ajax:       '1',
                        user_id:    $('#selectedUserId').val()   
                    };
                    $.ajax({
                        url: "<?php echo base_url('user/unblock'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            location.reload();
                        }
                    });
                 },
                 Cancel: function() {
                     $( this ).dialog( "close" );
                     }
                 }
             });

            /***
            * Load District dropdown when district admin is selected 
            */
            if($('select#slctuserrole').val() == 3){
                 $('#districtRow').css('display', 'table-row');
                 $('#schoolRow').css('display', 'none');
            }
            if($('select#slctuserrole').val() == 2){
                 $('#schoolRow').css('display', 'none');
                 $('#districtRow').css('display', 'none');
            }
            if($('select#slctuserrole').val() == 4){
                 $('#schoolRow').css('display', 'table-row');
                 $('#districtRow').css('display', 'none');
            }
            if($('select#slctuserrole').val() == 5){
                 $('#schoolRow').css('display', 'table-row');
                 $('#districtRow').css('display', 'table-row');
            }

            $('select#slctuserrole').on('change', function() {
                if(this.value == 3){ // District Admin selected
                    $('#districtRow').css('display', 'table-row');
                    $('#schoolRow').css('display', 'none');
                }
                else if(this.value==2){ // State Admin selected
                    $('#districtRow').css('display', 'none');
                    $('#schoolRow').css('display', 'none');
                }
                else if(this.value == 4){ //School admin selected
                    $('#schoolRow').css('display', 'table-row');
                }else if(this.value == 5){
                     $('#schoolRow').css('display', 'table-row');
                }
                

                
            });
    });
</script>