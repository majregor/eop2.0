<?php
/**
 * AJAX loaded view for Step3/3 Develop Goals for Threats and Hazards
 *
 */
?>
<!--
************************************************************************************************************************
*************************************** STEP3_4 ADDING FUNCTIONAL GOALS AND OBJECTIVES CONTROLS ************************
************************************************************************************************************************
-->
<?php for($i=1; $i<=3; $i++): ?>
            <table class="editOne">
                <tr>
                    <td class="txtb" ><?php echo(($i==1)? "Goal 1 (Before):" : (($i==2)? "Goal 2 (During):":"Goal 3 (After):")); ?></td>
                    <td>
                            <textarea
                                name="txt<?php echo($i);?>"
                                id="g<?php echo($i);?>txt"
                                style="width:100%"
                                rows="4"></textarea>
                    </td>
                </tr>

                <tr>
                    <td class="txtnorm">Objective:</td>
                    <td>

                            <textarea
                                class="g<?php   echo($i);?>Obj"
                                style="width:100%" rows="4"></textarea>
                    </td>
                </tr>

                <tr id="addMoreg<?php echo($i);?>ObjFnRow" style=" border-top: 2px solid #DDD;">
                    <td colspan="2" align="right">
                        <a href="" id="addMoreg<?php echo($i);?>ObjFnLink">[Add More]</a> |
                        <a href="" id="removeg<?php echo($i);?>ThRowLink">[Remove]</a>
                    </td>
                </tr>

            </table>
<?php endfor; ?>


<table class="editUpdate">
    <tbody>
        <tr>
            <td align="right" colspan="2">
                <div align="left">
                    <input type="hidden" id="entity_identifier" value="<?php echo($entity_id);?>" />
                    <input type="hidden" id="action_identifier" value="<?php echo($action);?>" />
                    <input id="saveBtn" type="button" value="Save"/>
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

<script>
    var g1Items= 0, g2Items= 0, g3Items=0;


    <?php for($i=1; $i<=3; $i++): ?>

        var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
            return [$(value).val()];
        });

        g<?php echo($i);?>Items = g<?php echo($i);?>ObjData.length - 1;


    <?php endfor; ?>


    $(document).ready(function(){

        //Add More and Remove controls
        <?php for($i=1; $i<=3; $i++): ?>
            $("#addMoreg<?php echo($i);?>ObjFnLink").click(function(){

                if(g<?php echo($i);?>Items == 0){
                    g<?php echo($i);?>Items ++;
                    $("#addMoreg<?php echo($i);?>ObjFnRow").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                    var editor = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor.on( 'change', function( evt ) {
                        editor.updateElement();
                    });

                }else{

                    g<?php echo($i);?>Items ++;
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items-1)+"AddedRow").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                    var editor1 = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor1.on('change', function(evt){
                        editor1.updateElement();
                    });
                }
                return false;
            });

            $("#removeg<?php echo($i);?>ThRowLink").click(function(){

                if(g<?php echo($i);?>Items > 0){
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)+"AddedRow").remove();
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)).remove();

                    g<?php echo($i);?>Items --;
                }
                return false;
            });
        <?php endfor; ?>


    });



    function mkObjectiveCtl( goal, items ){
        var data="";
        data+="<tr id='g"+goal+"Item"+items+"AddedRow'>";
        data+="<td class='txnorm'>Objective</td>";
        data+="<td>";
        data+="<textarea name='g"+goal+"Item"+items+"' id='g"+goal+"Item"+items+"' class='g" + goal + "Obj'  style='width:100%' rows='4'></textarea>";
        data+="</td></tr>";

        return data;
    }
</script>
