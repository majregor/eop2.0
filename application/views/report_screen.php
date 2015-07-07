<?php
//print_r($page_vars['schools_with_data']);
$schoolsData = $page_vars['schools_with_data'];
$role_level = $this->session->userdata['role']['level'];
?>
<div class="col-half left">

    <table border="0" width="100%">
        <tr style="background:#eee">
            <td>Date</td>
            <td>School EOP</td>
        </tr>

        <?php foreach($schoolsData as $key => $school): ?>
            <tr>
                <td><?php echo($school[0]['last_modified']); ?></td>
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