<?php
$entities = $page_vars['entities'];
?>
<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 5-4</h1>
        <h1>Prepare the Draft EOP: Basic Plan</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_4"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>


<div class="col-half left">
    <p>Your planning team will begin developing a draft of the school EOP with the Basic Plan section. The Basic Plan section provides an overview of the school’s approach to emergency operations and often consists of several subsections, as listed below. You may manually create the Basic Plan section by clicking the Add button for each of the subsections below and then following the directions for that subsection. If you are modifying previously saved subsections, please click the Edit button for the corresponding subsection.</p>
    <p>If your school or district already has an up-to-date Basic Plan section (provided as a Microsoft Word document), you may upload the Basic Plan into EOP ASSIST. In order to integrate it into your school EOP, you will need to manually cut and paste this section into the downloaded school EOP found in the <a href="report_static.php" target="_blank" >My EOP</a> feature. To upload your Basic Plan section, click the Browse button below and select the appropriate file. After the page is refreshed, your uploaded Basic Plan will be found in the first row of the table below. Only one uploaded Basic Plan section will be saved in EOP ASSIST at a time and must be separately downloaded from this page and inserted each time the school EOP is downloaded.<br />
    </p>
</div>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1>Add/Edit Goals and Objectives for Functions</h1>
    <div id="goalFirstDivToRefresh">
        <table class="results">
            <tr>
                <th scope="col">Functions</th>
                <th scope="col">Goals and Objectives</th>
            </tr>
            <?php foreach($entities as $key=>$value): ?>
                <tr>
                    <td><?php echo $value['name']; ?></td>
                    <td align="center">
                        <?php if(isset($value['children']) && count($value['children'])>0): ?>
                            <a href="#" id="<?php echo $value['id'];?>" class="editFieldsLink">Edit</a>
                        <?php else: ?>
                            <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink">Add</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="fieldsContainer" id="container-<?php echo $value['id'];?>"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/2')); ?>"); //Previous

        $("#rightArrowButton").click(function(){


        });

        $(".addFieldsLink").click(function(){

             selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add',
                showActions: '1'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });

        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit',
                showActions: '1'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });

            $(divContainer).html('');
            return false;
        });


        //@todo Make courses of action saveable at this step
        $(document).on('click','#saveBtn', function(){

            <?php for($i=1; $i<=3; $i++): ?>

            //New Data
                var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#g1txt');
            var g2TxtCtl = $('#g2txt');
            var g3TxtCtl = $('#g3txt');


            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'save',
                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,
                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val()
            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        alert(response);

                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            $("#container-"+selectedId).html('');
            return false;
        });

        $(document).on('click','#updateBtn', function(){

            <?php for($i=1; $i<=3; $i++): ?>


            var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).val()];
            });
            var g<?php echo($i);?>ObjDataIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-id')];
            });
            var g<?php echo($i);?>ObjFieldIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-field-id')];
            });

            //New Data
            var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                return [$(value).val()];
            });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');

            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'update',
                g1ObjDataNew:  g1ObjDataNew,
                g2ObjDataNew:  g2ObjDataNew,
                g3ObjDataNew:  g3ObjDataNew,

                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val(),

                g1Id:       g1TxtCtl.attr('data-id'),
                g2Id:       g2TxtCtl.attr('data-id'),
                g3Id:       g3TxtCtl.attr('data-id'),

                g1FieldId:  g1TxtCtl.attr('data-field-id'),
                g2FieldId:  g2TxtCtl.attr('data-field-id'),
                g3FieldId:  g3TxtCtl.attr('data-field-id'),

                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,

                g1ObjIds:   g1ObjDataIds,
                g2ObjIds:   g2ObjDataIds,
                g3ObjIds:   g3ObjDataIds,

                g1ObjFieldIds: g1ObjFieldIds,
                g2ObjFieldIds: g2ObjFieldIds,
                g3ObjFieldIds: g3ObjFieldIds

            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){

                    try{
                        alert(response);

                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            $("#container-"+selectedId).html('');
            return false;
        });

    }); // End $(document).ready function

</script>
