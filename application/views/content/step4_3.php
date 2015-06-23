<?php
$entities = $page_vars['entities'];

?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 4-3</h1>
        <h1>Develop Courses of Action for Threats and Hazards</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_3"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>

<div class="col-half left">
    <p><a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">Courses of action</a> should  read as a specific set of steps or instructions that individuals with different  roles and responsibilities should take in order to accomplish established <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>. Courses  of action should provide answers to the following questions:</p>
    <blockquote>
        <ul>
            <ul>
                <li>What is the action?</li>
                <li>Who is responsible for the action?</li>
                <li>When does the action take place?</li>
                <li>How long does the action take and how much  time is actually available?</li>
                <li>What has to happen before?</li>
                <li>What happens after?</li>
                <li>What resources are needed to perform the  action?</li>
                <li>How will this action affect specific  populations, such as individuals with disabilities and others with access and  functional needs who may require medication, wayfinding, evacuation or personal  assistance services, or who may experience severe anxiety during traumatic  events?</li>
            </ul>
        </ul>
    </blockquote>
    <p>It is now time to develop courses of action that address the <strong>threats and hazards</strong> that your planning team selected for your school EOP in Step 3. As your team may recall, Step 3 also prompted your team to develop goals and objectives for threats and hazards. Those goals and objectives that your team developed may be found below, and are listed by the name of the threat or hazard.</p>
    <p>Please click on the Add button for each threat or hazard below. In the space indicated, write out courses of action that accomplish the goals and objectives that your team previously developed. After completing the courses of action field for the selected threat or hazard, click the Save button. Repeat this process for the remaining threats and hazards.</p>
    <p>If your team has already developed courses of action for a threat or hazard and wishes to modify the information, please click the Edit button for the respective threat or hazard. Pre-populated fields will appear with previously saved information. After editing the available field, click the Update button. Repeat this process, as needed.</p>
</div>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1>Add/Edit Courses of Action for Threats and Hazards</h1>
    <div id="goalFirstDivToRefresh">
        <table class="results">
            <tr>
                <th scope="col">Threats and Hazards</th>
                <th scope="col">Courses of Action</th>
            </tr>

            <?php

            $eligibleEntities = array();

            foreach($entities as $key=>$value){
                foreach($value['children'] as $child){
                    if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                        foreach($child['children'] as $grandChild){
                            foreach($grandChild['fields'] as $field){
                                if(isset($field['body']) && !empty($field['body'])){
                                    array_push($eligibleEntities, $value);
                                    break 3;
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
                        <?php
                            $mode = 'add';
                        ?>
                        <?php foreach($value['children'] as $child): ?>
                            <?php if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'): ?>
                                <?php foreach($child['children'] as $grandChild): ?>
                                    <?php if($grandChild['type']=="ca"): ?>
                                        <?php foreach($grandChild['fields'] as $field): ?>
                                            <?php if(isset($field['body']) && !empty($field['body'])): ?>
                                                <?php
                                                //Change the mode variable to edit and exit from all the loops
                                                $mode = 'edit';
                                                break 3;
                                                ?>
                                            <?php else: ?>
                                                <?php //Don't alter the $mode variable ?>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($mode=='add'):?>
                            <a href="#" id="<?php echo $value['id'];?>" class="addThActionLink">Add</a>
                            <?php else: ?>
                                <a href="#" id="<?php echo $value['id'];?>" class="editThActionLink">Edit</a>
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

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step4/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step4/2')); ?>"); //Previous


        $(".addThActionLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHActionCtrls')); ?>',
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

        $(".editThActionLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'update'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHActionCtrls')); ?>',
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


        $(document).on('click', '#saveBtn', function(){
            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var THid            = $('#entity_identifier').val();
            var g1Id            = g1Element.attr("data-goal-id");
            var g1FieldId       = g1Element.attr("data-field-id");
            var g1CAData        = g1Element.val();

            var g2Id            = g2Element.attr("data-goal-id");
            var g2FieldId       = g2Element.attr("data-field-id");
            var g2CAData        = g2Element.val();

            var g3Id            = g3Element.attr("data-goal-id");
            var g3FieldId       = g3Element.attr("data-field-id");
            var g3CAData        = g3Element.val();


            var mode = $('#action_identifier').val();

            var formData = {
                ajax:   '1',
                THid:   THid,
                mode:   mode,

                g1Id:       g1Id,
                g1FieldId:  g1FieldId,
                g1CAData:   g1CAData,

                g2Id:       g2Id,
                g2FieldId:  g2FieldId,
                g2CAData:   g2CAData,

                g3Id:       g3Id,
                g3FieldId:  g3FieldId,
                g3CAData:   g3CAData
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageTHActions')); ?>',
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


        $(document).on('click', '#updateBtn', function(){
            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var THid            = $('#entity_identifier').val();
            var g1Id            = g1Element.attr("data-goal-id");
            var g1FieldId       = g1Element.attr("data-field-id");
            var g1CAData        = g1Element.val();

            var g2Id            = g2Element.attr("data-goal-id");
            var g2FieldId       = g2Element.attr("data-field-id");
            var g2CAData        = g2Element.val();

            var g3Id            = g3Element.attr("data-goal-id");
            var g3FieldId       = g3Element.attr("data-field-id");
            var g3CAData        = g3Element.val();


            var mode = $('#action_identifier').val();

            var formData = {
                ajax:   '1',
                THid:   THid,
                mode:   mode,

                g1Id:       g1Id,
                g1FieldId:  g1FieldId,
                g1CAData:   g1CAData,

                g2Id:       g2Id,
                g2FieldId:  g2FieldId,
                g2CAData:   g2CAData,

                g3Id:       g3Id,
                g3FieldId:  g3FieldId,
                g3CAData:   g3CAData
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageTHActions')); ?>',
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