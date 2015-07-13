<div id="topcontain">
    <div id="titlearea">
        <h1 id='currentPageTag'>Step 3-2</h1>
        <h1>Select Threats and Hazards to Address in the School EOP</h1>
        <h3></h3>
    </div>
    <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_2"><img src="<?php echo base_url(); ?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>
</div>
<div class="col-half left">
    <p>Your  team&rsquo;s first task is to review the prioritized list of threats and hazards from  Step 2 and to select the threats and hazards that your planning team chooses to  address in the school EOP. These selected threats and hazards will be carried  forward in the remaining steps of the planning process. </p>

    <p>The table below contains a summary of the threats and hazards that your planning team identified, assessed for risk, and prioritized in Step 2. Please review this content carefully to determine which threats and hazards your team will address in your school EOP. If your team needs to make any adjustments to the threats and hazards included in this table, those adjustments should be made in Step 2. Once your team has decided which threats and hazards will be addressed in the plan, you should place a checkmark in the indicated space for each selected threat and hazard.</p>
</div><!-- /col-half --><!-- /col-half -->

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css" />
     <h1>Select Threats and Hazards to Address in the School EOP</a></h1>
    <div id="selectCheckBoxDiv">
        <table class="results">
            <tr>
                <th scope="col">Threats and Hazards</th>
                <th scope="col">Address in the School EOP</th>
            </tr>
            <?php foreach($page_vars['entities'] as $key=>$value): ?>
                <tr>
                    <td><?php echo $value['name']; ?></td>
                    <td align="center">
                        <?php

                                $attr = ($value['description'] == 'live' ) ? "checked='checked'": "";

                        ?>
                        <input type="checkbox" class="checkBoxSelection" <?php echo $attr; ?> name="<?php echo $value['id'];?>" id="<?php echo $value['id'];?>" value="<?php echo $value['id']; ?>"/>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/1')); ?>"); //Previous

        $("#rightArrowButton").click(function(){

            var data = $.map($("input:checkbox.checkBoxSelection:checked"), function(value, index) {
                return [$(value).val()];
            });

            setSelectedThs(data);
            //return false;
        });

        $(".checkBoxSelection").change(function(){
            var value = null;
            var THid = $(this).val();

            if($(this).is(":checked")){
                value = 1;
            }
            else{
                value = 0;
            }

            updateSelectedTh(THid, value);
        });

        function updateSelectedTh(id, value){
            var formData = {
                'ajax'  :       '1',
                'THid' :       id,
                'value':    value
            }

            $.ajax({
                url: '<?php echo(base_url('plan/updateSelectedTH')); ?>',
                data: formData,
                type:'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                success:function(response){
                    try{
                        var res = JSON.parse(response);
                        if(res.set==true){
                            //alert(response);
                        }
                        else{
                            alert("No Threats and Hazards Selected");
                        }
                    }
                    catch(err){
                        //alert("Remote Server error! " + err.message);
                    }
                }
            });
        }

        function setSelectedThs(data){

            var formData = {
                'ajax'  :       '1',
                'THids' :       data
            }

            $.ajax({
                url: '<?php echo(base_url('plan/setSelectedTHs')); ?>',
                data: formData,
                type:'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                success:function(response){
                    try{
                        var res = JSON.parse(response);
                         if(res.set==true){
                             //alert(response);
                         }
                         else{
                            alert("No Threats and Hazards Selected");
                         }
                    }
                    catch(err){
                        //alert("Remote Server error! " + err.message);
                    }
                }
            });
        }


    }); // End $(document).ready function

</script>
