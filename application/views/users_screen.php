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
            <tr>
                <td>sdssdfgsds</td>
                <td>sdsdsfgsdfgds</td>
                <td>sds33232d</td>
                <td>2323232</td>
                <td>sdfdfgssd</td>
                <td>sdfsdfgdssfd</td>
                <td>sdfsdfgssf</td>
                <td>sdfsdfgs sdfg sfs</td>
            </tr>

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

<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $('#userManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });



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

    });
</script>