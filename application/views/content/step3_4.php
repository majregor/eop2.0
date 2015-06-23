<?php
$entities = $page_vars['entities'];
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 3-4</h1>
        <h1>Develop Goals and Objectives for Functions</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_4"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>
<div class="col-half left">
    <p>After  identifying functions, the planning team should develop three&nbsp;goals&nbsp;and corresponding&nbsp;objectives&nbsp;for each function. As  with the goals already identified for threats and hazards, the three goals  should indicate the desired outcome for (1) before, (2) during, and (3) after  the function has been executed. The goals and objectives developed for these  functions will be carried forward to the next step in the planning process&mdash;Step  4&mdash;which will prompt your planning team to develop courses of action for  accomplishing the goals and objectives established here. Ultimately, the goals,  objectives, and courses of action developed for each function will form the  Functional Annexes section of your school EOP. &nbsp;</p>
    <p>Please use the table below to develop <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for each <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">function</a>. If a function is not displayed below, then it has not been identified as a cross-cutting function on the previous page.</p>
    <p>Begin by clicking the Add button for the respective function, which will display empty fields. Then, type your goals and objectives into the designated fields. Use the Add Objective button, if your team needs to develop multiple objectives in support of a single goal. After completing all fields for the selected function, click the Save button. Repeat this process for the remaining functions.</p>
    <p>If your team wishes to edit goals and objectives that were previously entered, please click the Edit button for the respective function. Pre-populated fields will appear with previously saved information. After editing any of the available fields, click the Update button. Repeat this process, as needed.</p>
</div>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1>Add/Edit Goals and Objectives for Functions</h1>
    <div id="goalFirstDivToRefresh">
        <table class="results">
            <tr>
                <th scope="col">Functions</th>
                <th scope="col">Goals and Objectives</th>
            </tr>
            <?php foreach($entities as $key=>$value): ?>
                <tr>
                    <td><?php echo $value['name']; ?></td>
                    <td align="center">
                        <?php if(isset($value['children']) && count($value['children'])>0): ?>
                            <a href="#" id="<?php echo $value['id'];?>" class="editFieldsLink">Edit</a>
                        <?php else: ?>
                            <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink">Add</a>
                        <?php endif; ?>
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


<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step4/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/3')); ?>"); //Previous

        $("#rightArrowButton").click(function(){


        });

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
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
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
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
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

            //New Data
                var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#g1txt');
            var g2TxtCtl = $('#g2txt');
            var g3TxtCtl = $('#g3txt');


            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'save',
                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,
                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val()
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        alert(response);

                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            $("#container-"+selectedId).html('');
            return false;
        });

        $(document).on('click','#updateBtn', function(){

            <?php for($i=1; $i<=3; $i++): ?>


            var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).val()];
            });
            var g<?php echo($i);?>ObjDataIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-id')];
            });
            var g<?php echo($i);?>ObjFieldIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-field-id')];
            });

            //New Data
            var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                return [$(value).val()];
            });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');

            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'update',
                g1ObjDataNew:  g1ObjDataNew,
                g2ObjDataNew:  g2ObjDataNew,
                g3ObjDataNew:  g3ObjDataNew,

                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val(),

                g1Id:       g1TxtCtl.attr('data-id'),
                g2Id:       g2TxtCtl.attr('data-id'),
                g3Id:       g3TxtCtl.attr('data-id'),

                g1FieldId:  g1TxtCtl.attr('data-field-id'),
                g2FieldId:  g2TxtCtl.attr('data-field-id'),
                g3FieldId:  g3TxtCtl.attr('data-field-id'),

                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,

                g1ObjIds:   g1ObjDataIds,
                g2ObjIds:   g2ObjDataIds,
                g3ObjIds:   g3ObjDataIds,

                g1ObjFieldIds: g1ObjFieldIds,
                g2ObjFieldIds: g2ObjFieldIds,
                g3ObjFieldIds: g3ObjFieldIds

            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        alert(response);

                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            $("#container-"+selectedId).html('');
            return false;
        });

    }); // End $(document).ready function

</script>
