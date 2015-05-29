<div class="adminMenu">
    <ul>
        <?php if($role['level']<5): ?>
        <li>
            <a href="<?php echo base_url(); ?>user">User Management </a> &nbsp;&nbsp; | &nbsp;&nbsp;

        </li>
            <?php if($role['level']<4): ?>
                <li>
                    <a href="<?php echo base_url(); ?>school">School Management</a> &nbsp;&nbsp; | &nbsp;&nbsp;

                </li>
                <li>
                    <a href="<?php echo base_url(); ?>district">District Management</a> &nbsp;&nbsp;|&nbsp;&nbsp;

                </li>
            <?php endif; ?>
        <li>
            <a href="<?php echo base_url(); ?>access">State Access</a>
        </li>
        <?php endif; ?>
    </ul>
    <br style="clear: both;"/>
</div>