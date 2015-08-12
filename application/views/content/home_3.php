
    <!--to be replaced when the next button is clicked-->
    <div id="topcontain">
        <div id="titlearea">
            <h1 id='currentPageTag'>Intro Three</h1>
            <h1>Introduction to the Planning Process</h1>
            <h3></h3>
        </div>
        <div id="resourcearea">
            <ul>
                <li class="sb-toggle-right" id="intro3"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
            </ul>
        </div>
    </div>
    <div class="col-half left">
        <p>The following&nbsp;<a href="http://rems.ed.gov/K12PlanningPrinciples.aspx" target="_blank">planning principles</a>&nbsp;are fundamental to developing a comprehensive school EOP that addresses a range of threats and hazards:</p>
        <ul>
            <ul>
                <ul>
                    <li>Planning must be supported by leadership.&nbsp;</li>
                    <li>Planning uses assessment to customize plans to the building level.&nbsp;</li>
                    <li>Planning considers all threats and hazards.&nbsp;</li>
                    <li>Planning provides for the access and functional needs of the <a href="#" class="bt" title="Includes children; individuals with disabilities and other access and functional needs; those from religiously, racially, and ethnically diverse backgrounds; and people with limited English proficiency.">whole school community.</a>
                    </li>
                    <li>Planning considers all settings and all times.&nbsp;</li>
                    <li>Creating and revising a model EOP is done by following a collaborative process.&nbsp;</li>
                </ul>
            </ul>
        </ul><br />
        <p> These planning principles are integrated throughout the&nbsp;<em>Guide&rsquo;s</em>&nbsp;recommended&nbsp;<a href="http://rems.ed.gov/K12PlanningProcess.aspx" target="_blank">six step planning process</a>&nbsp;for developing a high-quality school EOP.&nbsp; </p>
        <p>This tool is organized according to those six steps, and will walk users through each step to ultimately create a comprehensive school EOP that includes<br/>
            a <a href="#" class="bt" title="The Basic Plan section provides an overview of the school’s approach to operations before, during, and after an emergency.">Basic Plan</a> section, a <a href="#" class="bt" title="The Functional Annexes section focuses on critical operational functions and the courses of action developed to carry them out.">Functional Annexes</a> section, and a <a href="#" class="bt" title="The Threat- and Hazard-Specific Annexes section describes the courses of action unique to particular threats and hazards.">Threat- and Hazard-Specific Annexes</a> section. </p>
        <p>To initiate the planning process, please proceed to Step 1.</p>
        <p>&nbsp;</p>
        <p align="center"><img src="<?php echo base_url(); ?>assets/img/intro3_clip_image002.png" alt="" width="966" height="452" /><strong> </strong></p>
    </div><!-- /col-half --><!-- /col-half -->
    <!--end to be replaced content-->

<script type='text/javascript'>
    $(document).ready(function(){

        $(document).on("click", ".tooltip", function() {
            $(this).tooltip(
                {
                    items: ".tooltip",
                    content: function(){
                        return $(this).data('description');
                    },
                    close: function( event, ui ) {
                        var me = this;
                        ui.tooltip.hover(
                            function () {
                                $(this).stop(true).fadeTo(400, 1);
                            },
                            function () {
                                $(this).fadeOut("400", function(){
                                    $(this).remove();
                                });
                            }
                        );
                        ui.tooltip.on("remove", function(){
                            $(me).tooltip("destroy");
                        });
                    },
                }
            );
            $(this).tooltip("open");
        });
    });//end document.ready function
</script>

<script type='text/javascript'>
    $(document).ready(function(){

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('home/step/2')); ?>"); //Previous



    });
</script>