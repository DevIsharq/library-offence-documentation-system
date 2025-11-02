<?php 
    include "../frontend/base.php";
    include "./connection.php";
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    section {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
        padding: 20px;
    }

    .report-container {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 60%;
        max-width: 700px;
        text-align: left;
    }

    .report-container h3 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #333;
        font-weight: bold;
    }

    .report-container span {
        display: block;
        font-size: 16px;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 1px dashed #ccc;
        padding-bottom: 5px;
    }

    .status-unpaid {
        color: red;
        font-weight: bold;
    }

    .status-paid {
        color: green;
        font-weight: bold;
    }

    .print-btn {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .print-btn button {
        background: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .print-btn button:hover {
        background: #0056b3;
    }

    @media print {
        .print-btn {
            display: none;
        }
        .report-container {
            box-shadow: none;
            border: 1px solid #ccc;
        }
    }
</style>

<section>
    <?php
        if (isset($_GET['report'])) {
            $id = mysqli_real_escape_string($conn, $_GET['report']);
            $get_report = "SELECT * FROM offenses WHERE `id` = $id";
            $con_get_report = $conn->query($get_report);
        }
    ?>

    <?php if ($report = mysqli_fetch_assoc($con_get_report)): ?>
        <div class="report-container">
            <h3>Student Name:</h3> <span><?= htmlspecialchars($report['student_name']); ?></span>
            <h3>Student Reg. Number:</h3> <span><?= htmlspecialchars($report['student_reg_no']); ?></span>
            <h3>Book Title:</h3> <span><?= htmlspecialchars($report['book_title']); ?></span>
            <h3>Offense Type:</h3> <span><?= htmlspecialchars($report['offense_type']); ?></span>
            <h3>Fines:</h3> <span><?= htmlspecialchars($report['fines']); ?></span>
            <h3>Status:</h3> 
            <span>
                <?= $report['status'] == 1 ? 'Unpaid' : 'Paid'; ?>
            </span>
            <h3>Offense Date:</h3> <span><?= htmlspecialchars($report['offense_date']); ?></span>
        </div>
    <?php else: ?>
        <p>No report found.</p>
    <?php endif; ?>
</section>

<div class="print-btn">
    <button onclick="printReport()">Print</button>
</div>

<script>
    function printReport() {
        document.querySelector(".print-btn").style.display = "none";
        window.print();
        document.querySelector(".print-btn").style.display = "flex";
    }
</script>

</html>
</body>