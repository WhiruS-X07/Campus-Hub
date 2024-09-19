<?php
$pageTitle = "Register Page";
include('includes/header.php');
include('includes/config.php');

$error_message = ""; // Variable to store the error message
$form_valid = true; // Flag to determine if the form is valid

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user_type'])) {

        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        $teacher_id = isset($_POST['teacher_id']) ? $conn->real_escape_string($_POST['teacher_id']) : null;
        $student_id = isset($_POST['student_id']) ? $conn->real_escape_string($_POST['student_id']) : null;

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Determine user_specific_id based on user_type
        if ($user_type === 'teacher' || !empty($teacher_id)) {
            $user_specific_id = $teacher_id;
        } elseif (($user_type === 'student' || $user_type === 'parent') && !empty($student_id)) {
            $user_specific_id = $student_id;
        } else {
            $user_specific_id = null;
        }

        // Check if a student exists if the user is a parent
        if ($user_type === 'parent' && !empty($student_id)) {
            $sql_check_student = "SELECT id FROM student WHERE student_id = ?";
            $stmt_check_student = $conn->prepare($sql_check_student);
            $stmt_check_student->bind_param("s", $student_id);
            $stmt_check_student->execute();
            $stmt_check_student->store_result();

            if ($stmt_check_student->num_rows === 0) {
                $error_message = "No student found with the given Student ID.";
                $form_valid = false;
            }

            $stmt_check_student->close();
        }

        if ($form_valid) {
            // Begin transaction
            $conn->begin_transaction();

            try {
                // Insert the user into the database
                $sql = "INSERT INTO users (name, email, password, user_type, user_specific_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $name, $email, $hashed_password, $user_type, $user_specific_id);

                if ($stmt->execute()) {
                    // Check user type and insert into respective table
                    if ($user_type === 'teacher' && !empty($teacher_id)) {
                        $sql_teacher = "INSERT INTO teacher (id, teacher_name, email, teacher_id) VALUES (NULL, ?, ?, ?)";
                        $stmt_teacher = $conn->prepare($sql_teacher);
                        $stmt_teacher->bind_param("sss", $name, $email, $teacher_id);
                        $stmt_teacher->execute();
                        $stmt_teacher->close();
                    } elseif ($user_type === 'student' && !empty($student_id)) {
                        $sql_student = "INSERT INTO student (id, student_name, student_id, email) VALUES (NULL, ?, ?, ?)";
                        $stmt_student = $conn->prepare($sql_student);
                        $stmt_student->bind_param("sss", $name, $student_id, $email);
                        $stmt_student->execute();
                        $stmt_student->close();
                    } elseif ($user_type === 'parent') {
                        $sql_parent = "INSERT INTO parent (id, parent_name, student_name, student_id, email) VALUES (NULL, ?, ?, ?, ?)";
                        $stmt_parent = $conn->prepare($sql_parent);
                        $stmt_parent->bind_param("ssss", $name, $name, $student_id, $email);
                        $stmt_parent->execute();
                        $stmt_parent->close();
                    }

                    // Commit transaction
                    $conn->commit();

                    // Registration successful
                    $_SESSION['registration_success'] = true; // Optional: set a session variable for success message
                    header("Location: ./login.php"); // Redirect to login page
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } catch (Exception $e) {
                // Rollback transaction in case of error
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }

            $conn->close();
        }
    } else {
        $error_message = "Required fields are missing.";
        $form_valid = false;
    }
}
?>


<style>
    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }

    .form-container {
        width: 100%;
        max-width: 600px;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    /* Container for password input and icon */
    .password-container {
        position: relative;
        width: 100%;
    }

    /* Style the password input */
    .password-container input {
        width: 100%;
        padding-right: 45px;
        /* Space for the eye icon */
        box-sizing: border-box;
        /* Ensure padding doesn't break the layout */
    }

    /* Style the eye icon */
    .password-container .password-toggle {
        position: absolute;
        right: 10px;
        /* Adjust to place it inside the input field */
        top: 50%;
        transform: translateY(-50%);
        /* Center vertically */
        cursor: pointer;
        color: #888;
        /* Adjust color */
        font-size: 1.2em;
        /* Adjust size */
    }

    /* Make sure the form fields maintain consistent padding */
    .password-container input:focus {
        outline: none;
        border-color: #007bff;
    }
</style>

<body>
    <form method="post" action="">
        <!-- Centered Form in a Box -->
        <div class="form-container card">
            <div style="display:block;">
                <div style="display: flex;">
                    <div style="margin-left: -50px; cursor: pointer;">
                        <button type="button" class="btn btn-link btn-floating mx-1" style="padding-right: 5px;"
                            onclick="window.location.href='./index.php';">
                            <i class="fa-solid fa-arrow-left" style="font-size: 16px;"></i>
                        </button>
                    </div>
                    <div style="flex-grow: 1">
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist" style="margin-top: 9px;">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-login" href="./login.php" role="tab"
                                    aria-controls="pills-login" aria-selected="false">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-register" href="#" role="tab"
                                    aria-controls="pills-register" aria-selected="true">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registername">Name</label>
                <input type="text" id="registername" name="name" class="form-control" required />
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" id="registerEmail" name="email" class="form-control" required />
            </div>

            <!-- User type selection -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="userType">Your Role</label>
                <select id="userType" name="user_type" class="form-control" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                    <option value="parent">Parent</option>
                </select>
            </div>

            <!-- Teacher ID input -->
            <div id="teacherIdContainer" class="form-outline mb-4" style="display: none;">
                <label class="form-label" for="teacherId">Teacher ID</label>
                <input type="text" id="teacherId" name="teacher_id" class="form-control" />
            </div>

            <!-- Student ID input -->
            <div id="studentIdContainer" class="form-outline mb-4" style="display: none;">
                <label class="form-label" for="studentId">Student ID</label>
                <input type="text" id="studentId" name="student_id" class="form-control" />
                <?php if (isset($error_message) && strpos($error_message, 'No student found') !== false): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <div class="password-container">
                    <input type="password" id="registerPassword" name="password" class="form-control" required />
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck"
                    aria-describedby="registerCheckHelpText" required />
                <label class="form-check-label" for="registerCheck">
                    I have read and agree to the terms
                </label>
            </div>

            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                class="btn btn-primary btn-block mb-3">Register</button>
        </div>
    </form>

    <!-- JavaScript for toggling the password visibility and showing/hiding ID fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const repeatPasswordField = document.getElementById('registerPassword');
            const toggleRepeatPasswordIcon = document.getElementById('togglePassword');

            // Add event listener for the repeat password toggle
            if (toggleRepeatPasswordIcon) {
                toggleRepeatPasswordIcon.addEventListener('click', function () {
                    if (repeatPasswordField.type === 'password') {
                        repeatPasswordField.type = 'text';
                        toggleRepeatPasswordIcon.classList.remove('fa-eye');
                        toggleRepeatPasswordIcon.classList.add('fa-eye-slash');
                    } else {
                        repeatPasswordField.type = 'password';
                        toggleRepeatPasswordIcon.classList.remove('fa-eye-slash');
                        toggleRepeatPasswordIcon.classList.add('fa-eye');
                    }
                });
            }

            // Show/hide ID fields based on user type selection
            const userTypeSelect = document.getElementById('userType');
            const teacherIdContainer = document.getElementById('teacherIdContainer');
            const studentIdContainer = document.getElementById('studentIdContainer');

            userTypeSelect.addEventListener('change', function () {
                const selectedType = this.value;

                if (selectedType === 'teacher') {
                    teacherIdContainer.style.display = 'block';
                    studentIdContainer.style.display = 'none';
                } else if (selectedType === 'student' || selectedType === 'parent') {
                    teacherIdContainer.style.display = 'none';
                    studentIdContainer.style.display = 'block';
                } else {
                    teacherIdContainer.style.display = 'none';
                    studentIdContainer.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>