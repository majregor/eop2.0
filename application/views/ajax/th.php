<?php
/**
 * ajax view lists available Threats and Hazards in a table form
 * variable returned by controller: $thData
 * 
 */
if(isset($thData) && is_array($thData) && count($thData)>0) {
    ?>


    <table class="results">
        <tr>
            <th scope="col">Threats and Hazards</th>
            <th scope="col"></th>
        </tr>
        <?php foreach ($thData as $key => $value): ?>

            <tr>
                <td><?php echo $value['name']; ?></td>
                <td align="middle">
                    <div align="center">
                        <a href="" class="editThLink"
                            id="<?php echo $value['id'];?>"
                            data-name="<?php echo $value['name']; ?>" >
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <div id="update-th-dialog" title="Edit Threat & Hazard">
        <?php $this->load->view('forms/update_th'); ?>
    </div>

<?php
}
?>
<script>
    $(document).ready(function(){

        $("#update-th-dialog").dialog({
            resizable:      false,
            minHeight:      200,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

        $("#updateThForm").validate({

        });


        $('.editThLink').click(function(){

            selectedId = $(this).attr('id');

            $('#updateid').val(selectedId);
            $('#updatetxtname').val($(this).attr('data-name'));

            $("#update-th-dialog").dialog('open');
            return false;
        });

    });

</script>