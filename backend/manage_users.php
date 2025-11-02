
<?php
    include '../backend/connection.php';
?>
<h3 class="text-center"><u>Manage Users</u></h3>
<table id="clientTable" class="display" style="width:100%;">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Full Name</th>
            <th class="text-center">Phone Number</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sn = 1;
            $user_role = 'student';
            $get_users = "SELECT * FROM users WHERE `role` = '$user_role' ORDER BY id DESC";
            $result = $conn->query($get_users);
            while($row_data = mysqli_fetch_assoc($result)):?>
        <tr>
            <td class="text-center"><?= $sn++; ?></td>
            <td class="text-center"><?= $row_data['name']; ?></td>
            <td class="text-center"><?= $row_data['phone']; ?></td>
            <td class="text-center"><?= $row_data['email']; ?></td>
            <td class="text-center"><?= $row_data['role']; ?></td>
            <td class="text-center">
                <span><a href="../frontend/reg?edit=<?= $row_data['id']; ?>" class="btn btn-primary"><i class="fa fa-edit text-light rounded-circle p-2"></i></a></span>&nbsp;&nbsp;
                <span><a href="../actions/del?del=<?= $row_data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash text-light rounded-circle p-2"></i></a></span>
            </td>
        </tr>
        <?php
            endwhile;
        ?>
    </tbody>
</table>