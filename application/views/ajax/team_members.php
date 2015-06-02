<?php
/**
 * ajax view lists team members in a table form
 * variable returned by controller: $memberData
 */
?>
<table class="teamresult">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Title</th>
        <th scope="col">Organization</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Stakeholder Category</th>
        <th colspan="2"></th>
    </tr>
<?php foreach($memberData as $key=>$value): ?>
    <tr>
        <td scope="col"><?php echo $value['name']; ?></td>
        <td scope="col"><?php echo $value['title']; ?></td>
        <td scope="col"><?php echo $value['organization']; ?></td>
        <td scope="col"><?php echo $value['email']; ?></td>
        <td scope="col"><?php echo $value['phone']; ?></td>
        <td scope="col"><?php echo $value['interest']; ?></td>
        <td scope="col" width="8%" align="middle">
            <a href="" class="teamEditLink" id="<?php echo $value['id']; ?>">Edit</a>
        </td>
        <td scope="col" width="8%" align="middle">
            <a href="" class="teamDeleteLink" id="<?php echo $value['id']; ?>">Delete</a>
        </td>

    </tr>
<?php endforeach; ?>
</table>