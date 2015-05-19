<?php
/**
 *  School Management Form
 *
 * Displays form for adding and editing schools.
 *
 */
?>

<h1>Create User</h1>
<?php
    echo form_open('school/add', array('class'=>'school_form', 'id'=>'school_form'));
?>
    <div id="errorDiv"></div>
    <table border="1" width="100%" rules="all" >
        <tr>
            <td width="15%"><span class="required">*</span> School Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'school_name',
                    'id'        =>  'school_name',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '70'
                );
                echo form_input($inputAttributes);
                ?>

            </td>
        </tr>
        <tr>
            <td> Screen Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'screen_name',
                    'id'        =>  'screen_name',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        
        <?php if($role['create_district']=='y'): ?>
            <tr id="districtRow">
                <td><span class="required">*</span>District:</td>
                <td>
                  <?php
                        $options = array();
                        $options['empty'] = '--Select--';
                        $options['']    =   'None';
                        foreach($districts as $rowIndex => $row){
                            $options[$row['id']] = $row['name'];
                        }

                        $otherAttributes = 'id="sltdistrict" style=""';
                        reset($options);
                        $first_key = key($options);
                        echo form_dropdown('sltdistrict', $options, "$first_key", $otherAttributes);
                    ?>

                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'school_form_submit',
                    'value' =>  'Save',
                    'id'    =>  'school_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

            </td>
        </tr>
    </table>
<?php
echo form_close();
?>