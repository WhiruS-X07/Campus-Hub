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

$sql = "SELECT ci.course_name, ci.course_type, ci.duration, ci.description, ci.fee_structure, ci.eligibility, ci.specialization, ci.course_id 
        FROM course_info ci 
        JOIN student s ON ci.course_id = s.course_id 
        WHERE s.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $course = $result->fetch_assoc();
    $course_id = $course["course_id"];
} else {
    echo "Course not found!";
    exit();
}

$sql = "SELECT subject_id, subject_name, semester_year FROM subject_info WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();

$subjects = [];
if ($result->num_rows > 0) {
    while ($subject = $result->fetch_assoc()) {
        $subjects[] = $subject;
    }
} else {

}


ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 mb-3">
                <h2 class="font-weight-bold text-center">Enrolled Course Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="border: none;">
                    <div class="card-body">
                        <?php if ($course): ?>
                            <h5 class="font-weight-bold d-flex justify-content-center" style="font-size: 1.5rem;">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </h5>
                            <hr>
                            <div class="row d-flex justify-content-between align-items-start mb-4">
                                <div class="col-md-7 col-12">
                                    <p><strong>Specialization:</strong>
                                        <?php echo htmlspecialchars($course['specialization']); ?></p>
                                    <p><strong>Description:</strong> <?php echo htmlspecialchars($course['description']); ?>
                                    </p>
                                </div>
                                <div class="col-md-5 col-12">
                                    <p><strong>Course Type:</strong> <?php echo htmlspecialchars($course['course_type']); ?>
                                    </p>
                                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
                                    <p><strong>Fee:</strong> ₹ <?php echo htmlspecialchars($course['fee_structure']); ?></p>
                                    <p><strong>Eligibility:</strong> <?php echo htmlspecialchars($course['eligibility']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <h5 class="font-weight-bold text-center" style="font-size: 1.5rem;">Course information is
                                currently being updated.</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="subject-section">
                        <h5 class="font-weight-bold text-center" style="font-size: 1.5rem;">
                            Subjects in the Course
                        </h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>Subject ID</th>
                                        <th>Subject Name</th>
                                        <th>Semester/Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($subjects) > 0): ?>
                                        <?php foreach ($subjects as $subject): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($subject['subject_id']); ?></td>
                                                <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                                <td><?php echo htmlspecialchars($subject['semester_year']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No subjects found for this course.
                                                Information
                                                is currently being updated.</td>
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