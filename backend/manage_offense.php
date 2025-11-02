<?php
    $get_offense_query = "SELECT * FROM offenses ORDER BY `id` DESC";
    $get_offense_req = $conn->query($get_offense_query);
?>
<h3 class="text-center"><u>Offense Table</u></h3>
<table id="clientTable" class="display editable" style="width:100%">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Student Reg. Number</th>
            <th>Book Title</th>
            <th>Offense Type</th>
            <th>Fines</th>
            <th>Status</th>
            <th>Report</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($response = $get_offense_req->fetch_assoc()) { ?>
        <tr>
            <td><?= $response['student_name']; ?></td>
            <td><?= $response['student_reg_no']; ?></td>
            <td><?= $response['book_title']; ?></td>
            <td><?= $response['offense_type']; ?></td>
            <td><?= $response['fines']; ?></td>
            <td>
        <?php
            if($response['status'] == 1){
                echo '<a href="../backend/active_offense.php?id=' .$response['id'].'&status=0" class="bg-danger p-1 rounded text-light" style="text-decoration:none;">Unpaid <i class="fa fa-info-circle fa-fade"></i></a>';
            }else{
                echo '<a href="../backend/active_offense.php?id=' .$response['id'].' &status=1" class="bg-success p-1 rounded text-light" style="text-decoration:none;">Paid <i class="fa fa-check"></i></a>';
            }
        ?>
            </td>
            <td>
                <a href="../backend/report.php?report=<?= $response['id']; ?>" class="fa fa-info-circle bg-info p-2 rounded text-light" style="text-decoration:none;"></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
