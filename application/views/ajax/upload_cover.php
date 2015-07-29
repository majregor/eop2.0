<?php
/**
 * ajax view uploaded files
 * 
 */
//print_r($fileData);
?>

<?php if(isset($fileData['cover']['file_name']) && !empty($fileData['cover']['file_name'])): ?>
    <table class="filedl">
        <tr>
            <th scope="col">File Name</th>
            <th scope="col">Upload Date</th>
            <th scope="col">Download</th>
        </tr>
            <tr>
                <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['cover']['file_name']);?>" target="_blank"><?php echo($fileData['cover']['file_name']);?></a></td>
                <td><?php echo(date("F d Y H:i:s", filemtime($fileData['cover']['full_path'])));?></td>
                <td><a href="<?php echo(base_url("/uploads/")."/".$fileData['cover']['file_name']);?>" target="_blank">Download</a></a></td>
            </tr>
    </table>
<?php endif; ?>

<script>
    $(document).ready(function(){


    });

</script>