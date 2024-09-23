<?php
$pageTitle = "Login Page";
include('includes/header.php');
include('includes/config.php');
?>
<?php
// Initialize error messages
$emailError = $passwordError = $generalError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $emailError = "Email is required.";
        }
        if (empty($password)) {
            $passwordError = "Password is required.";
        }

        if (empty($emailError) && empty($passwordError)) {
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {

                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['login'] = true;

                    
                    if ($row['user_type'] === 'teacher') {
                        header("Location: ./teacher/dashboard.php");
                    } elseif ($row['user_type'] === 'student') {
                        header("Location: ./student/dashboard.php");
                    } else {
                        $generalError = "Invalid user type.";
                    }
                    exit();
                } else {
                    $passwordError = "Incorrect password!";
                }
            } else {
                $emailError = "No user found with this email!";
            }

            $stmt->close();
        }

    } else {
        $generalError = "Required fields are missing.";
    }

    $conn->close();
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
                                <a class="nav-link active" id="tab-login" href="#pills-login" role="tab"
                                    aria-controls="pills-login" aria-selected="true">Login</a>
                            </li>
                            <li class=" nav-item" role="presentation">
                                <a class="nav-link" id="tab-register" href="./register.php" role="tab"
                                    aria-controls="pills-register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="loginEmail">Email</label>
                <input type="email" id="loginEmail" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required />
                <?php if ($emailError): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($emailError); ?></div>
                <?php endif; ?>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="loginPassword">Password</label>
                <!-- Password input with icon inside -->
                <div class="password-container">
                    <input type="password" id="loginPassword" name="password" class="form-control" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>

                <?php if ($passwordError): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($passwordError); ?></div>
                <?php endif; ?>
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="./register.php">Register</a></p>
            </div>
        </div>
        </div>
        </div>
    </form>

    <!-- JavaScript for toggling the password visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the password fields and their respective toggle icons
            const loginPasswordField = document.getElementById('loginPassword');
            const toggleLoginPasswordIcon = document.getElementById('togglePassword');
            // Add event listener for the login password toggle
            if (toggleLoginPasswordIcon) {
                toggleLoginPasswordIcon.addEventListener('click', function () {
                    if (loginPasswordField.type === 'password') {
                        loginPasswordField.type = 'text';
                        toggleLoginPasswordIcon.classList.remove('fa-eye');
                        toggleLoginPasswordIcon.classList.add('fa-eye-slash');
                    } else {
                        loginPasswordField.type = 'password';
                        toggleLoginPasswordIcon.classList.remove('fa-eye-slash');
                        toggleLoginPasswordIcon.classList.add('fa-eye');
                    }
                });
            }
        });

    </script>
</body>

</html>