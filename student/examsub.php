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
$sql = "SELECT email FROM users_info WHERE id = ?";
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

// Fetch subjects for the course
$sql = "SELECT subject_id, subject_name FROM subject_details WHERE course_id = ?";
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
$sql = "SELECT subject_id FROM exam_sub WHERE student_id = ?";
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
                    // Check for valid course_id before proceeding
                    $checkCourseSql = "SELECT course_id FROM subject_details WHERE subject_id = ?";
                    $checkCourseStmt = $conn->prepare($checkCourseSql);

                    // Prepare the final insert statement once
                    $sql = "INSERT INTO exam_sub (student_id, subject_id, course_id) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    foreach ($unique_subject_ids as $subject_id) {
                        // Validate subject_id and get course_id
                        $checkCourseStmt->bind_param("s", $subject_id);
                        $checkCourseStmt->execute();
                        $checkCourseResult = $checkCourseStmt->get_result();

                        if ($checkCourseResult->num_rows > 0) {
                            $row = $checkCourseResult->fetch_assoc();
                            $course_id = $row['course_id'];

                            // Insert into exam_sub
                            $stmt->bind_param("sss", $student_id, $subject_id, $course_id);
                            if (!$stmt->execute()) {
                                echo "<div class='alert alert-danger'>Error submitting exam for subject " . htmlspecialchars($subject_id) . ": " . $stmt->error . "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Subject ID " . htmlspecialchars($subject_id) . " does not exist!</div>";
                        }
                    }

                    $submission_message = "Exam registration successful for the selected subjects. Payment Link Sent To Your Email Address.";
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
                <h2 class="font-weight-bold text-center text-primary">📚 Take Your Exam</h2>
                <p class="text-center text-muted">Cycle: <?php echo htmlspecialchars($cycle); ?></p>

                <!-- Display registration warning message if it exists -->
                <?php if ($registration_warning): ?>
                    <div class="alert alert-warning text-center shadow-sm">⚠️
                        <?php echo htmlspecialchars($registration_warning); ?>
                    </div>
                <?php endif; ?>

                <!-- Display submission success message if it exists -->
                <?php if ($submission_message): ?>
                    <div class="alert alert-success text-center shadow-sm">✅
                        <?php echo htmlspecialchars($submission_message); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="font-weight-bold mb-4 text-primary">Select Subjects</h5>
                        <form action="" method="POST" id="subject-form">
                            <div class="row g-3" id="subject-container">
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <div class="col-md-6 mb-3 subject-block">
                                        <label class="form-label" for="subject_id_<?php echo $i; ?>">Choose Subject
                                            <?php echo $i; ?>:</label>
                                        <select name="subject_ids[]" id="subject_id_<?php echo $i; ?>" class="form-select"
                                            onchange="updateSubjectSelectors(this)">
                                            <option value="">Select a subject</option>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?php echo htmlspecialchars($subject['subject_id']); ?>">
                                                    <?php echo htmlspecialchars($subject['subject_id']) . ": " . htmlspecialchars($subject['subject_name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div class="d-flex flex-column">
                                <button type="button" class="btn btn-outline-secondary mb-3" onclick="addSubjectField()"
                                    id="add-subject-btn">➕ Add More Subjects</button>
                                <button type="submit" class="btn btn-primary">🚀 Submit Exam</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
</div>
</div>
<script>
    let subjectCount = 4;

    function addSubjectField() {
        if (subjectCount >= 8) {
            alert('You can only add up to 8 subjects.');
            return;
        }
        subjectCount++;

        const container = document.getElementById('subject-container');
        const div = document.createElement('div');
        div.className = 'col-md-6 mb-3 subject-block';
        div.innerHTML = `
            <label for="subject_id_${subjectCount}">Choose Subject ${subjectCount}:</label>
            <select name="subject_ids[]" id="subject_id_${subjectCount}" class="form-control" onchange="updateSubjectSelectors(this)">
                <option value="">Select a subject</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php echo htmlspecialchars($subject['subject_id']); ?>">
                        <?php echo htmlspecialchars($subject['subject_id']) . ": " . htmlspecialchars($subject['subject_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        `;
        container.appendChild(div);

        if (subjectCount === 8) {
            document.getElementById('add-subject-btn').disabled = true;
        }
    }

    function updateSubjectSelectors(selectedElement) {
        const selectedValue = selectedElement.value;
        const allSelectors = document.querySelectorAll('select[name="subject_ids[]"]');

        // Restore all options before applying the new state
        allSelectors.forEach((selector) => {
            const options = selector.querySelectorAll('option');
            options.forEach((option) => {
                option.style.display = 'block';
            });
        });

        // Hide already selected subjects
        allSelectors.forEach((selector) => {
            const selectedOptions = Array.from(allSelectors).map(sel => sel.value);
            const options = selector.querySelectorAll('option');

            options.forEach((option) => {
                if (selectedOptions.includes(option.value) && option.value !== selector.value) {
                    option.style.display = 'none';
                }
            });
        });
    }
</script>