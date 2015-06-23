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
    $child0=array();
    $child1=array();
    $child2=array();
    $child3=array();
    $child4=array();

    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['name']){
                case '1.0':
                    $child0 = $child;
                    break;
                case '1.1':
                    $child1 = $child;
                    break;
                case '1.2':
                    $child2 = $child;
                    break;
                case '1.3':
                    $child3 = $child;
                    break;
                case '1.4':
                    $child4 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><table border="0" width="100%">
                <tbody>
                <tr>
                    <td><p><u>1.0 Cover Page</u></p>
                        <p>Complete the following fields to create the cover page of your plan:</p></td>
                </tr>
                </tbody>
            </table></td>
    </tr>
    <tr>
        <td width="18%">Title of the plan:</td>
        <td width="82%">
            <input type="text" name="titleField" id="titleField" size="50" value="<?php echo(isset($child0['fields'][0]['body'])? $child0['fields'][0]['body'] : ''); ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>Date:</td>
        <td><input type="text" id="dateField" class="datePickerWidget" value="<?php echo(isset($child0['fields'][1]['body'])? $child0['fields'][1]['body'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">The school(s) covered by the plan:</td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="schoolsField" id="schoolsField" style="width: 100%" rows="11"><?php echo(isset($child0['fields'][2]['body'])? $child0['fields'][2]['body'] : ''); ?></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.1 Promulgation Document and Signatures</u>            </p>            <p>This document or page contains a signed statement formally recognizing and adopting the school EOP. It gives both the authority and the responsibility to school officials to perform their tasks before, during, or after an incident, and therefore should be signed by the school administrator or another authorizing official.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste or write out the Promulgation Document and Signatures section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="promulgationField" id="promulgationField" style="width: 100%" rows="11"></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.2 Approval and Implementation</u>            </p>            <p>The Approval and Implementation page introduces the plan, outlines its applicability, and indicates that it supersedes all previous plans. It includes a delegation of authority for specific modifications that can be made to the plan and by whom they can be made without the school administrator&rsquo;s signature. It also includes a date and should be signed by the authorized school administrator.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste or write out your school&rsquo;s or district&rsquo;s statement formally recognizing and adopting the school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="approvalField" id="approvalField" style="width: 100%" rows="11"></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.3 Record of Changes</u>            </p>            <p>Each update or change to the plan should be tracked. The Record of Changes page, usually in table format, contains—at a minimum—a change number, the date of the change, the name of the person who made the change, and a summary of the change.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the table below, please identify any Record of Changes information, as described above. If your plan does not yet contain any changes, you may leave the material included below untouched. Also, if you prefer to organize your Record of Changes information using different headings, or in a different format, you may edit the material located in the field below.</strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>Record of Changes</strong></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <div style="text-align: right">
                <a href="#" id="addRowsQ3Link">Add Row</a>
                |
                <a href="#" id="removeRowsQ3Link">Remove Row</a>
            </div>
            <table border="0" width="100%">
                <tr style="background: #eee">
                    <td><strong>Change Number</strong></td>
                    <td><strong>Date of Change</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Summary of Change</strong></td>
                </tr>
                <tr id="thRowQ31" class="thRowQ3">
                    <td><input type="text" name="txtrowq311" id="txtrowq311" /></td>
                    <td><input type="text" name="txtrowq312" id="txtrowq312" class="datePickerWidget"/></td>
                    <td><input type="text" name="txtrowq313" id="txtrowq313" /></td>
                    <td><input type="text" name="txtrowq314" id="txtrowq314" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>1.4 Record of Distribution</u>          </p>
            <p>Districts and schools typically share their final EOPs with community partners who have a role in carrying out the plan before, during, or after an emergency. The record of distribution, usually in table format, documents the title and the name of the person receiving the plan, the agency to which the recipient belongs (either the school office or, if from outside the school, the name of the appropriate government agency or private-sector entity), the date of delivery, and the number of copies delivered.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the table below, please identify any Record of Distribution information, as described above. If you have not yet distributed your plan, you may leave the material included below untouched. Also, if you prefer to organize your Record of Distribution information using different headings, or in a different format, you may edit the material located in the field below.</strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>Record of Distribution</strong></div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <div style="text-align: right">
                <a href="#.php" id="addRowsQ4Link">Add Row</a>
                |
                <a href="#.php" id="removeRowsQ4Link">Remove Row</a>
            </div>
            <table border="0" width="100%">
                <tr style="background: #eee">
                    <td><strong>Title and name of person receiving the plan</strong></td>
                    <td><strong>Agency (school office, government agency, or private-sector entity)</strong></td>
                    <td><strong>Date of delivery</strong></td>
                    <td><strong>Number of copies delivered</strong></td>
                </tr>
                <tr id="thRowQ41" class="thRowQ4">
                    <td><input type="text" name="txtrowq411" id="txtrowq411" /></td>
                    <td><input type="text" name="txtrowq412" id="txtrowq412" /></td>
                    <td><input type="text" name="txtrowq413" id="txtrowq413" class="datePickerWidget"/></td>
                    <td><input type="text" name="txtrowq414" id="txtrowq414" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left">
            <input type="button" value="Save" id="btnsaveform1"/>
        </td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">

    var q3NumRows = ($('.thRowQ3').length);
    var q4NumRows = ($('.thRowQ4').length);

    $( document ).ready( function() {
        $( 'textarea' ).ckeditor();

        $('#dateField').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,//this option for allowing user to select month
            changeYear: true //this option for allowing user to select from year range
        });

        $('.datePickerWidget').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,//this option for allowing user to select month
            changeYear: true //this option for allowing user to select from year range
        });




        $('#addRowsQ3Link').click(function(){
            var numRows = ($('.thRowQ3').length);
            var textBoxCol1Id = "txtrowq3"+(numRows+1)+1;
            var textBoxCol2Id = "txtrowq3"+(numRows+1)+2;
            var textBoxCol3Id = "txtrowq3"+(numRows+1)+3;
            var textBoxCol4Id = "txtrowq3"+(numRows+1)+4;
            var newRow = $("<tr id='thRowQ3"+(numRows+1)+"' class='thRowQ3'><td><input type='text' name='"+textBoxCol1Id+"' id='"+textBoxCol1Id+"'/></td><td><input type='text' name='"+textBoxCol2Id+"' id='"+textBoxCol2Id+"' class='datePickerWidget'/></td><td><input type='text' name='"+textBoxCol3Id+"' id='"+textBoxCol3Id+"'/></td><td><input type='text' name='"+textBoxCol4Id+"' id='"+textBoxCol4Id+"'/></td></tr>");
            $('#thRowQ3'+(numRows)).after(newRow);
            $('#'+textBoxCol2Id).on('click', $('#'+textBoxCol2Id).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true }) );
            q3NumRows++;
            return false;
        });

        $('#removeRowsQ3Link').click(function(){
            var numRows = ($('.thRowQ3').length);
            if(numRows > 1){
                var thRowId = 'thRowQ3'+(numRows);
                $('#'+thRowId).remove();
                q3NumRows--;
            }

            return false;
        });



        $('#addRowsQ4Link').click(function(){
            var numRows = ($('.thRowQ4').length);
            var textBoxCol1Id = "txtrowq4"+(numRows+1)+1;
            var textBoxCol2Id = "txtrowq4"+(numRows+1)+2;
            var textBoxCol3Id = "txtrowq4"+(numRows+1)+3;
            var textBoxCol4Id = "txtrowq4"+(numRows+1)+4;
            var newRow = $("<tr id='thRowQ4"+((numRows)+1)+"' class='thRowQ4'><td><input type='text' name='"+textBoxCol1Id+"' id='"+textBoxCol1Id+"'/></td><td><input type='text' name='"+textBoxCol2Id+"' id='"+textBoxCol2Id+"'/></td><td><input type='text' name='"+textBoxCol3Id+"' id='"+textBoxCol3Id+"' class='datePickerWidget'/></td><td><input type='text' name='"+textBoxCol4Id+"' id='"+textBoxCol4Id+"'/></td></tr>");
            $('#thRowQ4'+(numRows)).after(newRow);
            $('#'+textBoxCol3Id).on('click', $('#'+textBoxCol3Id).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true }) );
            q4NumRows++;
            return false;
        });


        $('#removeRowsQ4Link').click(function(){

            var numRows = ($('.thRowQ4').length);

            if(numRows > 1){
                var thRowId = 'thRowQ4'+(numRows);
                $('#'+thRowId).remove();
                q4NumRows--;
            }
            return false;
        });

        $("#btnsaveform1").click(function(){

            var q3Rows = new Array();
            var q4Rows = new Array();

            for(var i=1; i <= q3NumRows; i++){
                var textBoxCol1Id = "txtrowq3"+i+1;
                var textBoxCol2Id = "txtrowq3"+i+2;
                var textBoxCol3Id = "txtrowq3"+i+3;
                var textBoxCol4Id = "txtrowq3"+i+4;
                //now get the value...
                var textBoxCol1Val = $('#'+textBoxCol1Id).val();
                var textBoxCol2Val = $('#'+textBoxCol2Id).val();
                var textBoxCol3Val = $('#'+textBoxCol3Id).val();
                var textBoxCol4Val = $('#'+textBoxCol4Id).val();

                if(textBoxCol1Val.length>0 || textBoxCol2Val.length>0 || textBoxCol3Val.length>0 || textBoxCol4Val.length>0){
                    q3Rows[i-1] = [textBoxCol1Val, textBoxCol2Val, textBoxCol3Val, textBoxCol4Val];
                }

            }

            for(var i=1; i <= q4NumRows; i++){
                var textBoxCol1Id = "txtrowq4"+i+1;
                var textBoxCol2Id = "txtrowq4"+i+2;
                var textBoxCol3Id = "txtrowq4"+i+3;
                var textBoxCol4Id = "txtrowq4"+i+4;
                //now get the value...
                var textBoxCol1Val = $('#'+textBoxCol1Id).val();
                var textBoxCol2Val = $('#'+textBoxCol2Id).val();
                var textBoxCol3Val = $('#'+textBoxCol3Id).val();
                var textBoxCol4Val = $('#'+textBoxCol4Id).val();
                if(textBoxCol1Val.length>0 || textBoxCol2Val.length>0 || textBoxCol3Val.length>0 || textBoxCol4Val.length>0){
                    q4Rows[i-1] = [textBoxCol1Val, textBoxCol2Val, textBoxCol3Val, textBoxCol4Val];
                }
            }

            var formData ={
                ajax:               '1',
                action:             '<?php echo $action; ?>',
                q3Rows:             q3Rows,
                q4Rows:             q4Rows,
                titleField:         $("#titleField").val(),
                dateField:          $("#dateField").val(),
                schoolsField:       $("#schoolsField").val(),
                promulgationField:  $("#promulgationField").val(),
                approvalField:      $("#approvalField").val()
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageForm1')); ?>',
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

            $("#form1Div").html('');
            return false;
        });

    });
</script>