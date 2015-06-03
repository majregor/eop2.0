<?php
echo form_open('team/update', array('class'=>'updateTeamForm', 'id'=>'updateTeamForm'));
?>
<input type="hidden" id="updateid" name="updateid"/>
    <fieldset>

        <table>
            <tr>
                <td class="txtb">Name:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtname',
                        'id'        =>  'updatetxtname',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Title:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxttitle',
                        'id'        =>  'updatetxttitle',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Organization:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtorganization',
                        'id'        =>  'updatetxtorganization',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Email:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtemail',
                        'id'        =>  'updatetxtemail',
                        'required'  =>  'required',
                        'minlength' =>  '3',
                        'type'      =>  'email',
                        'size'      =>  '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Phone:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtphone',
                        'id'        =>  'updatetxtphone',
                        'size'      =>  '50',
                        'type'      =>  'tel'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Stakeholder Category:</td>
                <td>
                    <table class="sctable">
                        <tr>
                            <td>
                                <?php
                                    $inputAttributes = array(
                                        'name'      =>  'updateinterests[]',
                                        'value'     =>  'School District/LEA',
                                        'checked'   =>  FALSE,
                                        'class'     =>  'updateinterestChkBox'
                                    );
                                echo form_checkbox($inputAttributes);
                                ?>
                                School District/LEA
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'School Community',
                                    'checked'   =>  FALSE,
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                School Community
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <?php
                            $inputAttributes = array(
                                'name'      =>  'updateinterests[]',
                                'value'     =>  'Diverse Interests of Whole School Community',
                                'checked'   =>  FALSE,
                                'class'     =>  'updateinterestChkBox'
                            );
                            echo form_checkbox($inputAttributes);
                            ?>
                            Diverse Interests of Whole School Community
                        </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'Local Community Partner',
                                    'checked'   =>  FALSE,
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                Local Community Partner
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'State Department of Education/SEA',
                                    'checked'   =>  FALSE,
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                State Department of Education/SEA
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'State Community Partner',
                                    'checked'   =>  FALSE,
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                State Community Partner
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'Additional Partner',
                                    'checked'   =>  FALSE,
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                Additional Partner
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    <?php
                    $attributes = array(
                        'name'  =>  'updatebtnsave',
                        'value' =>  'Save',
                        'id'    =>  'updatebtnsave',
                        'style' =>  ''
                    );
                    ?>
                    <?php echo form_submit($attributes); ?>
                </td>
            </tr>
        </table>
    </fieldset>
<?php
echo form_close();
?>