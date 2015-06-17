<?php
/**
 * AJAX loaded view for Step3/3 Develop Goals for Threats and Hazards
 *
 */
?>
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
                                data-id="<?php echo($thChild['id']);?>"
                                style="width:100%"
                                rows="4"><?php echo($field['body']); ?></textarea>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtnorm">Function:</td>
                    <td>
                        <select
                            name="slct<?php echo($thChild['type']);?>fn"
                            id="slct<?php echo($thChild['type']);?>fn"
                            style="width: 65%"
                            class="fnDropDown">
                            <option value="" selected="selected">--Select--</option>
                            <?php foreach($functions as $key=>$value): ?>
                                <option value="<?php echo($value['id']);?>"><?php echo($value['name']);?></option>
                            <?php endforeach; ?>
                            <option value="other">Other</option>
                        </select>
                        <a href="" class="fnRefreshSpin" title="" id="<?php echo($thChild['type']);?>fn"><img src="<?php echo base_url(); ?>assets/img/spin.png" border="0" align="absmiddle"/></a>
                    </td>
                </tr>

                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr>
                            <td class="txnorm">Objective</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        name="txt<?php  echo($thChild['type']);?>obj<?php echo($key);?>"
                                        id="txt<?php    echo($thChild['type']);?>obj<?php echo($key);?>"
                                        class="<?php    echo($thChild['type']);?>Obj"
                                        data-id="<?php echo($grandChild['id']);?>"
                                        style="width:100%" rows="4"><?php echo($field['body']); ?></textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="txtnorm">Function:</td>
                            <td>
                                <select
                                    name="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    id="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    style="width: 65%"
                                    class="<?php    echo($thChild['type']);?>fn">
                                    <option value="" selected="selected">--Select--</option>
                                    <?php foreach($functions as $key=>$value): ?>
                                        <option value="<?php echo($value['id']);?>"><?php echo($value['name']);?></option>
                                    <?php endforeach; ?>
                                    <option value="other">Other</option>
                                </select>
                                <a href="" class="fnRefreshSpin" title="" id="refreshBtn">
                                    <img src="<?php echo base_url(); ?>assets/img/spin.png" border="0" align="absmiddle"/>
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr id="addMore<?php echo($thChild['type']);?>ObjFnRow" style=" border-top: 2px solid #DDD;">
                    <td colspan="2" align="right">
                        <a href="" id="addMore<?php echo($thChild['type']);?>ObjFnLink">[Add More]</a> |
                        <a href="" id="remove<?php echo($thChild['type']);?>ThRowLink">[Remove]</a>
                    </td>
                </tr>

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
                    <input id="saveBtn" type="button" value="Save"/>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<script>
    var g1Items= 0, g2Items= 0, g3Items=0;
    var g1Elements = [], g2Elements = [], g3Elements = [];

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
                }else{
                    g<?php echo($i);?>Items ++;
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items-1)+"Fn").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                }
                return false;
            });

            $("#removeg<?php echo($i);?>ThRowLink").click(function(){

                if(g<?php echo($i);?>Items > 0){
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)+"Fn").remove();
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)).remove();

                    g<?php echo($i);?>Items --;
                }
                return false;
            });
        <?php endfor; ?>


    });



    function mkObjectiveCtl( goal, items ){
        var data="";
        data+="<tr id='g"+goal+"Item"+items+"'>";
        data+="<td class='txnorm'>Objective</td>";
        data+="<td>";
        data+="<textarea class='g"+goal+"Obj'  style='width:100%' rows='4'></textarea>";
        data+="</td></tr>";
        data+="<tr id='g"+goal+"Item"+items+"Fn'>  <td class='txtnorm'>Function:</td>";
        data+="<td>  <select  style='width: 65%' class='g"+goal+"fn'>";
        data+="<option value='' selected='selected'>--Select--</option>";
        <?php foreach($functions as $key=>$value): ?>
            data+="<option value='<?php echo($value['id']);?>'><?php echo($value['name']);?></option>";
        <?php endforeach; ?>
        data+="<option value='other'>Other</option>";
        data+="</select>";
        data+="<a href='' class='fnRefreshSpin' title='' id='refreshBtn'>";
        data+="<img src='<?php echo base_url(); ?>assets/img/spin.png' border='0' align='absmiddle'/>";
        data+="</a> </td> </tr>";

        return data;
    }
</script>