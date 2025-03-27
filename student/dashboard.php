<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

// Fetch user email and student details
$user_id = $_SESSION['user_id'];

// Fetch user details from users_info table
$sql = "SELECT email, name, phone_no FROM users_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_email = $user["email"];
    $user_name = $user["name"];
    $user_phone_no = $user['phone_no'];
} else {
    echo "User not found!";
    exit();
}

// Fetch student details using the email from students table
$sql = "SELECT student_id, course_id FROM students WHERE email = ?";
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

// Check exam registration status from exam_submissions table
$isRegistered = false;
$sql = "SELECT COUNT(*) as count FROM exam_sub WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data['count'] > 0) {
    $isRegistered = true;
}

// Fetch course details using the course_id from course_details table
$sql = "SELECT course_name, duration FROM course_details WHERE course_id = ?";
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

    // Insert feedback into feedback table
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
            <div class="col-md-12 grid-margin d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bold">Welcome Back, <span class="text-primary">Student!</span></h3>
                <span class="badge badge-info">Student Dashboard</span>
            </div>
        </div>

        <div class="row">
            <!-- Registration Status -->
            <div class="col-md-12">
                <div class="alert <?php echo $isRegistered ? 'alert-success' : 'alert-warning'; ?> text-center">
                    <?php if ($isRegistered): ?>
                        <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Registration Confirmed!</h4>
                        <p>You are successfully registered for exams.</p>
                    <?php else: ?>
                        <h4 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Reminder: Registration Needed!
                        </h4>
                        <p>You have not registered for exams. Please make sure to register to participate.</p>
                        <a href="examsub.php" class="btn btn-primary mt-2">Register Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Student Profile -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="student_avatar.png" class="rounded-circle mb-3" width="80" alt="Profile Image">
                        <h5 class="card-title text-primary"> <?php echo htmlspecialchars($user_name); ?> </h5>
                        <p class="mb-1"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user_email); ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user_phone_no); ?></p>
                    </div>
                </div>
            </div>

            <!-- Course Details -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Enrolled Course</h4>
                        <p><strong>Course:</strong> <?php echo htmlspecialchars($course_name); ?></p>
                        <p><strong>Course ID:</strong> <?php echo htmlspecialchars($course_id); ?></p>
                        <p><strong>Duration:</strong> <?php echo htmlspecialchars($course_duration); ?></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 60%;">60% Completed</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements & Deadlines -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Important Updates</h4>
                        <ul class="list-group">
                            <li class="list-group-item">New Assignment: Due March 30</li>
                            <li class="list-group-item">Exam Schedule Released</li>
                            <li class="list-group-item">Next Webinar: April 5</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Calendar Events -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Upcoming Events</h4>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- To-Do List -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">To-Do List</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><input type="checkbox"> Complete assignment</li>
                            <li class="list-group-item"><input type="checkbox"> Review notes</li>
                            <li class="list-group-item"><input type="checkbox"> Prepare for exams</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Feedback</h4>
                        <?php if (!empty($message)): ?>
                            <?php echo $message; ?>
                        <?php endif; ?>
                        <form action="" method="POST">
                            <textarea name="feedback" rows="3" class="form-control"
                                placeholder="Your feedback..."></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Submit Feedback</button>
                        </form>
                    </div>
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