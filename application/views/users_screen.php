<?php
/**
 *  User Management View
 *
 * This is the main user management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */

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

<div class="adminMenu">
    <ul>
        <li>
            <a href="<?php echo base_url(); ?>user">User Management </a> &nbsp;&nbsp; | &nbsp;&nbsp;
            <ul>
                <li><a href="<?php echo base_url(); ?>user">View All</a></li>
                <li><a href="<?php echo base_url(); ?>user/add">Create New User</a></li>

            </ul>
        </li>
        <li>
            <a href="#">School Management</a> &nbsp;&nbsp; | &nbsp;&nbsp;
        </li>
        <li>
            <a href="#">District Management</a> &nbsp;&nbsp; | &nbsp;&nbsp;
        </li>
        <li>
            <a href="#">State Access</a>
        </li>
    </ul>
    <br style="clear: both;"/>
</div>

<?php if(isset($viewform)){
    include('forms/user.php');
}
?>

<div>
    <table id="userManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="100%" style="display: block;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>User ID</th>
                <th>Status</th>
                <th>User Role</th>
                <th>School</th>
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
                user_password_reset: "required",
                user_password_conf_reset: {
                    equalTo: "#user_password_reset"
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
    });
</script>