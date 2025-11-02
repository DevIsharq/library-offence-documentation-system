<?php
include 'base.php';
include "../backend/register_handler.php";
?>
    <br>
    <div class="container d-flex justify-content-between">
        <a href="dash"  class="text-dark"><u>&larr; Go Back</u></a>
        <p class="btn btn-primary" id="open-modal-btn">Add <i class="fa fa-user-plus fa-fade fa-beat"></i></p>
    </div>
    <div class="table-container" style="width: 90%; margin: 20px auto;">
        <?php
            include '../backend/manage_users.php';
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
      <h3>Add User</h3>
                  <!-- Display success or error messages -->
                  <?php
            // session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Full Name" required>
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Reg. Number:</label>
                    <input type="text" class="form-control" id="number" name="phone" placeholder="Enter Your Phone Number" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Example@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter Your Password" required>
                </div>
                <div class="mb-3">
                    <!-- <label for="role" class="form-label">Role</label> -->
                    <input type="hidden" class="form-control" value="student" id="name" name="role" required>
                </div>
                <button type="submit" name="reg_btn_add" class="btn btn-primary w-100">Add</button>
                <!-- <p class="mt-3 text-center">
                    Already have an account? <a href="login.php">Login</a>
                </p> -->
            </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script src="./js/script.js"></script>

<script>
    const modalUpdate = document.getElementById("modal-update");
const openModalBtnUpdate = document.getElementById("open-modal-update");
const closeModalBtnUpdate = document.getElementById("close-modal-update");

openModalBtnUpdate.addEventListener("click", () => {
  modalUpdate.style.display = "flex";
});

closeModalBtnUpdate.addEventListener("click", () => {
  modalUpdate.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === modalUpdate) {
    modalUpdate.style.display = "none";
  }
});
</script>
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