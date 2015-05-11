
    <div id="left-pane" style="width:30%; float:left; display:block;">
        <p>
        <a href="http://rems.ed.gov/" target="_blank"><img src="assets/img/REMS-TA-Center.png" width="161" height="59" class="REMSlogo"></a>
        </p>
        <ul class="task-list">
            <li id="step_hosting_level" class="<?php echo(($step=='hosting_level')? 'active':''); ?>">Choose Hosting Level</li>
            <li class="">Verify Requirements </li>
            <li class="">Database Settings</li>
            <li>Admin Account</li>
            <li>Configure  App</li>
            <li>FInished</li>
        </ul>
        <h3>
        <font color="red">* &nbsp;</font>
        <span style="color:#59B"><strong>Required Field</strong></span>
        </h3>
    </div><!-- ENd left-pane -->


    <!-- SELECT HOSTING LEVEL -->
    <?php if($screen=='hosting_level'): ?>
        <div id="right-pane" style="width:70%; float:left; display:block;">
            <?php include('embeds/hosting_level.php'); ?>
        </div>
    <?php endif; ?>