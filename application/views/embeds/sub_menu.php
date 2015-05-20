<?php
/**
 *  Page specific submenu embedded
 */
?>
<div id="step_row">
    <div id="step_title">
        <h2><?php echo(isset($step_title)? $step_title: '****Put*** Title'); ?></h2>
    </div>
    <div style="padding:5px 20px; margin-left:20px; float:left; font-size:0.9em; color:#5A5A5A">
        Logged in as: <em><?php echo($this->session->userdata('username')); ?></em> | Role: <em><?php echo($this->session->userdata['role']['role']); ?></em>
    </div>
</div>