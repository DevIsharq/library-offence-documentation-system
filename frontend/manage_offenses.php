<?php
include 'base.php';
include "../backend/offense_handler.php";
?>
    <br>
    <div class="container d-flex justify-content-between">
        <a href="dash"  class="text-dark"><u>&larr; Go Back</u></a>
        <div class="d-flex justify-content-between">
            <p class="btn btn-primary" id="open-modal-btn">Add Offense <i class="fa fa-info-circle fa-fade fa-beat"></i></p>&nbsp;
            <p><a href="#" class="btn btn-primary"><i class="fa fa-refresh fa-spin"></i></a></p>
        </div>
    </div>
    <div class="table-container" style="width: 90%; margin: 20px auto;">
       <?php
        include '../backend/manage_offense.php';
       ?>
    </div>

    <div class="sign-out-container">
    <div class="signout-container" id="signoutModalPlay">
      <div class="signout-icon">
        <i class="fas fa-sign-out-alt"></i>
      </div>
      <h2>Sign Out</h2>
      <p>Are you sure you want to sign out?</p>
      <div>
        <a href="../backend/logout" class="btn btn-danger me-2">Sign Out</a>
        <a href="" class="btn btn-secondary">Cancel</a>
      </div>
    </div>
  </div>

  <div class="modal-overlay" id="modal">
    <div class="modal-content">
      <span class="close-btn" id="close-modal-btn">&times;</span>
      <h3>Add Offense</h3>
                  <!-- Display success or error messages -->
                  <?php 
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                    }
                ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Student Name:</label>
                    <!-- <input type="text" class="form-control" id="title" name="" placeholder="Enter Student Name" required> -->
                    <select name="student_name" class="form-select" id="bT" require>
                        <option value="#" disabled selected>--- Select Student Name ---</option>
                            <?php
                                $get_student_name = 'name';
                                $get_student_req = "SELECT * FROM users WHERE `name` = $get_student_name";
                                $get_student_res = $conn->query($get_student_req);
                                while($get_result = mysqli_fetch_assoc($get_student_res)):?>
                                    <option value="<?= $get_result['name']; ?>"><?= $get_result['name']; ?></option>
                                <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Student Reg. Number:</label>
                    <!-- <input type="text" class="form-control" id="author" name="" placeholder="Enter Student Reg. Number" required> -->
                    <select name="student_reg_no" class="form-select" id="bT" require>
                        <option value="#" disabled selected>--- Select Student Reg. Number ---</option>
                        <?php
                            $get_student_reg_no = 'phone';
                            $get_student_reg_no_req = "SELECT * FROM users WHERE `phone` = $get_student_reg_no";
                            $get_student_reg_no_res = $conn->query($get_student_reg_no_req);
                            while($get_student_reg_no_result = mysqli_fetch_assoc($get_student_reg_no_res)):?>
                            <option value="<?= $get_student_reg_no_result['phone']; ?>"><?= $get_student_reg_no_result['phone']; ?></option>
                            <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Offense Type:</label>
                    <select name="offense_type" class="form-select" id="bT" require>
                        <option value="selected" disabled selected>--- Select Offense Type ---</option>
                        <option value="overdue">Overdue</option>
                        <option value="book Damage">Book Damage</option>
                        <option value="book Lost">Book Lost</option>
                        <option value="Noice">Noise and disturbance</option>
                        <option value="Eating Food">Food and Drink violation</option>
                        <option value="Phone Call">Phone Call</option>
                        <option value="Book Theft">Book Theft</option>
                    </select>

                </div>
                <div class="mb-3">
                    <label for="bt" class="form-label">Book Title:</label>
                    <select name="book_title" class="form-select" id="bT" require>
                        <option value="---">--- Select Book Title ---</option>
                        <?php
                            $get_books_title = 'title';
                            $get_books = "SELECT * FROM books WHERE `title` = $get_books_title";
                            $get_books_req = $conn->query($get_books);
                            
                            while($books_res = mysqli_fetch_assoc($get_books_req)):
                        ?>
                        <option value="<?= $books_res['title']; ?>"><?= $books_res['title']; ?></option>

                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Fines:</label>
                    <input type="text" class="form-control" id="pYear" name="fines" placeholder="Enter Fines" required>
                </div>
                <button type="submit" name="add_offense_btn" class="btn btn-primary w-100">Proceed to Add</button>
            </form>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="./js/script.js"></script>

<script>
    function signoutModal() {
        document.getElementById("signoutModalPlay").style.display = 'block';
    }
</script>
<script>
    $(document).ready(function () {
        $('#clientTable').DataTable();
    });
    </script>
</body>
</html>