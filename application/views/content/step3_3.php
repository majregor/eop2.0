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
    <div id="goalFirstDivToRefresh">
        <table class="results">
            <tr>
                <th scope="col">Threats and Hazards</th>
                <th scope="col">Goals and Objectives</th>
            </tr>
            <?php foreach($entities as $key=>$value): ?>
                <tr>
                    <td><?php echo $value['name']; ?></td>
                    <td align="center">
                        <?php if(isset($value['fields']) && count($value['fields'])>0): ?>
                            <a href="#" id="<?php echo $value['id'];?>">Edit</a>
                        <?php else: ?>
                            <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink">Add</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="container-<?php echo $value['id'];?>"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/2')); ?>"); //Previous

        $("#rightArrowButton").click(function(){


        });

        $(".addFieldsLink").click(function(){

            var selectedId = $(this).attr('id');
            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add'

            }
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err.message());
                    }
                }

            });
        });



    }); // End $(document).ready function

</script>
