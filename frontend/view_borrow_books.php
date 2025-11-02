<?php
    include 'base.php';
?>
    <br>
    <div class="container d-flex justify-content-between">
        <a href="dash"  class="text-dark"><u>&larr; Go Back</u></a>
        <p class="btn btn-primary" id="openModalBtnAddBorrow">Add Borrow <i class="fa fa-book fa-fade fa-beat"></i></p>
    </div>
    <h3 class="text-center"><u>Borrow Books Here</u></h3>
    <div class="table-container" style="width: 90%; margin: 20px auto;">
        <table id="clientTable" class="display" style="width:100%">
        <thead>
        <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Student Reg. Number</th>
                <th class="text-center">Book Title</th>
                <th class="text-center">Author</th>
                <th class="text-center">ISBN</th>
                <th class="text-center">Publication Year</th>
                <th class="text-center">Borrow Date</th>
                <th class="text-center">Return Date</th>
                <th class="text-center">Action</th>
                <!-- <th class="text-center">Status</th> -->
            </tr>
        </thead>
        <tbody>

<?php
    $sn = 1;
    $get_borrow = "SELECT * FROM add_borrow ORDER BY id DESC";
    $req = $conn->query($get_borrow);
    while($borrow = mysqli_fetch_assoc($req)):
?>

<tr>
    <td class="text-center"><?= $sn++ ?></td>
    <td class="text-center"><?= $borrow['student_name']; ?></td>
    <td class="text-center"><?= $borrow['student_reg_no']; ?></td>
    <td class="text-center"><?= $borrow['book_id']; ?></td>
    <td class="text-center"><?= $borrow['author']; ?></td>
    <td class="text-center"><?= $borrow['isbn']; ?></td>
    <td class="text-center"><?= $borrow['publication_year']; ?></td>
    <td class="text-center"><?= $borrow['borrow_date']; ?></td>
    <td class="text-center"><?= $borrow['return_date']; ?></td>
    <td class="text-center">
        <?php
            if($borrow['action'] == 1){
                echo '<a href="../backend/active_borrow_action.php?id=' .$borrow['id'].'&action=0" class="bg-secondary p-1 rounded text-light" style="text-decoration:none;">Pending <i class="fa fa-refresh fa-spin"></i></a>';
            }else{
                echo '<a href="../backend/active_borrow_action.php?id=' .$borrow['id'].' &action=1" class="bg-primary p-1 rounded text-light" style="text-decoration:none;">Returned <i class="fa fa-check"></i></a>';
            }
        ?>
    </td>
    
</tr>

<?php endwhile; ?>
</tbody>
        </table>
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


  <style>
    .modal-overlayBorrow {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* display: flex; */
    justify-content: center;
    align-items: center;
}

.modal-contentBorrow {
    position: relative;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: popIn 0.8s ease-in-out;
}

.close-btnBorrow {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
}
  </style>

  <div class="modal-overlayBorrow" id="modalBorrow">
        <div class="modal-contentBorrow">
          <span class="close-btnBorrow" id="close-modal-btn-add-borrow">&times;</span>
          <h3>Add Borrow</h3>
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
    
    <!-- add borrow form -->

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="borrower_name" class="form-label">Student Name:</label>
                        <select name="student_name" class="form-select" id="bT" require>
                        <option value="#" disabled selected>--- Select Student Name ---</option>
                        <?php
                            $get_student_reg_no = 'name';
                            $get_student_reg_no_req = "SELECT * FROM users WHERE `name` = $get_student_reg_no";
                            $get_student_reg_no_res = $conn->query($get_student_reg_no_req);
                            while($get_student_reg_no_result = mysqli_fetch_assoc($get_student_reg_no_res)):?>
                            <option value="<?= $get_student_reg_no_result['name']; ?>"><?= $get_student_reg_no_result['name']; ?></option>
                            <?php endwhile; ?>
                    </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="borrower_name" class="form-label">Student Reg. Number:</label>
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

                    <?php
                        // Fetch book titles
                        $sql_get_book_status = 1;
                        $sql_get_book = "SELECT * FROM books WHERE `status` = $sql_get_book_status";
                        $result_get_book = $conn->query($sql_get_book);
                    ?>

                    <div class="mb-3">
                        <label for="book_id" class="form-label">Select Book:</label>
                        <select class="form-select" id="book_id" name="book_id" required onchange="fetchBookDetails()">
                            <option value="">-- Select Book --</option>
                            <?php while ($row = $result_get_book->fetch_assoc()) { ?>
                                <option value="<?= $row['title']; ?>"><?= $row['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Book Author:</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="Book Author" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN (International Standard Book Number):</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="pYear" class="form-label">Publication Year:</label>
                        <input type="text" class="form-control" id="pYear" name="publication_year" placeholder="Publication Year" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="borrow_date" class="form-label">Borrow Date:</label>
                        <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="return_date" class="form-label">Return Date:</label>
                        <input type="date" class="form-control" id="return_date" name="return_date" required>
                    </div>

                    <button type="submit" name="add_borrow" class="btn btn-primary w-100">Confirm Borrow</button>
                </form>
             <!-- add borrow form -->
              <?php

                if(isset($_POST['add_borrow'])) {
                    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
                    $student_reg_no = mysqli_real_escape_string($conn, $_POST['student_reg_no']);
                    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
                    $author = mysqli_real_escape_string($conn, $_POST['author']);
                    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
                    $publication_year = mysqli_escape_string($conn, $_POST['publication_year']);
                    $borrow_date = mysqli_real_escape_string($conn, $_POST['borrow_date']);
                    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);


                    $sql_borrow = "INSERT INTO add_borrow (`student_name`, `student_reg_no`, `book_id`, `author`, `isbn`, `publication_year`, `borrow_date`, `return_date`) VALUES ('$student_name', '$student_reg_no', '$book_id', '$author', '$isbn', '$publication_year', '$borrow_date', '$return_date')";
                    $req_borrow = $conn->query($sql_borrow);

                    if($req_borrow){
                        echo "
                            <script>
                                swal.fire('Borrowed', 'Book Borrowed Successfully', 'success')
                                .then(function(result){
                                if(result){
                                    window.location='view_borrow_books';
                            }});
                            </script>
                        ";
                    }else{
                        echo "
                        <script>
                            swal.fire('Failed', 'Failed to Borrow Book', 'error');
                        </script>
                    ";
                    }

                }
              
              ?>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
   function fetchBookDetails() {
    var bookId = document.getElementById("book_id").value;
    // console.log("Selected Book ID:", bookId); // Debugging Line

    if (bookId === "") {
        document.getElementById("author").value = "";
        document.getElementById("isbn").value = "";
        document.getElementById("pYear").value = "";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_book_details.php?book_id=" + bookId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            // console.log("Response Received:", xhr.responseText); // Debugging Line
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById("author").value = data.author;
                    document.getElementById("isbn").value = data.isbn;
                    document.getElementById("pYear").value = data.publication_year;
                } catch (e) {
                    console.error("Error parsing JSON:", xhr.responseText);
                }
            } else {
                console.error("Error: Status Code", xhr.status);
            }
        }
    };
    xhr.send();
}

</script>
<script>
    const modalBorrow = document.getElementById("modalBorrow");
    const openModalBtnBorrow = document.getElementById("openModalBtnAddBorrow");
    const closeModalBtnBorrow = document.getElementById("close-modal-btn-add-borrow");

    openModalBtnBorrow.addEventListener("click", () => {
        modalBorrow.style.display = "flex"; // Corrected variable name
    });

    closeModalBtnBorrow.addEventListener("click", () => {
        modalBorrow.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modalBorrow) { // Corrected variable name
            modalBorrow.style.display = "none";
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