<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

$results_per_page = 15;
$search_query = '';

if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

$total_query = "SELECT COUNT(*) as total FROM student_info 
                WHERE student_name LIKE '%$search_query%' 
                OR student_id LIKE '%$search_query%' 
                OR course LIKE '%$search_query%'";

$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_students = $total_row['total'];

$total_pages = ceil($total_students / $results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$starting_limit_number = ($page - 1) * $results_per_page;

$query = "SELECT student_id, student_name, course, section, semester_year 
          FROM student_info 
          WHERE student_name LIKE '%$search_query%' 
          OR student_id LIKE '%$search_query%' 
          OR course LIKE '%$search_query%' 
          LIMIT $starting_limit_number, $results_per_page";

$result = mysqli_query($conn, $query);

$success_message = '';

if (isset($_POST['submit'])) {
    $attendance_date = $_POST['attendance_date'];

    foreach ($_POST['attendance_status'] as $student_id => $status) {
        $insert_query = "INSERT INTO attendance (student_id, attendance_date, status, course, section, semester_year)
                         VALUES ('$student_id', '$attendance_date', '$status', 
                         (SELECT course FROM student_info WHERE student_id = '$student_id'),
                         (SELECT section FROM student_info WHERE student_id = '$student_id'),
                         (SELECT semester_year FROM student_info WHERE student_id = '$student_id'))
                         ON DUPLICATE KEY UPDATE status='$status'";

        mysqli_query($conn, $insert_query);
    }
    $success_message = "Attendance has been updated successfully";
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Mark Attendance</h2>
                    <form method="POST" class="d-flex">
                        <input type="text" name="search_query" class="form-control me-3" placeholder="Search"
                            value="<?php echo htmlspecialchars($search_query); ?>" />
                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <?php if ($success_message != ''): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group mt-3">
                        <label for="attendance_date">Attendance Date:</label>
                        <input type="date" name="attendance_date" required class="form-control" />
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Semester</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['student_id'] . "</td>";
                                echo "<td>" . $row['student_name'] . "</td>";
                                echo "<td>" . $row['course'] . "</td>";
                                echo "<td>" . $row['section'] . "</td>";
                                echo "<td>" . $row['semester_year'] . "</td>";
                                echo "<td>
                                    <select name='attendance_status[" . $row['student_id'] . "]' class='form-control'>
                                        <option value='Present'>Present</option>
                                        <option value='Absent'>Absent</option>
                                        <option value='Late'>Late</option>
                                        <option value='Excused'>Excused</option>
                                    </select>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" name="submit" class="btn btn-primary mt-4">Submit Attendance</button>
                </form>

                <nav>
                    <ul class="pagination justify-content-center mt-4">
                        <?php
                        if ($total_pages > 1) {
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="attendance.php?page=' . ($page - 1) . '&search_query=' . urlencode($search_query) . '">Previous</a></li>';
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == 1 || $i == $total_pages || ($i >= $page - 1 && $i <= $page + 1)) {
                                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="attendance.php?page=' . $i . '&search_query=' . urlencode($search_query) . '">' . $i . '</a></li>';
                                } elseif ($i == $page - 2 || $i == $page + 2) {
                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                }
                            }

                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="attendance.php?page=' . ($page + 1) . '&search_query=' . urlencode($search_query) . '">Next</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>