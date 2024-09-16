<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
                    // Start session and set session variables
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['username']; // assuming you have a username column

                    $_SESSION['login'] = true;  // or set with user ID if you want

                    // Redirect to index.php
                    header("Location: ./index.php");
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

<?php
$pageTitle = "Login Page";
$pageCss = '<link href="./style.css" rel="stylesheet">';
$pageJs = '<script src="./script.js" type="text/javascript"></script>';
include 'header.php';
?>

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

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <div class="text-center mb-3">
                        <p>Sign in with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>

                    <p class="text-center">or:</p>

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

                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" />
                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Simple link -->
                            <a href="./forgetpass.html">Forgot password?</a>
                        </div>
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
</body>

</html>