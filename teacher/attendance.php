<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

$results_per_page = 15;
$search_query = '';

if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, trim($_POST['search_query']));
}

// Get total number of students for pagination
$total_query = "SELECT COUNT(*) as total FROM students 
                WHERE student_name LIKE '%$search_query%' 
                OR student_id LIKE '%$search_query%' 
                OR course_id LIKE '%$search_query%'";

$total_result = mysqli_query($conn, $total_query);
if (!$total_result) {
    die("Query failed: " . mysqli_error($conn));
}
$total_row = mysqli_fetch_assoc($total_result);
$total_students = $total_row['total'];
$total_pages = ceil($total_students / $results_per_page);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$starting_limit_number = ($page - 1) * $results_per_page;

// Fetch students from the correct table
$query = "SELECT student_id, student_name, course_id FROM students 
          WHERE student_name LIKE '%$search_query%' 
          OR student_id LIKE '%$search_query%' 
          OR course_id LIKE '%$search_query%' 
          LIMIT $starting_limit_number, $results_per_page";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$success_message = '';

// Handle attendance submission
if (isset($_POST['submit'])) {
    $attendance_date = mysqli_real_escape_string($conn, $_POST['attendance_date']);

    foreach ($_POST['attendance_status'] as $student_id => $status) {
        $student_id = mysqli_real_escape_string($conn, $student_id);
        $status = mysqli_real_escape_string($conn, $status);

        // Fetch course_id for the student
        $course_query = "SELECT course_id FROM students WHERE student_id = '$student_id'";
        $course_result = mysqli_query($conn, $course_query);
        if ($course_row = mysqli_fetch_assoc($course_result)) {
            $course_id = $course_row['course_id'];

            $insert_query = "INSERT INTO attendance (student_id, attendance_date, status, course_id)
                             VALUES ('$student_id', '$attendance_date', '$status', '$course_id')
                             ON DUPLICATE KEY UPDATE status='$status'";

            if (!mysqli_query($conn, $insert_query)) {
                die("Error inserting attendance: " . mysqli_error($conn));
            }
        }
    }
    $success_message = "Attendance has been updated successfully.";
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center mb-4">Mark Attendance</h2>

                <div class="row mb-4">
                    <div class="col-lg-6">
                        <form method="POST" class="input-group">
                            <input type="text" name="search_query" class="form-control" placeholder="Search Student..."
                                value="<?php echo htmlspecialchars($search_query); ?>" required />
                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="attendance_date">Attendance Date:</label>
                        <input type="date" name="attendance_date" required class="form-control" />
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Course ID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['course_id']); ?></td>
                                        <td>
                                            <select
                                                name='attendance_status[<?php echo htmlspecialchars($row['student_id']); ?>]'
                                                class='form-control'>
                                                <option value='Present'>Present</option>
                                                <option value='Absent'>Absent</option>
                                                <option value='Late'>Late</option>
                                                <option value='Excused'>Excused</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success mt-4">Submit Attendance</button>
                </form>

                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="attendance.php?page=<?php echo $i; ?>&search_query=<?php echo urlencode($search_query); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>