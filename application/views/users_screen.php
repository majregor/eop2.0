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

<div class="adminMenu">
    <ul>
        <li>
            <a href="#">User Management </a> &nbsp;&nbsp; | &nbsp;&nbsp;
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
</div>
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
    });
</script>