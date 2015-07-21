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

    <tr>
        <td><a href="<?php echo("/uploads/".$fileData['file_name']);?>" target="_blank"><?php echo($fileData['file_name']);?></a></td>
        <td><?php echo(date("F d Y H:i:s", filemtime($fileData['full_path'])));?></td>
        <td><a href="<?php echo($fileData['full_path']);?>" target="_blank">Download</a></a></td>
    </tr>

</table>

<script>
    $(document).ready(function(){


    });

</script>