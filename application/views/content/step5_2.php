<?php
$entities = $page_vars['entities'];
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 5-2</h1>
        <h1>Prepare the Draft EOP: Threat- and Hazard-Specific Annexes</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_2"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>

<div class="col-half left">
    <p>Your  planning team already completed most of the work for the <a href="#" class="bt" title="The Threat- and Hazard-Specific Annexes section specifies the goals, objectives, and courses of action that a school will follow to address a particular type of threat or hazard (e.g., hurricane, active shooter). Threat- and Hazard-Specific annexes, like functional annexes, set forth how the school manages a function before, during, and after an emergency.">Threat-and Hazard-Specific Annexes</a> in  Step 3 and Step 4, when your team identified <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>,<a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals."> objectives</a>, and <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> for threats and hazards. At this stage, your team will be prompted to edit the  text already developed for each threat or hazard and then format accordingly for inclusion in the draft EOP.</p>
    <p>A  recommended format for presenting information in each of the annexes is as  follows:</p>
    <ul>
        <ul>
            <li>Title (the threat or hazard)</li>
            <li>Goal(s)</li>
            <li>Objective(s)</li>
            <li>Courses of Action (Describe the courses of  action you developed in Step 4 in the sequence in which they should occur.)</li>
        </ul>
    </ul>
    <p><br/>
        To edit and format the content for each of your annexes, please click on the corresponding Edit button. Revise the text as necessary in the designated fields. It is likely that some of your courses of action will reference cross-cutting functions. In those cases, it is recommended that you add a note that additional information on a particular function may be found in the corresponding Functional Annex. Click the Update button to create a coherent Threat- and Hazard-Specific Annex.</p>
</div>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1>Edit Threat- and Hazard-Specific Annexes</h1>

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
                <th scope="col">Annexes</th>
            </tr>

            <?php

                $eligibleEntities = array();

                foreach($entities as $key=>$value){
                    foreach($value['children'] as $child){
                        if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                            foreach($child['children'] as $grandChild){
                                if($grandChild['type']=='ca') {
                                    foreach ($grandChild['fields'] as $field) {
                                        if (isset($field['body']) && !empty($field['body'])) {
                                            array_push($eligibleEntities, $value);
                                            break 3;
                                        }
                                    }
                                }
                            }
                        }

                    }

                }

            ?>


            <?php foreach($eligibleEntities as $key=>$value): ?>
                <tr>
                    <td><?php echo $value['name']; ?></td>
                    <td align="center">
                    <?php if($this->session->userdata['role']['read_only']=='n') { ?>
                        <a href="#" id="<?php echo($value['id']); ?>" class="editFieldsLink">Edit</a>
                    <?php
                    }else{ ?>
                        <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink">View</a>
                    <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="fieldsContainer" id="container-<?php echo $value['id'];?>"></div>
                    </td>
                </tr>
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

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/1')); ?>"); //Previous


        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit',
                showActions: '1'

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
                action: 'view',
                showActions: '1'

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



        $(document).on('click','#saveBtn', function(){

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
                    return [$(value).val()];
                });

            //New Data
                var g<?php echo($i);?>fnDataNew = $.map($("select.g<?php echo($i);?>fnNew option:selected"), function(value, index) {
                    return [$(value).text().trim()];
                });
                var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');


            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var g1CAFieldId     = g1Element.attr("data-field-id");
            var g1CAData        = g1Element.val();

            var g2CAFieldId     = g2Element.attr("data-field-id");
            var g2CAData        = g2Element.val();

            var g3CAFieldId     = g3Element.attr("data-field-id");
            var g3CAData        = g3Element.val();


            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'save',
                coursesOfActions: '1',
                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,
                g1ObjIds:   g1ObjIds,
                g2ObjIds:   g2ObjIds,
                g3ObjIds:   g3ObjIds,
                g1ObjFieldIds: g1ObjFieldIds,
                g2ObjFieldIds: g2ObjFieldIds,
                g3ObjFieldIds: g3ObjFieldIds,
                g1Id:       g1TxtCtl.attr('data-id'),
                g2Id:       g2TxtCtl.attr('data-id'),
                g3Id:       g3TxtCtl.attr('data-id'),
                g1FieldId:  g1TxtCtl.attr('data-field-id'),
                g2FieldId:  g2TxtCtl.attr('data-field-id'),
                g3FieldId:  g3TxtCtl.attr('data-field-id'),
                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val(),
                fn1:        $('#slctg1fn').val(),
                fn2:        $('#slctg2fn').val(),
                fn3:        $('#slctg3fn').val(),
                fn1Txt:     $('select#slctg1fn option:selected').text().trim(),
                fn2Txt:     $('select#slctg2fn option:selected').text().trim(),
                fn3Txt:     $('select#slctg3fn option:selected').text().trim(),
                fn1Val:     $('select#slctg1fn option:selected').val(),
                fn2Val:     $('select#slctg2fn option:selected').val(),
                fn3Val:     $('select#slctg3fn option:selected').val(),
                g1fnData:   g1fnData,
                g2fnData:   g2fnData,
                g3fnData:   g3fnData,
                g1fnVal:       g1fnVal,
                g2fnVal:       g2fnVal,
                g3fnVal:       g3fnVal,
                g1ObjDataNew:  g1ObjDataNew,
                g2ObjDataNew:  g2ObjDataNew,
                g3ObjDataNew:  g3ObjDataNew,
                g1fnDataNew :   g1fnDataNew,
                g2fnDataNew :   g2fnDataNew,
                g3fnDataNew :   g3fnDataNew,

                g1CAFieldId:    g1CAFieldId,
                g1CAData:       g1CAData,

                g2CAFieldId:    g2CAFieldId,
                g2CAData:       g2CAData,

                g3CAFieldId:    g3CAFieldId,
                g3CAData:       g3CAData

            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageTHGoals')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        //alert(response);
                        location.reload();

                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            $("#container-"+selectedId).html('');
            return false;
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
