<?php
$entities = $page_vars['entities'];
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 5-3</h1>
        <h1>Prepare the Draft EOP: Functional Annexes</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_3"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>


<div class="col-half left">
    <p>Your  planning team already completed most of the work for the <a href="#" class="bt" title="The Functional Annexes section details the goals, objectives, and courses of action of functions (e.g., evacuation, lockdown, recovery) that apply across multiple threats or hazards. Functional annexes set forth how the school manages a function before, during, and after an emergency.">Functional Annexes</a> in  Step 3 and Step 4, when your team identified <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard."> goals</a>,<a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals."> objectives</a>,  and <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> for <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. At this stage, your team will be prompted to edit the  text already developed for each function and and then format  accordingly for inclusion in the draft EOP.</p>
    <p>A  recommended format for presenting information in each of the annexes is as  follows:</p>
    <ul>
        <ul>
            <li>Title (the function)</li>
            <li>Goal(s)</li>
            <li>Objective(s)</li>
            <li>Courses of Action (Describe the courses of  action you developed in Step 4 in the sequence in which they should occur.)</li>
        </ul>
    </ul>
    <p><br/>
        To edit and format the content for each of your annexes, please click on the corresponding Edit button. Revise the text as necessary in the designated fields and click the Update button to create a coherent Functional Annex.</p>
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

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/2')); ?>"); //Previous

        $("#rightArrowButton").click(function(){


        });

        $(".addFieldsLink").click(function(){

             selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add',
                showActions: '1'
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
                action: 'edit',
                showActions: '1'

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


        //@todo Make courses of action saveable at this step
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
