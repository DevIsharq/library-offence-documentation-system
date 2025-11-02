<?php
include 'base.php';
include "../backend/book_handler.php";
?>
    <br>
    <div class="container d-flex justify-content-between">
        <a href="dash"  class="text-dark"><u>&larr; Go Back</u></a>
        <p class="btn btn-primary" id="open-modal-btn">Add Book <i class="fa fa-book fa-fade fa-beat"></i></p>
    </div>
    <div class="table-container" style="width: 90%; margin: 20px auto;">
       <?php
        include '../backend/manage_books.php';
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
      <h3>Add Books</h3>
                  <!-- Display success or error messages -->
                  <?php 
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']); // Remove error message after displaying
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']); // Remove success message after displaying
                    }
                ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Book Title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Book Author:</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Book Author" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">International Standard Book Number(isbn):</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" placeholder="123456" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Publication Year:</label>
                    <input type="number" class="form-control" id="pYear" name="publication_year" maxlength="4" placeholder="Enter Publication Year" required>
                </div>
                <div class="mb-3">
                    <label for="total_copies" class="form-label">Total Copies:</label>
                    <input type="number" class="form-control" id="total_copies" name="total_copies" placeholder="Enter total_copies" required>
                </div>
                <div class="mb-3">
                    <label for="available_copies" class="form-label">Available Copies:</label>
                    <input type="number" class="form-control" id="available_copies" name="available_copies" placeholder="Enter Available Copies" required>
                </div>
                <button type="submit" name="book_reg" class="btn btn-primary w-100">Proceed to Add</button>
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