<?php
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 6-3</h1>
        <h1>Exercise the Plan</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_3"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>


<div class="col-half left">
    <p>The  more a plan is practiced and stakeholders are trained on the plan, the more  effectively they will be able to act before, during, and after an emergency to  lessen the impact on life and property. Exercises provide opportunities to  practice with community partners (e.g., first responders, local emergency  management personnel), as well as to identify gaps and weaknesses in the plan.  The exercises below require increasing amounts of planning, time, and  resources. Ideally, schools will create an exercise program, building from a  tabletop exercise up to a more advanced exercise, like a functional exercise.</p>
    <ul>


        <div class="accordion">
            <h3 class="accordion-toggle">
                <ul>
                    <li><a href="#">Tabletop exercises</a></li>
                </ul>
            </h3>
            <div class="accordion-content default">
                <blockquote>
                    <p>Tabletop exercises are small-group discussions that walk through a scenario and the courses of action a school will need to take before, during, and after an emergency to lessen the impact on the school community. This activity helps assess the plan and resources, and facilitates an understanding of emergency management and planning concepts.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <h3 class="accordion-toggle">
                <ul>
                    <li><a href="#">Drills</a></li>
                </ul>
            </h3>
            <div class="accordion-content default">
                <blockquote>
                    <p>During drills, school personnel and community partners (e.g., first responders, local emergency management staff) use the actual school grounds and buildings to practice responding to a scenario.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <h3 class="accordion-toggle">
                <ul>
                    <li><a href="#">Functional exercises</a></li>
                </ul>
            </h3>
            <div class="accordion-content default">
                <blockquote>
                    <p>Functional exercises are similar to drills but involve multiple partners; some may be conducted district-wide. Participants react to realistic simulated events (e.g., a bomb threat, or an intruder with a gun in a classroom), and implement the plan and procedures using the ICS.</p>
                </blockquote>
            </div>
        </div>


        <div class="accordion">
            <h3 class="accordion-toggle">
                <ul>
                    <li><a href="#">Full-scale exercises</a></li>
                </ul>
            </h3>
            <div class="accordion-content default">
                <blockquote>
                    <p>These exercises are the most time-consuming activity in the exercise continuum and are multiagency, multijurisdictional efforts in which all resources are deployed. This type of exercise tests collaboration among the agencies and participants, public information systems, communications systems, and equipment. An Emergency Operations Center is established by either law enforcement or fire services, and the ICS is activated.</p>
                </blockquote>
                </li>
            </div>
        </div>
    </ul><br />
    <p>Before  making a decision about how many and which types of exercises to implement, a  school should consider the costs and benefits of each, as well as any state or  local requirements.
    </p>
    </p>
    <p>To  effectively execute an exercise:</p>
    <ul>
        <ul>
            <li>Include community partners such as <a href="#" class="bt" title="Law enforcement officers, EMS practitioners, and fire department personnel.">first responders</a>  and  local emergency management staff;</li>
            <li>Communicate information about the exercise in  advance to avoid confusion and concern;</li>
            <li>Exercise under different and non-ideal  conditions (e.g., times of day, weather conditions, points in the academic  calendar, absence of key personnel, and various school events);</li>
            <li>Be consistent with <a href="http://rems.ed.gov/docs/Glossary%20of%20Key%20Terms%208.8.2014.pdf" target="_blank">common  emergency management terminology</a>;</li>
            <li>Debrief and develop an after-action report that  evaluates results, identifies gaps or shortfalls, and documents lessons  learned; and</li>
            <li>Discuss how the school EOP and procedures  will be modified, if needed, and specify who has the responsibility for  modifying the plan.</li>
        </ul>
        </li>
    </ul>
</div><!-- /col-half --><!-- /col-half -->



<script type='text/javascript'>

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step6/2')); ?>"); //Previous

    }); // End $(document).ready function


    $('.accordion').find('.accordion-toggle').click(function(){
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');
        //Hide the other panels
        $(".accordion-content").not($(this).next()).slideUp('fast');
    });

</script>
