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

//print_r($schools);
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

<div style="margin:10px 5px 20px 0px;"><a href="<?php echo base_url(); ?>school/add">Add New School</a></div>

<div>
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedSchoolId" value="" />
    <table id="schoolManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="100%" style="display: block; font-size:13px;">

        <thead>
            <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>&nbsp;&nbsp;&nbsp;&nbsp;District&nbsp;&nbsp;&nbsp;&nbsp;</th>");
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
                         <?php echo $value['district'] ?>
                    </td>
                <?php endif; ?>

                <?php 
                    if($role['level']==2){
                        $viewEOP = false;
                        if($stateEOPAccess=='write' || $stateEOPAccess=='read'){
                            $dpermission = NULL;
                            foreach($districts as $dkey=>$dvalue){
                                if($value['district_id'] == $dvalue['id']){
                                    $dpermission = $dvalue['state_permission'];
                                    break;
                                }
                            }

                            if(null!=$dpermission && $dpermission=='write'){
                                $viewEOP = true;
                            }
                            elseif(null==$dpermission && $value['state_permission']=='write'){
                                $viewEOP = true;
                            }
                        }

                        if($viewEOP){
                             echo "<td>View</td>";
                        }
                        else{
                            echo "<td style='color:#BABABA;'><em>Not shared</em></td>";
                        }
                    }else{
                        echo "<td>View</td>";
                    }
                ?>



                <td>
                    <a class="modifySchoolProfileLink"
                       param1="<?php echo($value['name']); ?>"
                       param2="<?php echo($value['screen_name']); ?>"
                       id="<?php echo($value['id']); ?>" href="/school">
                        Edit
                    </a>
                </td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>");
                    }
                ?>
                <th>EOP</th>
                <th>Modify School</th>
            </tr>
        </tfoot>

    </table>
</div>



<div id="update-school-dialog" title="Update School Profile">
    <?php
        include("forms/update_school.php");
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

        $("#school_form").validate({
        });

        $("#update_school_form").validate({

            submitHandler: submit_update_school_form
        });



        /**
         *
         * Update School Profile functionality
         */
            $(".modifySchoolProfileLink").click(function(){
                var id = $(this).attr('id');
                var name = $(this).attr('param1');
                var screen_name = $(this).attr('param2');


                $('#school_name_update').val(name);
                $('#screen_name_update').val(screen_name);
                $('#school_id_update').val(id);

                //Open the update user dialog form
                $("#update-school-dialog").dialog('open');
                return false;
            });

            $("#update-school-dialog").dialog({
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

            function submit_update_school_form(){

                var form_data = {
                    school_id               : $('#school_id_update').val(),
                    school_name             : $('#school_name_update').val(),
                    screen_name             : $('#screen_name_update').val(),
                    ajax                    : '1'
                };
                $.ajax({
                    url: "<?php echo base_url('school/update'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(response) {
                        location.reload();
                    }
                });

                $('#update-school-dialog').dialog("close");
                return false;
            }

    });
</script>