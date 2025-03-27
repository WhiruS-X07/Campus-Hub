<?php
$pageTitle = "Register Page";
include('includes/header.php');
include('includes/config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$error_message = "";
$form_valid = true;
$courses = [];

// Fetch courses from course_details table
$sql_courses = "SELECT course_id, course_name FROM course_details";
$result_courses = $conn->query($sql_courses);

if ($result_courses && $result_courses->num_rows > 0) {
    while ($row = $result_courses->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Handle registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user_type']) &&
        !empty($_POST['dob']) && !empty($_POST['address']) && !empty($_POST['state']) && !empty($_POST['pincode']) &&
        !empty($_POST['country'])
    ) {
        $name = $conn->real_escape_string($_POST['name']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $address = $conn->real_escape_string($_POST['address']);
        $state = $conn->real_escape_string($_POST['state']);
        $pincode = $conn->real_escape_string($_POST['pincode']);
        $country = $conn->real_escape_string($_POST['country']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone_no = !empty($_POST['phone_no']) ? $conn->real_escape_string($_POST['phone_no']) : NULL;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user_type = $_POST['user_type'];
        $teacher_id = ($user_type === 'teacher') ? "TEACH" . $conn->real_escape_string($_POST['teacher_id']) : NULL;
        $student_id = ($user_type === 'student') ? "IGN" . $conn->real_escape_string($_POST['student_id']) : NULL;
        $course = ($user_type === 'student') ? $conn->real_escape_string($_POST['course']) : NULL;

        // Check if email already exists
        $stmt_email_check = $conn->prepare("SELECT email FROM users_info WHERE email = ?");
        $stmt_email_check->bind_param("s", $email);
        $stmt_email_check->execute();
        $stmt_email_check->store_result();

        if ($stmt_email_check->num_rows > 0) {
            $error_message = "This email is already registered. Please use a different email or log in.";
        } else {
            $conn->begin_transaction();

            try {
                $sql = "INSERT INTO users_info (name, email, password, user_type, phone_no) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $name, $email, $password, $user_type, $phone_no);
                $stmt->execute();

                if ($user_type === 'teacher') {
                    $sql_teacher = "INSERT INTO teachers (teacher_name, email, teach_id, phone_no, dob, address, state, pincode, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_teacher = $conn->prepare($sql_teacher);
                    $stmt_teacher->bind_param("sssssssss", $name, $email, $teacher_id, $phone_no, $dob, $address, $state, $pincode, $country);
                    $stmt_teacher->execute();
                } elseif ($user_type === 'student') {
                    $sql_student = "INSERT INTO students (student_name, student_id, email, phone_no, course_id, dob, address, state, pincode, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_student = $conn->prepare($sql_student);
                    $stmt_student->bind_param("ssssssssss", $name, $student_id, $email, $phone_no, $course, $dob, $address, $state, $pincode, $country);
                    $stmt_student->execute();
                }

                $conn->commit();
                echo "<div class='alert alert-success'>Registration successful!</div>";
            } catch (Exception $e) {
                $conn->rollback();
                $error_message = "Registration failed: " . $e->getMessage();
            }
        }
    } else {
        $error_message = "Required fields are missing.";
    }
}
?>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <form class="card p-5 shadow-lg" style="width: 100%; max-width: 600px; border-radius: 20px;" method="post"
            action="register.php">
            <div class="form-container text-center mb-4">
                <h3 class="fw-bold">Create Your Account</h3>
                <p class="text-muted">Fill in the details below to register</p>
            </div>

            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger text-center" role="alert"><?php echo $error_message; ?></div>
            <?php } ?>

            <!-- Name and DOB -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="registername" class="form-label">Name</label>
                    <input type="text" id="registername" name="name" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control" required />
                </div>
            </div>

            <!-- Email and Phone -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="registerEmail" class="form-label">Email</label>
                    <input type="email" id="registerEmail" name="email" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="phone_no" class="form-label">Phone Number</label>
                    <input type="text" id="phone_no" name="phone_no" class="form-control" required />
                </div>
            </div>

            <!-- Address -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">State</label>
                    <input type="text" id="state" name="state" class="form-control" required />
                </div>
            </div>

            <!-- Pincode and Country -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" id="pincode" name="pincode" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" id="country" name="country" class="form-control" required />
                </div>
            </div>

            <!-- Role Selection -->
            <label for="userType" class="form-label">Your Role</label>
            <select id="userType" name="user_type" class="form-control mb-3" required onchange="toggleFields()">
                <option value="" disabled selected>Select your role</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
            </select>

            <!-- Teacher Fields -->
            <div id="teacherIdContainer" class="mb-3" style="display: none;">
                <label for="teacherId" class="form-label">Teacher ID</label>
                <div class="input-group">
                    <span class="input-group-text">TEACH</span>
                    <input type="text" id="teacherId" name="teacher_id" class="form-control" maxlength="5"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="12345" />
                </div>
            </div>


            <!-- Student Fields -->
            <div id="studentIdContainer" class="mb-3" style="display: none;">
                <label for="studentId" class="form-label">Student ID</label>
                <div class="input-group">
                    <span class="input-group-text">IGN</span>
                    <input type="text" id="studentId" name="student_id" class="form-control" maxlength="5"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="12345" />
                </div>


                <label for="course" class="form-label">Course</label>
                <select id="course" name="course" class="form-control">
                    <option value="" disabled selected>Select a course</option>
                    <?php foreach ($courses as $course) { ?>
                        <option value="<?php echo $course['course_id']; ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Password with Toggle -->
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="registerPassword" name="password" class="form-control" required />
                    <span class="input-group-text">
                        <input type="checkbox" onclick="togglePassword()" id="showPassword"> Show Password
                    </span>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="registerCheck" required />
                <label class="form-check-label" for="registerCheck"> I agree to the terms and conditions. </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Register</button>

            <div class="text-center mt-3">
                <p>Already registered? <a href="./login.php">Login here</a>.</p>
                <a href="index.php" class="text-muted">&larr; Back to Home</a>
            </div>
        </form>
    </div>

    <script>
        function toggleFields() {
            const userType = document.getElementById('userType').value;
            const teacherIdContainer = document.getElementById('teacherIdContainer');
            const studentIdContainer = document.getElementById('studentIdContainer');
            const studentIdInput = document.getElementById('studentId');
            const teacherIdInput = document.getElementById('teacherId');

            teacherIdContainer.style.display = userType === 'teacher' ? 'block' : 'none';
            studentIdContainer.style.display = userType === 'student' ? 'block' : 'none';

            teacherIdInput.required = (userType === 'teacher');
            studentIdInput.required = (userType === 'student');
        }

        function togglePassword() {
            var x = document.getElementById("registerPassword");
            x.type = x.type === "password" ? "text" : "password";
        }

    </script>
</body>

</html>