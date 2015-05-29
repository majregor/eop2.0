<?php
/**
 *  Page specific submenu embedded
 */
$planPages = array('step1', 'step2', 'step3', 'step4', 'step5', 'step6');
$mangementPages = array('users' , 'school', 'district', 'access' ,'account');
?>
<div id="step_row">
    <div id="step_title">
        <h2><?php echo(isset($step_title)? $step_title: '****Put*** Title'); ?></h2>
    </div>
    <?php if(in_array($page, $mangementPages)): ?>
    <div style="padding:5px 20px; margin-left:20px; float:left; font-size:0.9em; color:#5A5A5A">
        Logged in as: <em><?php echo($this->session->userdata('username')); ?></em> | Role: <em><?php echo($this->session->userdata['role']['role']); ?></em>
    </div>
        <?php elseif(in_array($page, $planPages)): ?>
        <div id="steps">
            <ul>
                <li class="stepNav active">
                    <a href="step1.php">Step 1</a>
                </li>
                <li class="stepNav">
                    <a href="step2.php">Step 2</a>
                </li>
                <li class="stepNav">
                    <a href="step3.php">Step 3</a>
                </li>
                <li class="stepNav">
                    <a href="step4.php">Step 4</a>
                </li>
                <li class="stepNav">
                    <a href="step5.php">Step 5</a>
                </li>
                <li class="stepNav">
                    <a href="step6.php">Step 6</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>