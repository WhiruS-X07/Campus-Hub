<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

$limit = 15;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search_query = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// Prepare the search query
$sql_student_info = "SELECT * FROM student_info WHERE student_name LIKE ? OR course LIKE ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql_student_info);
$search_param = "%" . $search_query . "%";
$stmt->bind_param("ssii", $search_param, $search_param, $limit, $offset);
$stmt->execute();
$result_student_info = $stmt->get_result();

// Count the total results for pagination
$sql_count = "SELECT COUNT(*) AS total FROM student_info WHERE student_name LIKE ? OR course LIKE ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("ss", $search_param, $search_param);
$stmt_count->execute();
$total_students_result = $stmt_count->get_result();
$total_students = $total_students_result->fetch_assoc()['total'];

$total_pages = ceil($total_students / $limit);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Students Information!</h2>
            <form method="POST" class="d-flex">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>"
                    placeholder="Search" class="form-control me-3" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Semester Year</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_student_info->num_rows > 0): ?>
                    <?php
                    $s_no = $offset + 1;
                    while ($row = $result_student_info->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $s_no++; ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($row['student_img']); ?>" alt="Student Image"
                                    style="width: 50px; height: 50px;">
                            </td>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['course']); ?></td>
                            <td><?php echo htmlspecialchars($row['section']); ?></td>
                            <td><?php echo htmlspecialchars($row['semester_year']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No students found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <nav class="d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="student_info.php?page=<?php echo max(1, $page - 1); ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
                <?php
                if ($total_pages <= 3) {
                    for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="student_info.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor;
                } else {
                    echo '<li class="page-item ' . ($page == 1 ? 'active' : '') . '"><a class="page-link" href="student_info.php?page=1">1</a></li>';
                    if ($page > 3) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    for ($i = max(2, $page - 1); $i <= min($total_pages - 1, $page + 1); $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="student_info.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor;
                    if ($page < $total_pages - 2) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    echo '<li class="page-item ' . ($page == $total_pages ? 'active' : '') . '"><a class="page-link" href="student_info.php?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                }
                ?>
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="student_info.php?page=<?php echo min($total_pages, $page + 1); ?>"
                        aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php
include("footer.php");
?>