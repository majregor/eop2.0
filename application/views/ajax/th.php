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
                <td><?php echo $value['']; ?></td>
                <td align="middle">
                    <div align="center">
                        <a href="" id="<?php echo $value['id'];?>" class="editThLink">Edit</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>


<?php
}
?>