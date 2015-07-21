<?php
/**
 * AJAX loaded view for Step5/2 Edit Goals and Courses of Action for Threats and Hazards
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
?>
<style>
    *[contenteditable="true"]
    {
        padding: 10px;
    }
    div.goalData, div.g1Obj, div.g2Obj, div.g3Obj{

    }

    /* Style a bit the inline editables. */
    .cke_editable.cke_editable_inline
    {
        cursor: pointer;
    }

    /* Once an editable element gets focused, the "cke_focus" class is
       added to it, so we can style it differently. */
    .cke_editable.cke_editable_inline.cke_focus
    {
        box-shadow: inset 0px 0px 20px 3px #ddd, inset 0 0 1px #000;
        outline: none;
        background: #eee;
        cursor: text;
    }
</style>
<!--
************************************************************************************************************************
*************************************** STEP3_3 GOALS AND OBJECTIVES CONTROLS ******************************************
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
                            <textarea
                                name="txt<?php echo($thChild['type']);?>"
                                id="txt<?php echo($thChild['type']);?>"
                                <?php echo($controlStatus); ?>
                                data-id="<?php echo($thChild['id']);?>"
                                data-field-id="<?php echo($field['id']);?>"
                                style="width:100%"
                                rows="4"><?php echo($field['body']); ?></textarea>
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
                                <select
                                    name="slct<?php echo($thChild['type']);?>fn"
                                    id="slct<?php echo($thChild['type']);?>fn"
                                    <?php echo($controlStatus); ?>
                                    style="width: 65%"
                                    class="fnDropDown"
                                    required="required">
                                    <option value="" selected="selected">--Select--</option>
                                    <?php foreach($functions as $key=>$value): ?>
                                        <option value="<?php echo($value['id']);?>" <?php echo(($value['name'] == $fnValue)? "selected='selected'": "");?> >
                                            <?php echo($value['name']);?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="other">Other</option>
                                </select>

                            </td>
                        </tr>


                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr id="objRow<?php echo($key);?>">
                            <td class="txnorm">Objective</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        name="txt<?php  echo($thChild['type']);?>obj<?php echo($key);?>"
                                        id="txt<?php    echo($thChild['type']);?>obj<?php echo($key);?>"
                                        <?php echo($controlStatus); ?>
                                        class="<?php    echo($thChild['type']);?>Obj"
                                        data-id="<?php echo($grandChild['id']);?>"
                                        data-field-id="<?php echo($field['id']);?>"
                                        item-index = "<?php echo($key);?>"
                                        canRemove = <?php echo(($key==0)? "no": "yes"); ?>
                                        style="width:100%" rows="4"><?php echo($field['body']); ?></textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>

                        <?php
                        $fnValue="";
                        foreach($grandChild['children'] as $greatGrandChild){
                            if($greatGrandChild['type']=="fn"){
                                $fnValue = $greatGrandChild['name'];
                            }
                        }
                        ?>
                        <tr id="functionRow<?php echo($key); ?>">
                            <td class="txtnorm">Function:</td>
                            <td>
                                <select
                                    name="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    id="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    <?php echo($controlStatus); ?>
                                    style="width: 65%"
                                    class="<?php    echo($thChild['type']);?>fn"
                                    required="required">
                                    <option value="" selected="selected">--Select--</option>
                                    <?php foreach($functions as $key=>$value): ?>
                                        <option value="<?php echo($value['id']);?>" <?php echo(($value['name'] == $fnValue)? "selected='selected'": "");?>>
                                            <?php echo($value['name']);?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="other">Other</option>
                                </select>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if(isset($showActions) && $showActions==true): ?>
                    <?php foreach($thChild['children'] as $key => $grandChild): ?>
                            <?php if($grandChild['type']=="ca"): // Get only grandchildren of type ca (Course of Action) ?>

                                <tr>
                                    <td class="txtb">
                                        Courses of Action:</td>
                                    <td>
                                        <?php foreach($grandChild['fields'] as $field): ?>
                                            <textarea
                                                name="txt<?php    echo($thChild['type']);?>ca"
                                                id="txt<?php  echo($thChild['type']);?>ca"
                                                <?php echo($controlStatus); ?>
                                                data-field-id="<?php echo($field['id']);?>"
                                                rows="11" style="width:100%">
                                                    <?php echo($field['body']); ?>
                                                </textarea>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

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
                    <?php if($action !="view"): ?>
                        <input id="saveBtn" type="button" value="Update"/>
                    <?php endif; ?>

                    <input id="cancelBtn" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>"/>
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
