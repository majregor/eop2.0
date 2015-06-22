<?php
/**
 * AJAX loaded view for Step3/3 Develop Goals for Threats and Hazards
 *
 */
?>
<!--
************************************************************************************************************************
*************************************** STEP4_3 COURSES OF ACTION CONTROLS    ******************************************
************************************************************************************************************************
-->
<?php foreach($threats_and_hazards as  $thEntities): ?>
    <?php foreach($thEntities['children'] as $thChild): ?>
        <?php if($thChild['type']=='g1' || $thChild['type']=='g2' || $thChild['type']=='g3'):?>
            <table class="editOne">
                <tr>
                    <td class="txtb" ><?php echo($thChild['type_title']); ?>:</td>
                    <td>
                        <?php foreach($thChild['fields'] as $field): ?>
                           <?php echo($field['body']); ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php
                        $fnValue="";
                    foreach($thChild['children'] as $key => $grandChild){
                        if($grandChild['type']=="fn"){
                            $fnValue = $grandChild['name'];
                        }
                    }
                ?>
                        <tr>
                            <td class="txtnorm">Function:</td>
                            <td>
                                <?php echo($fnValue); ?>
                            </td>
                        </tr>


                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr>
                            <td class="txnorm">Objective</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <?php echo($field['body']); ?>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <?php
                        $fnValue="";
                        foreach($grandChild['children'] as $key => $greatGrandChild){
                            if($greatGrandChild['type']=="fn"){
                                $fnValue = $greatGrandChild['name'];
                            }
                        }
                        ?>
                        <tr>
                            <td class="txtnorm">Function:</td>
                            <td>
                                <?php echo($fnValue);?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if($grandChild['type']=="ca"): // Get only grandchildren of type ca (Course of Action) ?>

                            <tr>
                                <td class="txtb">Courses of Action:</td>
                                <td>
                                    <?php foreach($grandChild['fields'] as $field): ?>
                                        <textarea
                                            name="txt<?php    echo($thChild['type']);?>ca"
                                            id="txt<?php  echo($thChild['type']);?>ca"
                                            data-field-id="<?php echo($field['id']);?>"
                                            data-goal-id="<?php echo($thChild['id']); ?>"
                                            rows="11" style="width:100%">
                                                <?php echo($field['body']); ?>
                                            </textarea>
                                    <?php endforeach; ?>
                                </td>
                            </tr>

                    <?php endif; ?>
                <?php endforeach; ?>



            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<table class="editUpdate">
    <tbody>
        <tr>
            <td align="right" colspan="2">
                <div align="left">
                    <input type="hidden" id="entity_identifier" value="<?php echo($entity_id);?>" />
                    <input type="hidden" id="action_identifier" value="<?php echo($action);?>" />

                    <?php if($action=='add'): ?>
                    <input id="saveBtn" type="button" value="Save" />
                    <?php else: ?>
                        <input id="updateBtn" type="button" value="Update"/>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
    $( document ).ready( function() {
        $( 'textarea' ).ckeditor();
    } );
</script>