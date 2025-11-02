<?php
// session_start();
include 'base.php'; // Ensure this includes database connection

$unpaid_status = 1;
$get_offense = "SELECT * FROM offenses WHERE `status` = $unpaid_status";
$get_offense_req = $conn->query($get_offense);
?>
<br>
<div class="container d-flex justify-content-between">
    <a href="dash" class="text-dark"><u>&larr; Go Back</u></a>
</div>
<h3 class="text-center"><u>Offense Table</u></h3>

<div class="table-container" style="width: 90%; margin: 20px auto;">
    <table id="clientTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Student Name</th>
                <th class="text-center">Registration No.</th>
                <th class="text-center">Book Title</th>
                <th class="text-center">Offense Type</th>
                <th class="text-center">Fines</th>
                <th class="text-center">Status</th>
                <th class="text-center">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($get_offense_req)): ?>
                <tr>
                    <td class="text-center"><?= htmlspecialchars($row['student_name']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row['student_reg_no']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row['book_title']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row['offense_type']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row['fines']); ?></td>
                    <td class="text-center">
                        <?php
                            if($row['status'] == 1){
                                echo '<p href="../backend/active_dash.php?id=' .$row['id'].'&status=0" class="bg-danger p-1 rounded text-light" style="text-decoration:none;">Unpaid <i class="fa fa-info-circle fa-fade"></i></p>';
                            }else{
                                echo '<p href="../backend/active_dash.php?id=' .$row['id'].' &status=1" class="bg-success p-1 rounded text-light" style="text-decoration:none;">Paid <i class="fa fa-check-circle fa-fade"></i></p>';
                            }
                        ?>
                    </td>
                    <td class="text-center"><?= htmlspecialchars($row['offense_date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="sign-out-container">
    <div class="signout-container" id="signoutModalPlay" style="display: none;">
        <div class="signout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2>Sign Out</h2>
        <p>Are you sure you want to sign out?</p>
        <div>
            <a href="../backend/logout class="btn btn-danger me-2">Sign Out</a>
            <a href="#" onclick="closeModal()" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    function signoutModal() {
        document.getElementById("signoutModalPlay").style.display = 'block';
    }

    function closeModal() {
        document.getElementById("signoutModalPlay").style.display = 'none';
    }
</script>
<script>
    $(document).ready(function () {
        $('#clientTable').DataTable();
    });
</script>