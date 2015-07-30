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
            <td>Basic Plan Source</td>
            <td>School EOP</td>
        </tr>

        <?php foreach($schoolsData as $key => $school):

            $EOP_type="internal";
            if(!empty($school[0]['preferences'])){
                $preferenceObj = json_decode($school[0]['preferences']);
                if(!empty($preferenceObj->main))
                $EOP_type = $preferenceObj->main->basic_plan_source;
            }
        ?>
            <tr>
                <td><?php echo($school[0]['last_modified']); ?></td>
                <?php if($role_level<=3): ?>
                    <td><?php echo($school[0]['name']); ?></td>
                <?php endif; ?>
                <td>
                    <?php echo($EOP_type=='internal')? "Internal": "External / Uploaded"; ?>
                </td>
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