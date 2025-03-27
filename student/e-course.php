<?php
ob_start();
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Prevent session fixation
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}

// Database connection
include("../includes/config.php");
include("header.php");
include("sidebar.php");

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT email FROM users_info WHERE id = ?");
if (!$stmt) {
    die("Database error: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found!");
}
$user = $result->fetch_assoc();
$user_email = $user['email'];

// Fetch student details
$stmt = $conn->prepare("SELECT student_id, course_id FROM students WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Student not found!");
}
$student = $result->fetch_assoc();
$student_id = $student['student_id'];
$course_id = $student['course_id'];

// Fetch course details
$stmt = $conn->prepare("SELECT course_name, course_type, duration, course_description AS description, fee_structure, eligibility, specialization FROM course_details WHERE course_id = ?");
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Course not found!");
}
$course = $result->fetch_assoc();

// Fetch subject details
$stmt = $conn->prepare("SELECT subject_id, subject_name, subject_code, subject_description FROM subject_details WHERE course_id = ?");
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$subjects = $result->fetch_all(MYSQLI_ASSOC);

ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 mb-4">
                <h2 class="font-weight-bold text-center text-primary">Enrolled Course Details</h2>
            </div>
        </div>

        <!-- Course Information Card -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="font-weight-bold text-center text-secondary">Course Information</h5>
                        <hr>
                        <div class="row">
                            <?php foreach ($course as $key => $value): ?>
                                <div class="col-md-6 mb-3">
                                    <p>
                                        <strong class="text-dark text-capitalize">
                                            <i class="bi bi-info-circle me-1"></i>
                                            <?php echo str_replace('_', ' ', $key); ?>:
                                        </strong>
                                        <span class="text-muted"> <?php echo htmlspecialchars($value); ?></span>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Table -->
        <div class="col-lg-12">
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="font-weight-bold text-center text-secondary">Subjects in the Course</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Subject ID</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($subjects)): ?>
                                    <?php foreach ($subjects as $subject): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($subject['subject_id']); ?></td>
                                            <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                            <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                            <td><?php echo htmlspecialchars($subject['subject_description']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">No subjects found for this course.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>
    </div>
</div>