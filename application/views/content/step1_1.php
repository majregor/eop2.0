<?php

?>

    <!--to be replaced when the next button is clicked-->
    <div id="topcontain">
        <div id="titlearea">
            <h1 id='currentPageTag'>Step 1-1</h1>
            <h1>Overview of Step 1: Form a Collaborative Planning Team</h1>
            <h3></h3>
        </div>
        <div id="resourcearea">
            <ul>
                <li class="sb-toggle-right" id="step1_1"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
            </ul>
        </div>
    </div>
    <div class="col-half left">
        <p>Lessons learned indicate that operational planning is best performed by a team. Step 1 of the six step planning process will provide your school with guidance on how to assemble a collaborative planning team that is ready to engage in the process of developing a school EOP.</p>
        <p><strong>Identify a Core Planning Team</strong></p>
        <p>Your school’s first task is to identify a core planning team that includes diverse representation from the school and surrounding community. If your school already has a preliminary planning team, the guidance in this section may help schools consider how to expand or refine that team.</p>
        <p><strong>Form a Common Framework and Define and Assign Roles and Responsibilities</strong></p>
        <p>After establishing a core planning team, your team will need to establish a common framework, or a shared approach to facilitate mutual understanding among team members. Additionally, members of the planning team will need to know their roles and responsibilities to facilitate effective planning.</p>
        <p><strong>Determine a Regular Schedule of Meetings</strong></p>
        <p>Finally, your team will be prompted to establish a regular schedule of meetings to facilitate greater collaboration among team members.</p>
        <p><strong>Outcome of Step 1</strong></p>
        <p>At the conclusion of Step 1, your school should have a collaborative planning team that is ready to undertake the work in Step 2—identifying and analyzing threats and hazards in the school and surrounding community.</p>
        <!--THIS IS ADDED TO SHOW HOW THE POPUP WORKS WITH JQUERY-->

    </div><!-- /col-half --><!-- /col-half -->
    <!--end to be replaced content-->


<script type='text/javascript'>
    $(document).ready(function(){

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step1/2')); ?>");

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step1/1')); ?>");

    });
</script>