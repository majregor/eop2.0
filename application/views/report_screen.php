<?php
//print_r($page_vars['schools_with_data']);
$schoolsData = (count($page_vars['schools_with_data'])>0)? $page_vars['schools_with_data']: array();
$role_level = $this->session->userdata['role']['level'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<div class="col-half left">

    <table border="0" width="100%" class=" display" id="myEOPReportTbl" >
        <thead>
            <tr style="background:#eee; font-weight: bold;">
                <th>Date</th>
                <?php if($role_level<=3): ?>
                <th>School</th>
                <?php endif; ?>
                <th>Basic Plan Source</th>
                <th>School EOP</th>
            </tr>
        </thead>

        <?php foreach($schoolsData as $key => $school):

            $EOP_type="internal";
            if(!empty($school[0]['preferences'])){
                $preferenceObj = json_decode($school[0]['preferences']);
                if(!empty($preferenceObj->main))
                $EOP_type = $preferenceObj->main->basic_plan_source;
            }
        ?>
            <tr>
                <td><?php echo(date_format(date_create($school[0]['last_modified']), 'm/d/Y g:i a')); ?></td>
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

        <tfoot>
        <tr style="background:#eee; font-weight: bold;">
            <th>Date</th>
            <?php if($role_level<=3): ?>
                <th>School</th>
            <?php endif; ?>
            <th>Basic Plan Source</th>
            <th>School EOP</th>
        </tr>
        </tfoot>
    </table>
</div>

<script language="javascript">
    $(document).ready(function(){
        $("#arrow_nav").hide();

        <?php if($this->session->userdata['role']['role_id']<=3): ?>
            $('#myEOPReportTbl').DataTable({
                "order" : [[0, "desc"]],
                "bFilter": false, // For the search text box
                "bInfo": true, // For the "Showing 1 to 10 of x entries" text at the bottom
                "columnDefs": [
                    {"orderable": false, "targets": [2,3] }
                ]
            });
        <?php else: ?>
            $('#myEOPReportTbl').DataTable({
                "order" : [[0, "desc"]],
                "bFilter": false, // For the search text box
                "bInfo": true, // For the "Showing 1 to 10 of x entries" text at the bottom
                "columnDefs": [
                    {"orderable": false, "targets": [2] }
                ]
            });
        <?php endif; ?>
    });
</script>