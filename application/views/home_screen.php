<?php

    if($this->session->userdata('selected_school')){ ?>

<?php
    }
    elseif($this->session->userdata['role']['level']==3){ //check if its a district administrator
?>
        <script type="text/javascript">
            $(document).ready(function(){
                //Load list of eligible schools that fall under the user's district

                $.ajax({
                    url: "<?php echo base_url('school/get_schools_in_my_district'); ?>",
                    type: 'POST',
                    data: {ajax: '1', user_id:<?php echo ($this->session->userdata('user_id')); ?>},
                    success: function(response){
                        var schools = JSON.parse(response);
                        var dialogSchoolElement = $("#sltschool");
                        var pageSchoolElement = $("#slctsubdistrictselection");
                        dialogSchoolElement.empty(); // remove the old options
                        pageSchoolElement.empty();

                        $.each(schools, function(key, value){
                            dialogSchoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));

                            pageSchoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));
                        });

                    }
                });


                //Prompt the user to select a school from the list
                var blockUserDialog = $("#select_school_dialog").dialog({
                    autoOpen: true,
                    modal: true,
                    buttons: {
                        "OK": function(){
                            var form_data = {
                                ajax:       '1',
                                user_id:    <?php echo($this->session->userdata('user_id')); ?>
                            };
                            $.ajax({
                                url: "<?php echo base_url('school/load'); ?>",
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
            });
        </script>
        <div class="col-half" style="text-align:center; margin-top:15%;">
            <h1 style="color:red">No school is selected. Please select a school.</h1>
        </div>

        <div id="select_school_dialog" title="Select School">
            <p style="margin-top:20px;">
                <label>Schools:</label><br/>
                <select id="sltschool" name="sltschool"></select>
            </p>
        </div>
<?php
    }
?>
