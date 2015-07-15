<?php
//print_r($page_vars['schools_with_data']);
$schoolsData = (count($page_vars['schools_with_data'])>0)? $page_vars['schools_with_data']: array();
$role_level = $this->session->userdata['role']['level'];
?>
<div class="col-half left">

    <table border="0" width="100%">
        <tr style="background:#eee">
            <td>Date</td>
            <?php if($role_level<=3): ?>
            <td>School</td>
            <?php endif; ?>
            <td>School EOP</td>
        </tr>

        <?php foreach($schoolsData as $key => $school): ?>
            <tr>
                <td><?php echo($school[0]['last_modified']); ?></td>
                <?php if($role_level<=3): ?>
                    <td><?php echo($school[0]['name']); ?></td>
                <?php endif; ?>
                <td>
                    <a href="<?php echo base_url(); ?>report/make/<?php echo($school[0]['id']); ?>">Download</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script language="javascript">
    $(document).ready(function(){
        $("#arrow_nav").hide();
    });
</script>