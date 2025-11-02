<?php
// Include the database connection file
include 'connection.php';

?>
<h3 class="text-center"><u>Manage Books</u></h3>
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
                <th class="text-center">Action</th>
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
                            echo '<a href="../backend/active.php?id=' .$books['id'].'&status=0" class="bg-success p-1 rounded text-light" style="text-decoration:none;">Available</a>';
                        }else{
                            echo '<a href="../backend/active.php?id=' .$books['id'].' &status=1" class="bg-warning text-dark p-1 rounded text-light" style="text-decoration:none;">Borrowed</a>';
                        }
                    ?>
                </td>
                <td class="text-center">
                    <span><a href="../frontend/update_book.php?edit_books=<?= $books['id']; ?>" style="font-size: 20px;"><i class="fa fa-edit bg-primary text-light rounded-circle p-2"></i></a></span>&nbsp;&nbsp;
                    <span><a href="../actions/del.php?bookdel=<?= $books['id']; ?>" style="font-size: 20px;"><i class="fa fa-trash bg-danger text-light rounded-circle p-2"></i></a></span>
                </td>
            </tr>

            <?php endwhile; ?>
        </tbody>
        </table>