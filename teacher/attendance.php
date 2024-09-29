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
                <!-- Responsive Row for Heading and Search Form -->
                <div class="row mb-4">
                    <!-- Heading Column -->
                    <div class="col-12 col-lg-6 mb-2 mb-lg-0">
                        <h2>Mark Attendance</h2>
                    </div>

                    <!-- Search Form Column -->
                    <div class="col-12 col-lg-6 d-flex justify-content-lg-end">
                        <form method="POST"
                            class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center w-100">
                            <input type="text" name="search_query" class="form-control me-lg-2 mb-2 mb-lg-0"
                                placeholder="Search" value="<?php echo htmlspecialchars($search_query); ?>" required />
                            <button type="submit" name="search" class="btn btn-primary w-100 w-lg-auto">Search</button>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <!-- Attendance Form -->
                <form method="POST" action="">
                    <div class="form-group mt-3">
                        <label for="attendance_date">Attendance Date:</label>
                        <input type="date" name="attendance_date" required class="form-control" />
                    </div>

                    <!-- Responsive Table Wrapper -->
                    <div class="table-responsive">
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
                                    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['section']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['semester_year']) . "</td>";
                                    echo "<td>
                                        <select name='attendance_status[" . htmlspecialchars($row['student_id']) . "]' class='form-control'>
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
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" class="btn btn-primary mt-4 w-lg-auto">Submit
                        Attendance</button>
                </form>

                <!-- Pagination Navigation -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($total_pages > 1): ?>
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="attendance.php?page=<?php echo ($page - 1); ?>&search_query=<?php echo urlencode($search_query); ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <?php if ($i == 1 || $i == $total_pages || ($i >= $page - 1 && $i <= $page + 1)): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link"
                                            href="attendance.php?page=<?php echo $i; ?>&search_query=<?php echo urlencode($search_query); ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php elseif ($i == $page - 2 || $i == $page + 2): ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="attendance.php?page=<?php echo ($page + 1); ?>&search_query=<?php echo urlencode($search_query); ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<?php include("footer.php"); ?>