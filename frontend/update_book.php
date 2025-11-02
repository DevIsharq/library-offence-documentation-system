<?php
include 'base.php';
include "../backend/book_handler.php";

    $title = "";
    $author = "";
    $isbn = "";
    $publication_year = "";
    $total_copies = "";
    $available_copies = "";

    include "../actions/edit.php";

    if($update == true) {
        $id = mysqli_real_escape_string($conn, $book_res['id']);
        $title = mysqli_real_escape_string($conn, $book_res['title']);
        $author = mysqli_real_escape_string($conn, $book_res['author']);
        $isbn = mysqli_real_escape_string($conn, $book_res['isbn']);
        $publication_year = mysqli_real_escape_string($conn, $book_res['publication_year']);
        $total_copies = mysqli_real_escape_string($conn, $book_res['total_copies']);
        $available_copies = mysqli_real_escape_string($conn, $book_res['available_copies']);
    }

?>
    <br>
    <div class="container d-flex justify-content-between">
        <a href="manage_books"  class="text-dark"><u>&larr; Go Back</u></a>
        <!-- <p class="btn btn-primary" id="open-modal-btn">Add Book <i class="fa fa-book fa-fade fa-beat"></i></p> -->
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

  <div class="d-flex justify-content-center">
    <div class="modal-content" style="margin-top: -7rem;">
      <h3>Update Books</h3>
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
                    <!-- <label for="title" class="form-label">Book Title:</label> -->
                    <input type="hidden" class="form-control" id="title" name="id" value="<?= $id ?>">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" placeholder="Enter Book Title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Book Author:</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?= $author ?>" placeholder="Enter Book Author" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">International Standard Book Number(isbn):</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" value="<?= $isbn ?>" placeholder="123456" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Publication Year:</label>
                    <input type="number" class="form-control" id="pYear" name="publication_year" value="<?= $publication_year ?>" maxlength="4" placeholder="Enter Publication Year" required>
                </div>
                <div class="mb-3">
                    <label for="total_copies" class="form-label">Total Copies:</label>
                    <input type="number" class="form-control" id="total_copies" name="total_copies" value="<?= $total_copies ?>" placeholder="Enter total_copies" required>
                </div>
                <div class="mb-3">
                    <label for="available_copies" class="form-label">Available Copies:</label>
                    <input type="number" class="form-control" id="available_copies" name="available_copies" value="<?= $available_copies ?>" placeholder="Enter Available Copies" required>
                </div>
                <button type="submit" name="update_book_btn" class="btn btn-primary w-100">Proceed to Update</button>
            </form>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- <script src="./js/script.js"></script> -->

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