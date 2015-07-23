<?php
/**
 *
 *
 *
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
if($action=='add'){
    //Do nothing right now
}else{
    $child1=array();

    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['name']){
                case '10.1':
                    $child1 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tbody>
    <tr>
        <td><p>The  Authorities and References section provides the legal basis for emergency  operations and activities, and includes:</p>
            <ul>
                <ul>
                    <li>Lists of laws, statutes, ordinances,  executive orders, regulations, and formal agreements relevant to emergencies;  and</li>
                    <li>Provisions for the succession of  decision-making authority and   operational control to ensure that critical  emergency functions can be   performed in the absence of the school  administrator.</li><br />
                </ul>
            </ul></td>
    </tr>
    <tr>
        <td><strong>In the field below, please cut and paste, write out or upload the Authorities and References section of your school EOP. </strong></td>
    </tr>
    <tr>
        <td><textarea name="authField" id="authField" style="width: 100%"   <?php echo($controlStatus); ?> rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input type="button" value="Save" id="btnsaveform10"/>
                        <?php else: ?>
                        <input type="button" value="Update" id="btnsaveform10"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn"/>
            </div></td>
    </tr>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform10").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            authFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            authField:       $("#authField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm10')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    //alert(response);
                    location.reload();

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });

        $("#form10Div").html('');
        return false;
    });

    $("#cancelBtn").click(function(){
        $("#form10Div").html('');
        return false;
    });

    });
</script>