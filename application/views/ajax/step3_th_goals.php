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
                        <textarea
                            name="txt<?php echo($thChild['type']);?>"
                            id="txt<?php echo($thChild['type']);?>"
                            style="width:100%"
                            rows="4"></textarea>
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
                    <tr>
                        <td class="txnorm">Objective</td>
                        <td>
                            <textarea
                                name="txt<?php  echo($thChild['type']);?>obj<?php echo($key);?>"
                                id="txt<?php    echo($thChild['type']);?>obj<?php echo($key);?>"
                                class="<?php    echo($thChild['type']);?>Obj"
                                style="width:100%" rows="4"></textarea>
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
                <?php endforeach; ?>

                <tr id="addMoreG1ObjFn1" style=" border-top: 2px solid #DDD;">
                    <td colspan="2" align="right">
                        <a href="" id="addMoreG1ObjFnLink">[Add More]</a> |
                        <a href="" id="removeG1ThRowLink">[Remove]</a>
                    </td>
                </tr>

            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<script>
    var g1Items=0;
    var g1Elements = [];

    var g1ObjData = $.map($(".g1Obj"), function(value, index) {
        return [$(value).val()];
    });

    $(document).ready(function(){

        //Add More and Remove controls
        $("#addMoreG1ObjFnLink").click(function(){

            if(g1Items == 0){
                g1Items ++;
                $("#addMoreG1ObjFn1").after(mkObjectiveCtl(1, g1Items));
            }else{
                g1Items ++;
                $("#g1Item"+(g1Items-1)+"Fn").after(mkObjectiveCtl(1, g1Items));
            }
            return false;
        });

        $("#removeG1ThRowLink").click(function(){

            if(g1Items > 0){
                $("#g1Item"+(g1Items)+"Fn").remove();
                $("#g1Item"+(g1Items)).remove();

                g1Items --;
            }
            return false;
        });
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