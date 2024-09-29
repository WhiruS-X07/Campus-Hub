<?php
ob_start();
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user email from the users table
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_email = $user["email"];
} else {
    echo "User not found!";
    exit();
}

// Fetch student details using the email
$sql = "SELECT student_id, course_id FROM student WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $student_id = $student['student_id'];
    $course_id = $student['course_id'];
} else {
    echo "Student not found!";
    exit();
}

// Fetch timetable details for the course
$sql = "SELECT day_of_week, start_time, end_time, subject_id, section 
        FROM timetable_info 
        WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();

$timetable = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $timetable[] = $row;
    }
} else {
    $timetable = null; // No timetable found for this course
}

ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin mb-3">
                <h2 class="font-weight-bold text-center">Timetable for Your Course</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold text-center">Timetable</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Day of Week</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Subject ID</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($timetable !== null): ?>
                                        <?php foreach ($timetable as $entry): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($entry['day_of_week']); ?></td>
                                                <td><?php echo htmlspecialchars($entry['start_time']); ?></td>
                                                <td><?php echo htmlspecialchars($entry['end_time']); ?></td>
                                                <td><?php echo htmlspecialchars($entry['subject_id']); ?></td>
                                                <td><?php echo htmlspecialchars($entry['section']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Timetable is currently under updation.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</div>