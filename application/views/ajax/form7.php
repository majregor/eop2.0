<?php
/**
 *
 *
 *
 *
 */
if($action=='add'){
    //Do nothing right now
}else{
    $child1=array();

    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['name']){
                case '7.1':
                    $child1 = $child;
                    break;

            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td><p>The Training and Exercises section describes the critical training and exercise activities the school will use in support of the plan. This includes the core training objectives and frequencyto ensure that staff members, students, faculty, parents, and community representatives understand roles, responsibilities, and expectations. This section also establishes the expected frequency of exercises to be conducted by the school. Content may be influenced based on similar requirements at the district and/or local jurisdiction level(s). Exercises may range from basic fire and shelter-in-place drills to full-scale community-wide drills that realistically portray an emergency event and show the role the school plays in school district and municipal planning.<br />
            </p></td>
    </tr>
    <tr>
        <td><strong>In the field below, please cut and paste  or write out the Training and Exercises section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td><textarea name="trainingField" id="trainingField" style="width: 100%" rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action=='add'): ?>
                    <input type="button" value="Save" id="btnsaveform7"/>
                    <?php else: ?>
                    <input type="button" value="Update" id="btnsaveform7"/>
                <?php endif; ?>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform7").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            trainingFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            trainingField:       $("#trainingField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm7')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    alert(response);

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });

        $("#form7Div").html('');
        return false;
    });

    });
</script>