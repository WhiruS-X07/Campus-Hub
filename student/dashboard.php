<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

// Fetch user email and student details
$user_id = $_SESSION['user_id'];

// Fetch user details from the users table
$sql = "SELECT email, name, phone_no FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_email = $user["email"];
    $user_name = $user["name"]; // Get user name
    $user_phone_no = $user['phone_no']; // Get phone number
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

// Check exam registration status
$isRegistered = false;

$sql = "SELECT COUNT(*) as count FROM exam_submissions WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data['count'] > 0) {
    $isRegistered = true;
}

// Fetch course details using the course_id
$sql = "SELECT course_name, duration FROM course_info WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $course = $result->fetch_assoc();
    $course_name = $course['course_name'];
    $course_duration = $course['duration'];
} else {
    echo "Course not found!";
    exit();
}

$message = ""; // Variable to hold success/error message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback_text = $_POST['feedback'];

    // Prepare and execute insert query
    $sql = "INSERT INTO feedback (student_id, course_id, student_name, feedback_text) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $student_id, $course_id, $user_name, $feedback_text);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Feedback submitted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error submitting feedback. Please try again later.</div>";
    }
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="font-weight-bold">Welcome Back!</h3>
            </div>
        </div>

        <div class="col-md-12">
            <div class="alert <?php echo $isRegistered ? 'alert-success' : 'alert-warning'; ?> text-center">
                <?php if ($isRegistered): ?>
                    <h4 class="alert-heading">Registration Confirmed!</h4>
                    <p>You are successfully registered for exams.</p>
                <?php else: ?>
                    <h4 class="alert-heading">Reminder: Registration Needed!</h4>
                    <p>You have not registered for exams. Please make sure to register to participate.</p>
                    <a href="examsub.php" class="btn btn-primary mt-2">Register Now</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Events</p>
                        </div>
                        <p class="font-weight-500">This calendar shows upcoming school events and important dates for
                            students and staff.</p>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile</h4>
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($user_name); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
                                <p><strong>Phone No.:</strong> <?php echo htmlspecialchars($user_phone_no); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enrolled Course</h4>
                                <p><strong>Course Name:</strong> <?php echo htmlspecialchars($course_name); ?></p>
                                <p><strong>Course ID:</strong> <?php echo htmlspecialchars($course_id); ?></p>
                                <p><strong>Duration:</strong> <?php echo htmlspecialchars($course_duration); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="padding-top:10px; padding-bottom:10;">
                        <h4 class="card-title" style="margin-top:4px; margin-bottom: 12px;">Student To-Do List</h4>
                        <div class="list-wrapper overflow-auto" style="">
                            <ul class="d-flex flex-column-reverse">
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Complete assignment
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Review notes
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Prepare for upcoming
                                            presentations
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Prepare for Exam
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Feedback</h4>
                    <?php if (!empty($message)): ?>
                        <?php echo $message; ?>
                    <?php endif; ?>
                    <form action="" method="POST"> 
                        <textarea name="feedback" rows="4" class="form-control"
                            placeholder="Your feedback..."></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>

<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            height: 'parent',
            contentHeight: 'auto',
            editable: true,
            events: [
                {
                    title: 'School Event',
                    start: '2024-09-20',
                    end: '2024-09-22',
                    color: '#1E90FF'
                },
                {
                    title: 'Exam Week',
                    start: '2024-09-25',
                    end: '2024-09-30',
                    color: '#00BFFF'
                }
            ]
        });
    });
</script>