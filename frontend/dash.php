<?php
    include 'base.php';
?>

    <div class="container mt-5">
        <h1 class="text-center mb-4"></h1>

        <?php if ($role === 'admin'): ?>
            <!-- Admin Dashboard -->
            <div class="row">
                <div class="col-md-4">
                    <div class="rounded p-4 text-bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <!-- <p class="card-text">Add, update, and delete users.</p> --><br>
                            <a href="manage_users" class="btn btn-light">Go to Users</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rounded p-4 text-bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Manage Books</h5>
                            <!-- <p class="card-text">Add, update, and delete books.</p> --><br>
                            <a href="manage_books" class="btn btn-light">Go to Books</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rounded p-4 text-bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">View Offenses</h5>
                            <!-- <p class="card-text">View all offenses recorded in the system.</p> --><br>
                            <a href="manage_offenses" class="btn btn-light">View Offenses</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($role === 'student'): ?>
            <!-- student Dashboard -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="rounded p-4 text-bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">My Offenses</h5>
                            <!-- <p class="card-text">View and manage your offenses.</p> --><br>
                            <a href="my_offenses" class="btn btn-light">View Offenses</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- If Role is Undefined -->
            <div class="alert alert-danger text-center" role="alert">
                Invalid role assigned. Please contact the administrator.
            </div>
        <?php endif; ?>
    </div>
    <br>
    <hr>

    <?php if ($role === 'admin'): ?>

    <div class="container d-flex justify-content-between">
        <h3>10 Latest Books</h3>
        <div class="d-flex align-items-cneter">
            <!-- <p class="btn btn-primary" id="openModalBtnAddBorrow">Add Borrow <i class="fa fa-book fa-fade fa-beat"></i></p>&nbsp; -->
            <p><a href="view_borrow_books" class="btn btn-primary">View Borrow Books <i class="fa-fade fa-beat">&rarr;</i></a></p>&nbsp;
            <p><a href="#" class="btn btn-primary"><i class="fa fa-refresh fa-spin"></i></a></p>
        </div>
    </div>

    <div class="table-container" style="width: 90%; margin: 20px auto;">
        <table id="clientTable" class="display" style="width:100%">
        <thead>
        <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Book Title</th>
                <th class="text-center">Book Author</th>
                <th class="text-center">ISBN</th>
                <th class="text-center">Publication Year</th>
                <th class="text-center">Total Copies</th>
                <th class="text-center">Available Copies</th>
                <th class="text-center">Date Added</th>
                <th class="text-center">Status</th>
                <!-- <th class="text-center">Action</th> -->
            </tr>
        </thead>
        <tbody>

<?php
    $sn = 1;
    $get_books = "SELECT * FROM books ORDER BY id DESC LIMIT 10";
    $req = $conn->query($get_books);
    while($books = mysqli_fetch_assoc($req)):
?>

<tr>
    <td class="text-center"><?= $sn++ ?></td>
    <td class="text-center"><?= $books['title']; ?></td>
    <td class="text-center"><?= $books['author']; ?></td>
    <td class="text-center"><?= $books['isbn']; ?></td>
    <td class="text-center"><?= $books['publication_year']; ?></td>
    <td class="text-center"><?= $books['total_copies']; ?></td>
    <td class="text-center"><?= $books['available_copies']; ?></td>
    <td class="text-center"><?= $books['date']; ?></td>
    <td class="text-center">
        <?php
            if($books['status'] == 1){
                echo '<a href="../backend/active_dash.php?id=' .$books['id'].'&status=0" class="bg-success p-1 rounded text-light" style="text-decoration:none;">Available</a>';
            }else{
                echo '<a href="../backend/active_dash.php?id=' .$books['id'].' &status=1" class="bg-warning text-dark p-1 rounded text-light" style="text-decoration:none;">Borrowed</a>';
            }
        ?>
    </td>
    <!-- <td class="text-center">
        <span><a href="#" style="font-size: 20px;"><i class="fa fa-edit bg-primary text-light rounded-circle p-2"></i></a></span>&nbsp;&nbsp;
        <span><a href="#" style="font-size: 20px;"><i class="fa fa-trash bg-danger text-light rounded-circle p-2"></i></a></span>
    </td> -->
</tr>

<?php endwhile; ?>
</tbody>
        </table>
    </div>

    <?php else :?>

        
    <?php endif ?>

    <?php if ($role == 'student') :?>
        <div class="container d-flex justify-content-between">
            <h3><u>All Available Books <i class="fa fa-book"></i></u></h3>
        </div>

    <div class="table-container" style="width: 90%; margin: 20px auto; overflow-y:auto; height:48vh;">
        <table id="clientTable" class="display" style="width:100%">
        <thead>
        <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Book Title</th>
                <th class="text-center">Book Author</th>
                <th class="text-center">ISBN</th>
                <th class="text-center">Publication Year</th>
                <th class="text-center">Total Copies</th>
                <th class="text-center">Available Copies</th>
                <th class="text-center">Date Added</th>
                <th class="text-center">Status</th>
                <!-- <th class="text-center">Action</th> -->
            </tr>
        </thead>
        <tbody>

<?php
    $sn = 1;
    $get_books = "SELECT * FROM books ORDER BY id DESC";
    $req = $conn->query($get_books);
    while($books = mysqli_fetch_assoc($req)):
?>

<tr>
    <td class="text-center"><?= $sn++ ?></td>
    <td class="text-center"><?= $books['title']; ?></td>
    <td class="text-center"><?= $books['author']; ?></td>
    <td class="text-center"><?= $books['isbn']; ?></td>
    <td class="text-center"><?= $books['publication_year']; ?></td>
    <td class="text-center"><?= $books['total_copies']; ?></td>
    <td class="text-center"><?= $books['available_copies']; ?></td>
    <td class="text-center"><?= $books['date']; ?></td>
    <td class="text-center">
        <?php
            if($books['status'] == 1){
                echo '<p href="../backend/active_dash.php?id=' .$books['id'].'&status=0" class="bg-success p-1 rounded text-light" style="text-decoration:none;">Available</p>';
            }else{
                echo '<p href="../backend/active_dash.php?id=' .$books['id'].' &status=1" class="bg-warning text-dark p-1 rounded text-light" style="text-decoration:none;">Borrowed</p>';
            }
        ?>
    </td>
    <!-- <td class="text-center">
        <span><a href="#" style="font-size: 20px;"><i class="fa fa-edit bg-primary text-light rounded-circle p-2"></i></a></span>&nbsp;&nbsp;
        <span><a href="#" style="font-size: 20px;"><i class="fa fa-trash bg-danger text-light rounded-circle p-2"></i></a></span>
    </td> -->
</tr>

<?php endwhile; ?>
</tbody>
        </table>
    </div>
    <?php endif;?>

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
    
                <?php
                    // Fetch book titles
                    $sql_get_book = "SELECT id, title FROM books";
                    $result_get_book = $conn->query($sql_get_book);
                ?>

                <form action="" method="POST">
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

                    <div class="mb-3">
                        <label for="book_id" class="form-label">Select Book:</label>
                        <select class="form-select" id="book_id" name="book_id" required onchange="fetchBookDetails()">
                            <option value="">-- Select Book --</option>
                            <?php while ($row = $result_get_book->fetch_assoc()) { ?>
                                <option value="<?= $row['id']; ?>"><?= $row['title']; ?></option>
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
                    $student_reg_no = mysqli_real_escape_string($conn, $_POST['student_reg_no']);
                    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
                    $author = mysqli_real_escape_string($conn, $_POST['author']);
                    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
                    $publication_year = mysqli_escape_string($conn, $_POST['publication_year']);
                    $borrow_date = mysqli_real_escape_string($conn, $_POST['borrow_date']);
                    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);


                    $sql_borrow = "INSERT INTO add_borrow (`student_reg_no`, `book_id`, `author`, `isbn`, `publication_year`, `borrow_date`, `return_date`) VALUES ('$student_reg_no', '$book_id', '$author', '$isbn', '$publication_year', '$borrow_date', '$return_date')";
                    $req_borrow = $conn->query($sql_borrow);

                    if($req_borrow){
                        echo "
                            <script>
                                swal.fire('Borrowed', 'Book Borrowed Successfully', 'success')
                                .then(function(result){
                                if(result){
                                    window.location='dash';
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