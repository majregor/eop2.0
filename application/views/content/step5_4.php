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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>







<table class="resultsFinal">
    <tr>
        <th scope="col">Basic Plan</strong></th>
        <td>


                <table class="filedl">
                    <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">Upload Date</th>
                        <th scope="col">Download</th>
                    </tr>

                        <tr>
                            <td>File name</td>
                            <td>Date uploaded</td>
                            <td>Download</a></td>
                        </tr>

                </table>

        </td>
    </tr>
    <tr class="planOdd">
        <td>1. Introductory Material</td>
        <td align="middle">

            <?php
                $mode = 'add';
                $entityId=null;
                foreach($entities as $entity_key=>$entity){
                    if($entity['name']=='form1') {
                        foreach ($entity['children'] as $child_key => $child) {
                            foreach($child['fields'] as $field){
                                if(isset($field['body']) && !empty($field['body'])){
                                    $entityId = $entity['id'];
                                    $mode='edit';
                                    break 3;
                                }
                            }
                        }
                    }
                }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm1Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm1Link">Edit</a>
            <?php endif; ?>





        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form1Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>2. Purpose, Scope, Situation Overview, and Assumptions</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form2') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm2Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm2Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form2Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>3. Concept of Operations (CONOPS)</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form3') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm3Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm3Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form3Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>4. Organization and Assignment of Responsibilities </td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form4') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm4Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm4Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form4Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>5. Direction, Control, and Coordination</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form5') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm5Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm5Link">Edit</a>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form5Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>6. Information Collection, Analysis, and Dissemination</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form6') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm6Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm6Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form6Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>7. Training and Exercises </td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form7') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm7Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm7Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form7Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>8. Administration, Finance, and Logistics </td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form8') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm8Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm8Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form8Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>9. Plan Development and Maintenance</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form9') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#" class="showAddForm" id="showForm9Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm9Link">Edit</a>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form9Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>10. Authorities and References</td>
        <td align="middle">

            <?php
            $mode = 'add';
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form10') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($mode=='add'): ?>
                <a href="#"class="showAddForm" id="showForm10Link">Add</a>
            <?php else: ?>
                <a href="#" class="showEditForm" id="editForm10Link">Edit</a>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form10Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
</table>


<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/5')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/3')); ?>"); //Previous

    }); // End $(document).ready function

    $(document).on('click', '.showAddForm', function(){

        var clickedBtn = $(this).attr('id');

        if(clickedBtn =='showForm1Link'){
            openForm1('add');
        }else if(clickedBtn=='showForm2Link'){

        }


    }); // End click event for add forms

    $(document).on('click', '.showEditForm', function(){
        var clickedBtn = $(this).attr('id');

        if(clickedBtn == 'editForm1Link'){
            selectedEntityId = $(this).attr('data-entity-id');

            openForm1('edit', selectedEntityId)
        }
    });

    function openForm1(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form1Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm1Ctls')); ?>',
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
    }

</script>
