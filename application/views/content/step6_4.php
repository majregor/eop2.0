<?php
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 6-4</h1>
        <h1>Review, Revise, and Maintain the Plan</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_4"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>


<div class="col-half left">
    <p>Once  your planning team has implemented the school EOP, your team will need to  update the plan regularly. </p>
    <p>Reviews  should be a recurring activity. Planning teams should establish a process for  reviewing and revising the plan. Many schools review their plans annually. In  no case should any part of a plan go for more than 2 years without being  reviewed and revised.<br />
        <br />
        Some  schools have found it useful to review and revise portions instead of reviewing  the entire plan at once. Schools may consider reviewing a portion each month or  at natural breaks in the academic calendar. Certain events will also provide  new information that will be used to inform the plan. Schools should consider  reviewing and updating their plans or sections of their plans after:</p>
    <ul>
        <ul>
            <li>Actual emergencies;</li>
            <li>Changes have been made in policy, personnel,  organizational structures, processes, facilities, or equipment;</li>
            <li>Formal updates of planning guidance or  standards have been finalized;</li>
            <li>Formal exercises have taken place;</li>
            <li>Changes in the school and surrounding  community have occurred;</li>
            <li>Threats or hazards change or new ones emerge;  or</li>
            <li>Ongoing assessments generate new information.</li>
        </ul>
    </ul>
    <p>&nbsp;<br />
        The  planning team should ensure that all community partners (e.g., first  responders, local emergency management staff) have the most current version of  the school EOP.</p>
    <p>Please  visit the EOP ASSIST <a href="mycalendar.php" target="_blank">Calendar</a> to schedule regular reviews of your plan.</p>
</div>



<script type='text/javascript'>

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/5')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step6/3')); ?>"); //Previous

    }); // End $(document).ready function


    $('.accordion').find('.accordion-toggle').click(function(){
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');
        //Hide the other panels
        $(".accordion-content").not($(this).next()).slideUp('fast');
    });

</script>
