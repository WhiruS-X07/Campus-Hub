<?php
$pageTitle = "Register Page";
include('includes/header.php');
include('includes/config.php');

$error_message = "";
$form_valid = true;
$courses = [];

$sql_courses = "SELECT course_id FROM course_info";
$result_courses = $conn->query($sql_courses);

if ($result_courses && $result_courses->num_rows > 0) {
    while ($row = $result_courses->fetch_assoc()) {
        $courses[] = $row['course_id'];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user_type'])) {

        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        $teacher_id = isset($_POST['teacher_id']) ? $conn->real_escape_string($_POST['teacher_id']) : null;
        $student_id = isset($_POST['student_id']) ? $conn->real_escape_string($_POST['student_id']) : null;
        $phone_no = $conn->real_escape_string($_POST['phone_no']);
        $course = $user_type === 'student' ? $conn->real_escape_string($_POST['course']) : null;

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if the email already exists
        $email_check_sql = "SELECT email FROM users WHERE email = ?";
        $stmt_email_check = $conn->prepare($email_check_sql);
        $stmt_email_check->bind_param("s", $email);
        $stmt_email_check->execute();
        $stmt_email_check->store_result();

        if ($stmt_email_check->num_rows > 0) {
            // If email exists, show an error message
            $error_message = "This email is already registered. Please use a different email or log in.";
            $form_valid = false;
        } else {
            // Proceed with the rest of the code if the email does not exist
            $stmt_email_check->close();

            if ($user_type === 'teacher' || !empty($teacher_id)) {
                $user_specific_id = $teacher_id;
            } elseif ($user_type === 'student' && !empty($student_id)) {
                $user_specific_id = $student_id;
            } else {
                $user_specific_id = null;
            }

            if ($form_valid) {
                $conn->begin_transaction();

                try {
                    $sql = "INSERT INTO users (name, email, password, user_type, user_specific_id, phone_no, course) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssss", $name, $email, $hashed_password, $user_type, $user_specific_id, $phone_no, $course);

                    if ($stmt->execute()) {
                        if ($user_type === 'teacher' && !empty($teacher_id)) {
                            $sql_teacher = "INSERT INTO teacher (id, teacher_name, email, teacher_id, phone_no) VALUES (NULL, ?, ?, ?, ?)";
                            $stmt_teacher = $conn->prepare($sql_teacher);
                            $stmt_teacher->bind_param("ssss", $name, $email, $teacher_id, $phone_no);
                            $stmt_teacher->execute();
                            $stmt_teacher->close();
                        } elseif ($user_type === 'student' && !empty($student_id)) {
                            $sql_student = "INSERT INTO student (id, student_name, student_id, email, phone_no, course_id) VALUES (NULL, ?, ?, ?, ?, ?)";
                            $stmt_student = $conn->prepare($sql_student);
                            $stmt_student->bind_param("sssss", $name, $student_id, $email, $phone_no, $course);
                            $stmt_student->execute();
                            $stmt_student->close();
                        }

                        $conn->commit();

                        $_SESSION['registration_success'] = true;
                        header("Location: ./login.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } catch (Exception $e) {
                    $conn->rollback();
                    echo "Error: " . $e->getMessage();
                }

                $conn->close();
            }
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
        max-width: 350px;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
    }

    .password-container {
        position: relative;
        width: 100%;
    }

    .password-container input {
        width: 100%;
        padding-right: 45px;
        box-sizing: border-box;
    }

    .password-container .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        font-size: 1.2em;
    }

    .password-container input:focus {
        outline: none;
        border-color: #007bff;
    }

    .form-outline input,
    .form-outline select {
        width: 100%;
    }

    #studentIdContainer .row .col-md-6 {
        padding-right: 10px;
        padding-left: 10px;
    }
</style>

<body>
    <form method="post" action="">
        <div class="form-container card " style="padding: 30px;">
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
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

            <div class="form-outline mb-4">
                <label class="form-label" for="registername">Name</label>
                <input type="text" id="registername" name="name" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" id="registerEmail" name="email" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="phone_no">Phone Number</label>
                <input type="text" id="phone_no" name="phone_no" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="userType">Your Role</label>
                <select id="userType" name="user_type" class="form-control" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <div id="teacherIdContainer" class="form-outline mb-4" style="display: none;">
                <label class="form-label" for="teacherId">Teacher ID</label>
                <input type="text" id="teacherId" name="teacher_id" class="form-control" />
            </div>

            <div id="studentIdContainer" class="form-outline mb-4" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="studentId">Student ID</label>
                        <input type="text" id="studentId" name="student_id" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="course">Course</label>
                        <select type="text" id="course" name="course" class="form-control">
                            <option value="" disabled selected>Select a course</option>
                            <?php foreach ($courses as $course_id): ?>
                                <option value="<?php echo $course_id; ?>"><?php echo $course_id; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <div class="password-container">
                    <input type="password" id="registerPassword" name="password" class="form-control" required />
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>

            <div class="form-check d-flex mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck"
                    aria-describedby="registerCheckHelpText" required />
                <label class="form-check-label" for="registerCheck">
                    I have read and agree to the terms.
                </label>
            </div>

            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                class="btn btn-primary btn-block mb-3">Register</button>
        </div>

    </form>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const repeatPasswordField = document.getElementById('registerPassword');
            const toggleRepeatPasswordIcon = document.getElementById('togglePassword');

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

            const userTypeSelect = document.getElementById('userType');
            const teacherIdContainer = document.getElementById('teacherIdContainer');
            const studentIdContainer = document.getElementById('studentIdContainer');

            userTypeSelect.addEventListener('change', function () {
                const selectedType = this.value;

                if (selectedType === 'teacher') {
                    teacherIdContainer.style.display = 'block';
                    studentIdContainer.style.display = 'none';
                } else if (selectedType === 'student') {
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