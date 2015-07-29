<?php
/**
 * ajax view uploaded files
 * 
 */
//print_r($fileData);
?>

<?php if(isset($fileData['main']['file_name']) && !empty($fileData['main']['file_name'])): ?>
    <table class="filedl">
        <tr>
            <th scope="col">File Name</th>
            <th scope="col">Upload Date</th>
            <th scope="col">Download</th>
        </tr>
            <tr>
                <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['main']['file_name']);?>" target="_blank"><?php echo($fileData['main']['file_name']);?></a></td>
                <td><?php echo(date("F d Y H:i:s", filemtime($fileData['main']['full_path'])));?></td>
                <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['main']['file_name']);?>" target="_blank">Download</a></a></td>
            </tr>
    </table>
<?php endif; ?>

<script>
    $(document).ready(function(){


    });

</script>