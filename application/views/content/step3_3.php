<?php
$entities = $page_vars['entities'];
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 3-3</h1>
        <h1>Develop Goals and Objectives for Threats and Hazards</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_3"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>
<div class="col-half left">
    <p>Next,  your team should develop&nbsp;three goals&nbsp;and&nbsp;corresponding objectives&nbsp;for  each of your selected threats and hazards. The three goals should  indicate&nbsp;the desired outcome&nbsp;(1)&nbsp;before, (2) during, and (3)  after&nbsp;a threat or hazard has unfolded at your school. For each of your  goals, please provide corresponding objectives&mdash;or specific, measurable  actions&mdash;to achieve these goals. Often, planners will need to  identify&nbsp;multiple objectives in support of a single goal.&nbsp;The goals  and objectives developed in this step will be carried forward to the next step  in the planning process&mdash;Step 4&mdash;which will prompt your planning team to develop <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> for  accomplishing the goals and objectives established here. Ultimately, the goals,  objectives, and courses of action developed for each threat or hazard will  form the Threat- or Hazard-Specific Annexes section of your school EOP. &nbsp;</p>
    <p>As  your team develops goals and objectives for threats or hazards, you should  find that some of your goals and objectives apply to more than one threat or  hazard. For example, a goal addressing the threat or hazard of a fire might be  to provide necessary medical attention to those in need. Providing medical  attention is a goal that could also apply to tornadoes, explosions,  contaminated food outbreaks, or <em>active  shooter situations</em>. These  cross-cutting goals and objectives are known as functions. Examples of functions  include the following: evacuation; lockdown; shelter-in-place; accounting for  all persons; communications and warning; family reunification; continuity of  operations; recovery; public health, medical, and mental health; and security. While  developing goals and objectives, your team will be prompted to identify which  of those goals and objectives are considered functions. The functions that your  team identifies here will eventually become Functional Annexes in your school  EOP.</p>

    <p>Please use the table below to develop <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for each selected threat and hazard, and to identify which of those goals and objectives are cross-cutting <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. If a threat or hazard is not displayed below, please return to the previous page to ensure that it is selected for inclusion in the school EOP.</p>
    <p>Begin by clicking the Add button for the respective threat or hazard. Then, type your goals and objectives into the designated fields. Use the Add Objective button if your team needs to develop multiple objectives in support of a single goal. Then, for each goal and objective, use the Function drop-down menu to select the corresponding function. Recommended functions are preloaded as menu options; however, your team may add new functions to the menu as well. The menu option &ldquo;None&rdquo; signifies that the goal or objective only applies to the threat or hazard, and is not a cross-cutting function. After completing all fields and selecting the appropriate menu options for the selected threat or hazard, click the Save button. Repeat this process for the remaining threats and hazards.</p>
    <p> If your team wishes to edit goals, objectives, and functions that were previously entered, please click the Edit button for the respective threat or hazard. Pre-populated fields and drop-down menus will appear with previously saved information. After editing any of the available fields, click the Update button. Repeat this process, as needed.</p>
</div><!-- /col-half --><!-- /col-half -->

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1>Add/Edit Goals and Objectives for Threats and Hazards</h1>

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

    <div id="goalFirstDivToRefresh">
        <table class="results">
            <tr>
                <th scope="col">Threats and Hazards</th>
                <th scope="col">Goals and Objectives</th>
            </tr>
            <?php foreach($entities as $key=>$value): ?>

                <?php if(isset($value['fields']) && count($value['fields'])>0): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td align="center">
                        <?php if($value['description'] == 'live' && !empty($value['description'])): ?>
                            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                <a href="#" id="<?php echo $value['id'];?>" class="editFieldsLink">Edit</a>
                            <?php else: ?>
                                <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink">View</a>
                            <?php endif; ?>
                        <?php else: ?>
                                <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink">View</a>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="fieldsContainer" id="container-<?php echo $value['id'];?>"></div>
                        </td>
                    </tr>
                <?php else: ?>
                                <?php if($value['description'] == 'live' && !empty($value['description'])): ?>
                                    <tr>
                                        <td><?php echo $value['name']; ?></td>
                                        <td align="center">
                                            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink">Add</a>
                                                <?php else: ?>
                                                    No data to view
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="fieldsContainer" id="container-<?php echo $value['id'];?>"></div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>
        </table>
    </div>
</div>

<div id="new-fn-dialog" title="New Function">
    <?php $this->load->view('forms/function'); ?>
</div>



<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/2')); ?>"); //Previous

        $(".addFieldsLink").click(function(){

             selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });

        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });

            $(divContainer).html('');
            return false;
        });

        $(".viewFieldsLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'view'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });


        $(document).on('click','#saveBtn', function(){

            var validateError = false;

            <?php for($i=1; $i<=3; $i++): ?>
                var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).val()];
                });
                var g<?php echo($i);?>ObjIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).attr('data-id')];
                });
                var g<?php echo($i);?>ObjFieldIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).attr('data-field-id')];
                });
                var g<?php echo($i);?>fnData = $.map($("select.g<?php echo($i);?>fn option:selected"), function(value, index) {
                    return [$(value).text().trim()];
                });
                var g<?php echo($i);?>fnVal = $.map($("select.g<?php echo($i);?>fn option:selected"), function(value, index) {
                    if($(value).val()) {
                        return [$(value).val()];
                    }else{
                        $(value).parent().addClass("error");
                        $(value).parent().focus();
                        validateError = true;
                        alert('Function field is required!');
                        return;
                    }
                });

            //New Data
                var g<?php echo($i);?>fnDataNew = $.map($("select.g<?php echo($i);?>fnNew option:selected"), function(value, index) {
                    if($(value).val()) {
                        return [$(value).text().trim()];
                    }else{
                        $(value).parent().addClass("error");
                        $(value).parent().focus();
                        validateError = true;
                        alert('Function field is required!');
                        return;
                    }
                });
                var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>

           if( $('#slctg1fn').val()) {
               //Do nothing
           }
            else{

               alert('Function field is required!');
               $('#slctg1fn').addClass("error");
               $('#slctg1fn').focus();
               validateError = true;
               return false;
           }

            if( $('#slctg2fn').val()){
                //Do nothing
             }
            else{

                alert('Function field is required!');
                $('#slctg2fn').addClass("error");
                $('#slctg2fn').focus();
                validateError = true;

                return false;
            }

            if($('#slctg3fn').val()){
                //Do nothing
            } else{

                alert('Function field is required!');
                $('#slctg3fn').addClass("error");
                $('#slctg3fn').focus();
                validateError = true;

                return false;
            }


            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');

            if(validateError){
                return false
            }else {
                var formData = {
                    ajax: '1',
                    id: selectedId,
                    mode: mode,
                    action: 'save',
                    g1ObjData: g1ObjData,
                    g2ObjData: g2ObjData,
                    g3ObjData: g3ObjData,
                    g1ObjIds: g1ObjIds,
                    g2ObjIds: g2ObjIds,
                    g3ObjIds: g3ObjIds,
                    g1ObjFieldIds: g1ObjFieldIds,
                    g2ObjFieldIds: g2ObjFieldIds,
                    g3ObjFieldIds: g3ObjFieldIds,
                    g1Id: g1TxtCtl.attr('data-id'),
                    g2Id: g2TxtCtl.attr('data-id'),
                    g3Id: g3TxtCtl.attr('data-id'),
                    g1FieldId: g1TxtCtl.attr('data-field-id'),
                    g2FieldId: g2TxtCtl.attr('data-field-id'),
                    g3FieldId: g3TxtCtl.attr('data-field-id'),
                    g1: g1TxtCtl.val(),
                    g2: g2TxtCtl.val(),
                    g3: g3TxtCtl.val(),
                    fn1: $('#slctg1fn').val(),
                    fn2: $('#slctg2fn').val(),
                    fn3: $('#slctg3fn').val(),
                    fn1Txt: $('select#slctg1fn option:selected').text().trim(),
                    fn2Txt: $('select#slctg2fn option:selected').text().trim(),
                    fn3Txt: $('select#slctg3fn option:selected').text().trim(),
                    fn1Val: $('select#slctg1fn option:selected').val(),
                    fn2Val: $('select#slctg2fn option:selected').val(),
                    fn3Val: $('select#slctg3fn option:selected').val(),
                    g1fnData: g1fnData,
                    g2fnData: g2fnData,
                    g3fnData: g3fnData,
                    g1fnVal: g1fnVal,
                    g2fnVal: g2fnVal,
                    g3fnVal: g3fnVal,
                    g1ObjDataNew: g1ObjDataNew,
                    g2ObjDataNew: g2ObjDataNew,
                    g3ObjDataNew: g3ObjDataNew,
                    g1fnDataNew: g1fnDataNew,
                    g2fnDataNew: g2fnDataNew,
                    g3fnDataNew: g3fnDataNew

                };

                $.ajax({
                    url: '<?php echo(base_url('plan/manageTHGoals')); ?>',
                    data: formData,
                    type: 'POST',
                    success: function (response) {

                        try {
                            //alert(response);
                            location.reload();

                        } catch (err) {
                            alert('Problem saving data: ' + err);
                        }
                    }

                });

                $("#container-" + selectedId).html('');
                return false;
            }
        });

        $(document).on('click','#cancelBtn', function(){
            selectedId = $('#entity_identifier').val();
            $("#container-"+selectedId).html('');
            return false;
        });

        $(document).on('change','select', function(){
            if($(this).val().trim()=="other"){
                $("#new-fn-dialog").dialog('open');
                return false;
            }

        });

        $("#new-fn-dialog").dialog({
            resizable:      false,
            minHeight:      150,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 200
            },
            buttons: {
                "Save": function(){
                    $("#newFnForm").submit();
                },
                Cancel: function() {
                    $("#newFnForm")[0].reset();
                    $( this ).dialog( "close" );
                }
            }
        });

        $("#newFnForm").validate({
            submitHandler: submit_fn_form
        });

        function submit_fn_form(){
            var form_data={
                ajax: '1',
                txtfn: $('#txtfn').val()
            };
            $.ajax({
                url: "<?php echo base_url('plan/addFn'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {
                    try{

                        var functions = JSON.parse(response);

                        var functionElements = $("select");
                        $.each(functionElements, function(key, value){
                            var myList =[];

                            for(var i=0; i<value.options.length; i++){
                                if(value.options[i].value) myList.push(value.options[i].value);
                            }

                            $.each(functions, function (k, v) {
                                if($.inArray(v.id, myList) == -1){
                                    $(value).append($("<option></option>")
                                        .attr("value", v.id)
                                        .text(v.name));
                                }

                            });



                        });




                    }catch(err){
                        alert('Error adding function '+err);
                    }
                }
            });

            $("#new-fn-dialog").dialog("close");
            return false;
        }


    }); // End $(document).ready function

</script>
