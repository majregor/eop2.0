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
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
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
<?php if($role['level']<5): ?>
<div style="margin:10px 5px 20px 0px;"><a href="<?php echo base_url(); ?>user/add">Create New User</a></div>
<?php endif; ?>
<div style="overflow: auto;">
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedUserId" value="" />
    <table id="userManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="99%" style="display: block; font-size:13px;">

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
                    <span style="text-transform: capitalize;"><?php echo $value['status']; ?></span>
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
                <td style="word-wrap: break-word; nowrap:wrap; max-width:80px">
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
                       param7="<?php echo($value['district_id']); ?>"
                       param8="<?php echo($value['school_id']); ?>"
                       param9="<?php echo($value['read_only']); ?>"
                       id="<?php echo($value['user_id']); ?>" href="<?php echo(base_url('user')); ?>">
                        Edit
                    </a>
                     &nbsp;|&nbsp;
                    <?php if($value['status'] == 'active' && $value['user_id'] != $this->session->userdata('user_id')): ?>
                        <a class="blockUserLink"
                           id="<?php echo($value['user_id']); ?>" href="/user"
                            >
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

<div id="update-user-dialog" title="Update User">
    <?php
        include("forms/update_user.php");
    ?>
</div>

<div id="block-user-dialog" title="Block User">
    <p style="margin-top:20px;">Are you sure you want to block this user?</p>
</div>
<div id="unblock-user-dialog" title="Block User">
    <p style="margin-top:20px;">Are you sure you want to activate this user?</p>
</div>

<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){


        var selectedDistrict = $('#sltdistrict').val();
        var toggleNone = false;
        var appendedRole = false;
        var appendedValue = null;

        var form_data = {
            ajax:           '1',
            district_id:    (selectedDistrict != 'Null') ? selectedDistrict : -1
        };
        $.ajax({
            url: "<?php echo base_url('school/get_schools_in_district'); ?>",
            type: 'POST',
            data: form_data,
            success: function (response) {
                var schools = JSON.parse(response);
                var schoolElement = $("#sltschool");
                schoolElement.empty(); // remove the old options
                schoolElement.append($("<option></option>")
                    .attr("value", "Null")
                    .text("--Select--"));

                $.each(schools, function (key, value) {
                    schoolElement.append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name));
                });
            }
        });



        $('#userManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });


        /**
         * Form Validation
         *
         */

        /** Remove School User if State Admin is logged in */
        <?php if($this->session->userdata['role']['level'] == 2): ?>
                $("#slctuserrole option[value='5']").remove();
        <?php endif; ?>

        $("#user_form").validate({
            rules: {
                phone:{
                    phoneUS2: true
                },
                <?php if($role['level'] < 4 ): ?>
                sltdistrict:{
                    required: true
                },
                sltschool:{
                    required:true
                },
                <?php endif; ?>
            slctuserrole:{
                required: true
            },
            user_password: "required",
            user_password_conf: {
                equalTo: "#user_password"
            },
            username:{
                required: true,
                minlength:3,
                remote:{
                    url: "<?php echo(base_url('user/checkusername')); ?>",
                    type: "POST",
                    data:{
                        username: function(){
                            var user = $("#username").val();
                            return user;
                        },
                        ajax: '1'
                    }

                }
            },
            email:{
                remote:{
                    url: "<?php echo(base_url('user/checkuseremail')); ?>",
                    type: "POST",
                    data:{
                        email: function(){
                            return $("#email").val();
                        },
                        ajax: '1'
                    }

                }
            }
        },
        messages:{
            username:{
                remote: "Username has already been used!"
            },
            email:{
                remote: "Email has already been used!"
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
                phoneUS2: true
            }
        },
        submitHandler: submit_update_user_form
    });


        $(document).on('submit', '#user_form', function(){

            if($('#districtRow').css("display") != "none"){

                var selectedDistrict = $('#sltdistrict').val();

                if(selectedDistrict == "Null" || selectedDistrict == "-1" || selectedDistrict == -1){
                    $('#sltdistrict').addClass("error");
                    $('#sltdistrict').focus();
                    return false;
                }
            }

        });


    /**
     * Reset Password functionality
     */
    $(document).on('click', '.resetUserPasswordLink', function(){

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
        },
        buttons: {
            "Reset Password": function(){
                $("#pwd_form").submit();
            },
            Cancel: function() {
                $("#pwd_form")[0].reset();
                $( this ).dialog( "close" );
            }
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

    //We use delegation here because of the jquery table pager
    $(document).on('click', '.modifyUserProfileLink', function(){
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

            get_schools_in_district(district, school);


            if(role==<?php echo($role['role_id']); ?>){
                    if($("#slctuserrole_update option[value='"+role+"']").length >0){ // Check if the value exists

                    }else{ // If it doesn't exist, add one

                        $('#slctuserrole_update').append($("<option></option>").attr("value", role).text("<?php echo($role['role']); ?>"));
                        appendedRole = true;
                        appendedValue = role;
                    }

                //Lock admins from editing fellow admin's roles by uncommenting here
                    //$('#slctuserrole_update').attr("disabled", true);

                }else{
                    $('#slctuserrole_update').attr("disabled", false);
                    if(appendedRole){
                        $("#slctuserrole_update option[value='"+appendedValue+"']").remove();
                        appendedRole = false;
                        appendedValue=null;
                    }
                }

                $('#slctuserrole_update').val(role);

                if(role >= 2){

                    <?php if($role['level']==3 || $role['level']<=2): ?> // If logged in as a district or state admin, show the school to enable school changes
                        if(role >3){
                            $('#SchoolInputHolder').show();
                            $('#sltschool_update').val(school);
                        }else{
                            $('#SchoolInputHolder').hide();
                        }
                    <?php endif; ?>
                    <?php if($role['level']>3): ?>
                        $('#SchoolInputHolder').hide();
                    <?php endif; ?>
                }
                else{
                    $('#SchoolInputHolder').show();
                }


                <?php if($role['level']<2): ?>
                $('#sltdistrict_update').val(district);
                $('#sltschool_update').val(school);

                <?php endif; ?>

                if(role <3 ){
                    $("#sltdistrict_update option[value='']").remove();
                    $('#districtInputHolder').hide();
                    $('#sltdistrict_update').attr("required", false);
                }
                else{

                    $("#sltdistrict_update option[value='']").remove();
                    if(role !=3){
                        $("<option></option>")
                            .val('')
                            .html("None")
                            .insertAfter($('#sltdistrict_update').children().first());
                    }

                    $('#districtInputHolder').show();
                    $('#sltdistrict_update').val(district);
                }
                $('#user_access_permission_update').val(access);
                $('#user_id_update').val(id);

                if(role !=5){
                    $('#viewonlyInputHolder').hide();
                }else{
                    $('#viewonlyInputHolder').show();
                }
                    if(role <=2 ){
                        $('#districtInputHolder').hide();
                    }

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
                },
                buttons: {
                    "Update": function(){

                        if($('#districtInputHolder').css('display') != 'none'){
                            var selectedDistrict = $('#sltdistrict_update').val();

                            if(selectedDistrict == "Null" || selectedDistrict == "-1" || selectedDistrict == -1){
                                $('#sltdistrict_update').addClass("error");
                                $('#sltdistrict_update').focus();
                                return false;
                            }else{
                                $("#update_user_form").submit();
                            }
                        }else{
                            $("#update_user_form").submit();
                        }
                    },
                    Cancel: function() {
                        $("#update_user_form")[0].reset();
                        $( this ).dialog( "close" );
                    }
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
                    role_id                 : ($('#role_id_update').val()== "<?php echo($role['role_id']); ?>") ? $('#role_id_update').val() :  $('#slctuserrole_update').val(),
                    <?php if($role['level']<3): ?>
                        school_id               : $('#sltschool_update').val(),
                        district_id             : $('#sltdistrict_update').val(),
                    <?php endif; ?>
                    <?php if($role['level']==3): ?>
                        school_id               : $('#sltschool_update').val(),
                    <?php endif; ?>
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

        // Change School list according to district selected
        $(document).on('change','#sltdistrict', function(){

          //  alert(this.value);
            var form_data = {
                ajax:           '1',
                district_id:    (this.value != 'Null') ? this.value : -1
            };


            $.ajax({
                url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                type: 'POST',
                data: form_data,
                success: function (response) {
                    var schools = JSON.parse(response);
                    var schoolElement = $("#sltschool");
                    schoolElement.empty(); // remove the old options

                    schoolElement.append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $.each(schools, function (key, value) {
                        schoolElement.append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.name));
                    });
                }
            });

        });

        function getDistrictSchools(){

            var form_data = {
                ajax:           '1'
                <?php echo((isset($adminDistrict) && !empty($adminDistrict))? ", district_id:".$adminDistrict."" : "");?>
            };


            $.ajax({
                url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                type: 'POST',
                data: form_data,
                success: function (response) {
                    var schools = JSON.parse(response);
                    var schoolElement = $("#sltschool");
                    schoolElement.empty(); // remove the old options

                    schoolElement.append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $.each(schools, function (key, value) {
                        schoolElement.append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.name));
                    });
                }
            });
        }

            /**
            * Block User functionality
            */
            $(document).on('click', '.blockUserLink', function(){

                var id = $(this).attr('id');
                $('#selectedUserId').val(id);
                blockUserDialog.dialog('open');
                return false;
            });
            /**
             * Unblock User functionality
             * */
             $(document).on('click', '.unblockUserLink', function(){

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
                 "Yes": function(){
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
                 "Ok": function(){
                    
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
                $('#viewonlyRow').css('display', 'none');
                $('#districtRow').css('display', 'table-row');
                $('#schoolRow').css('display', 'none');
                $('#sltschool').val(null);
                $('#sltdistrict option[value=""]').each(function(){
                    $(this).remove();
                });
                toggleNone = true;
                $('#sltdistrict').rules("add", "required");
                $('#districtRow span').addClass("required");
            }
            if($('select#slctuserrole').val() == 2){
                $('#viewonlyRow').css('display', 'none');
                $('#schoolRow').css('display', 'none');
                $('#districtRow').css('display', 'none');
                $('#sltschool').val('Null');
                $('#sltdistrict').val('Null');
            }
            if($('select#slctuserrole').val() == 4){
                $('#viewonlyRow').css('display', 'none');
                $('#schoolRow').css('display', 'table-row');
                $('#districtRow').css('display', 'table-row');
                $('#sltdistrict').attr("required", false);
                $('#sltdistrict').rules("remove", "required");
                $('#districtRow span').addClass("required");
            }
            if($('select#slctuserrole').val() == 5){ // if School user
                $('#viewonlyRow').css('display', 'table-row');
                $('#schoolRow').css('display', 'table-row');


                <?php if($role['level']>=3): ?>// if logged in as District or School admin, remove the district
                    $('#sltdistrict').val(null);
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                <?php else: ?>//Else show the district as optional for State and Super admins
                    $('#districtRow').css('display', 'table-row');
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                <?php endif; ?>
            }

            $('select#slctuserrole').on('change', function() {
                $('#viewonlyRow').css('display', 'none');

                if(this.value == 3){ // District Admin selected

                    $('#schoolRow').css('display', 'none');
                    $('#sltschool').val('Null');
                    <?php if($role['level']!=3): ?>
                        $('#sltdistrict option[value=""]').each(function(){
                            $(this).remove();
                        });
                        toggleNone = true;


                        $('#districtRow').css('display', 'table-row');
                        $('#sltdistrict').rules("add", "required");
                        $('#districtRow span').addClass("required");
                    <?php endif; ?>
                }
                else if(this.value==2){ // State Admin selected
                    $('#districtRow').css('display', 'none');
                    $('#schoolRow').css('display', 'none');
                    $('#sltdistrict').val('Null');
                    $('#sltschool').val('Null');
                }
                else if(this.value == 4){ //School admin selected
                    $('#schoolRow').css('display', 'table-row');
                    $('#sltschool').val('Null');
                    <?php if($role['level']!=3): ?>
                        $('#districtRow').css('display', 'table-row');
                        $('#sltdistrict').attr("required", false);
                        $('#sltdistrict').rules("remove", "required");
                        if(toggleNone == true){
                            /*$('#sltdistrict').prepend($("<option></option>")
                                .attr("value","")
                                .text("None"));*/
                            $("<option></option>")
                                .val('')
                                .html("None")
                                .insertAfter($('#sltdistrict').children().first());
                            toggleNone = false;
                        }
                        $('#sltdistrict').val('Null');
                        $('#districtRow span').addClass("required");
                    <?php else: ?>
                        getDistrictSchools();
                    <?php endif; ?>
                }else if(this.value == 5){ //School User selected
                    $('#viewonlyRow').css('display', 'table-row');
                    $('#schoolRow').css('display', 'table-row');

                    //if user is being added by district or school admin, remove the district
                    <?php if($role['level']>=3): ?>
                    $('#districtRow').css('display', 'none');
                    $('#sltdistrict').val(null);
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                    getDistrictSchools();
                    if(toggleNone == true){
                        /*$('#sltdistrict').prepend($("<option></option>")
                            .attr("value", "")
                            .text("None"));*/
                        $("<option></option>")
                            .val('')
                            .html("None")
                            .insertAfter($('#sltdistrict').children().first());
                        toggleNone = false;
                    }
                    $('#sltdistrict').val('Null');
                    <?php else: ?> // Else show the district for State and Super admins
                    $('#districtRow').css('display', 'table-row');
                    $('#sltdistrict').attr("required", true);
                    <?php endif; ?>
                }
                

                
            });


        function get_schools_in_district(district_id, school){
            //alert(district_id);
            var form_data = {
                ajax:           '1',
                district_id:    (district_id != 'Null') ? district_id : -1
            };


            $.ajax({
                url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                type: 'POST',
                data: form_data,
                success: function (response) {
                    var schools = JSON.parse(response);
                    var schoolElement = $("#sltschool_update");
                    schoolElement.empty(); // remove the old options

                    schoolElement.append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $.each(schools, function (key, value) {
                        if(school == value.id){
                            schoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .attr("selected", "selected")
                                .text(value.name));
                        }else{
                            schoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));
                        }

                    });
                }
            });
        }

    });
</script>