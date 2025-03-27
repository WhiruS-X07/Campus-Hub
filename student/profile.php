<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user email
$sql = "SELECT email FROM users_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_email = $user['email'] ?? '';

if (empty($user_email)) {
    echo "User not found!";
    exit();
}

// Get student details
$sql = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <?php
                                $imagePath = !empty($student['student_img']) ? htmlspecialchars($student['student_img']) : '../assets/images/placeholder.jpg';
                                ?>
                                <img class="rounded-circle shadow-lg mb-3" src="<?php echo $imagePath; ?>"
                                    alt="Student Image" style="width: 150px; height: 150px; object-fit: cover;" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="text-primary">Welcome,
                                    <?php echo htmlspecialchars($student['student_name'] ?? 'Student'); ?>!</h4>
                                <p class="text-muted">Enrolment Number:
                                    <strong><?php echo htmlspecialchars($student['student_id'] ?? 'Not available'); ?></strong>
                                </p>
                                <p><i class="fas fa-envelope"></i>
                                    <?php echo htmlspecialchars($student['email'] ?? 'Not available'); ?></p>
                                <p><i class="fas fa-phone"></i>
                                    <?php echo htmlspecialchars($student['phone_no'] ?? 'Not available'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Courses -->
                <div class="card shadow-sm rounded-lg mt-4">
                    <div class="card-body">
                        <h5 class="text-primary">Enrolled Course</h5>
                        <p>Course:
                            <strong><?php echo htmlspecialchars($student['course_id'] ?? 'Not available'); ?></strong>
                        </p>
                        <a href="e-course.php" class="btn btn-primary">Go to Course</a>
                    </div>
                </div>

                <!-- Personal Details -->
                <div class="card shadow-sm rounded-lg mt-4">
                    <div class="card-body">
                        <h5 class="text-primary">Personal Details</h5>
                        <table class="table table-hover">
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo htmlspecialchars($student['student_name'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo htmlspecialchars($student['dob'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlspecialchars($student['email'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td><?php echo htmlspecialchars($student['phone_no'] ?? 'Not available'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Correspondence Details -->
                <div class="card shadow-sm rounded-lg mt-4">
                    <div class="card-body">
                        <h5 class="text-primary">Correspondence Details</h5>
                        <table class="table table-hover">
                            <tr>
                                <th>Address</th>
                                <td><?php echo htmlspecialchars($student['address'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><?php echo htmlspecialchars($student['state'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>Pincode</th>
                                <td><?php echo htmlspecialchars($student['pincode'] ?? 'Not available'); ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo htmlspecialchars($student['country'] ?? 'Not available'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>