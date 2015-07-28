<?php
/**
 * ajax view uploaded files
 * 
 */
//print_r($fileData);
?>


<table class="filedl">
    <tr>
        <th scope="col">File Name</th>
        <th scope="col">Upload Date</th>
        <th scope="col">Download</th>
    </tr>
    <?php if(isset($fileData['file_name']) && !empty($fileData['file_name'])): ?>
        <tr>
            <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['file_name']);?>" target="_blank"><?php echo($fileData['file_name']);?></a></td>
            <td><?php echo(date("F d Y H:i:s", filemtime($fileData['full_path'])));?></td>
            <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['file_name']);?>" target="_blank">Download</a></a></td>
        </tr>
    <?php endif; ?>

</table>

<script>
    $(document).ready(function(){


    });

</script>