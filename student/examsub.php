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

// Fetch subjects for the course
$sql = "SELECT subject_id, subject_name FROM subject_info WHERE course_id = ?";
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
    echo "No subjects found for this course!";
    exit();
}

// Determine the current cycle
$current_month = date("n"); // Current month as number (1-12)
$cycle_message = "";

if (($current_month >= 3 && $current_month <= 5)) {
    $cycle = 'June Cycle';
} elseif (($current_month >= 9 && $current_month <= 11)) {
    $cycle = 'December Cycle';
} else {
    $cycle = 'Not currently registering for exams.';
}

// Check if the student has already submitted during the current cycle
$submitted_subjects = [];
$sql = "SELECT subject_id FROM exam_submissions WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($submitted = $result->fetch_assoc()) {
        $submitted_subjects[] = $submitted['subject_id'];
    }
}

// Handle exam submission
$submission_message = '';
$registration_warning = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a submission already exists for this cycle
    if (!empty($submitted_subjects)) {
        $registration_warning = "You have already registered for exams in this cycle. You cannot submit again.";
    } else {
        $subject_ids = $_POST['subject_ids'] ?? []; // Get selected subject IDs
        $valid_subject_ids = array_filter($subject_ids); // Filter out empty values

        // Check for duplicates in the selected options
        $unique_subject_ids = array_unique($valid_subject_ids);
        if (count($valid_subject_ids) !== count($unique_subject_ids)) {
            $registration_warning = "You cannot select the same subject multiple times!";
        } else {
            // Check for already submitted subjects
            $already_submitted = array_intersect($unique_subject_ids, $submitted_subjects);
            if (!empty($already_submitted)) {
                $registration_warning = "You have already submitted for these subjects: " . implode(', ', $already_submitted);
            } else {
                if (!empty($unique_subject_ids)) {
                    foreach ($unique_subject_ids as $subject_id) {
                        // Check if subject_id exists in subject_info
                        $checkSql = "SELECT subject_id FROM subject_info WHERE subject_id = ?";
                        $checkStmt = $conn->prepare($checkSql);
                        $checkStmt->bind_param("s", $subject_id);
                        $checkStmt->execute();
                        $checkResult = $checkStmt->get_result();

                        if ($checkResult->num_rows > 0) {
                            // Save the exam data to the database for each selected subject
                            $sql = "INSERT INTO exam_submissions (student_id, subject_id) VALUES (?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $student_id, $subject_id);
                            if (!$stmt->execute()) {
                                echo "<div class='alert alert-danger'>Error submitting exam for subject " . htmlspecialchars($subject_id) . ": " . $stmt->error . "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Subject ID " . htmlspecialchars($subject_id) . " does not exist!</div>";
                        }
                    }
                    $submission_message = "Exam registration successful for the selected subjects.<br>Payment Link Send To Your Email Address.";
                }
            }
        }
    }
}

ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin mb-3">
                <h2 class="font-weight-bold text-center">Take Your Exam</h2>
                <p class="text-center"><?php echo $cycle; ?></p>

                <!-- Display registration warning message if it exists -->
                <?php if ($registration_warning): ?>
                    <div class="alert alert-warning text-center"><?php echo $registration_warning; ?></div>
                <?php endif; ?>

                <!-- Display submission success message if it exists -->
                <?php if ($submission_message): ?>
                    <div class="alert alert-success text-center"><?php echo $submission_message; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold" style="text-size: 2em;">Select Subjects</h5>
                        <form action="" method="POST" id="subject-form">
                            <div class="row">
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <div class="col-md-6 mb-3">
                                        <label for="subject_id_<?php echo $i; ?>">Choose Subject <?php echo $i; ?>:</label>
                                        <select name="subject_ids[]" id="subject_id_<?php echo $i; ?>" class="form-control"
                                            onchange="updateSubjectSelectors(this)">
                                            <option value="">Select a subject</option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?php echo htmlspecialchars($subject['subject_id']); ?>">
                                                    <?php echo htmlspecialchars($subject['subject_id']) . ": " . htmlspecialchars($subject['subject_name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php if ($i % 2 == 0 && $i < 12): ?>
                                    </div>
                                    <div class="row">
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Exam</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </div>
</div>

<script>
    function updateSubjectSelectors(selectedElement) {
        const selectedValue = selectedElement.value;
        const allSelectors = document.querySelectorAll('select[name="subject_ids[]"]');

        allSelectors.forEach((selector) => {
            if (selector !== selectedElement) {
                const options = selector.querySelectorAll('option');
                options.forEach((option) => {
                    if (option.value === selectedValue) {
                        option.style.display = 'none'; // Hide the option if it is already selected in another dropdown
                    } else {
                        option.style.display = 'block'; // Show the option if it is not selected
                    }
                });
            }
        });
    }
</script>