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

$sql = "SELECT student_name, student_id, email, phone_no, course_id FROM student WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc(); 
} else {
    echo "User not found!";
    exit();
}


$stmt->close();
$conn->close();
ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="border-radius: 8px;">
                    <div class="card-body" style="padding-bottom: unset">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md col-sm-12">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-3 col-sm-12" style="flex: unset; width: unset;">
                                        <img class="rounded-circle responsive" src="../assets/images/placeholder.jpg"
                                            alt="user-image" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md col-sm-12"></div>
                            <div class="col-md-3 col-sm-12">
                                <table class="table table-responsive table-borderless">
                                    <tr>
                                        <td class="badge badge-pill badge-info"><i class="fas fa-phone"></i></td>
                                        <td><strong><?php echo !empty($student['phone_no']) ? htmlspecialchars($student['phone_no']) : "Not available"; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="badge badge-pill badge-info"><i class="fas fa-envelope"></i></td>
                                        <td><strong><?php echo !empty($student['email']) ? htmlspecialchars($student['email']) : "Not available"; ?></strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card " style="border-radius: 8px; margin-top: 20px;">
                    <div class="card-body">
                        <h4><strong>Enrolled Courses</strong></h4>
                    </div>
                    <hr>
                    <div class="card-body table-responsive">
                        <div class="col-lg-4 dashboard-widget">
                            <div class="card">
                                <div class="card-body text-uppercase">
                                    <h5><?php echo !empty($student['course_id']) ? htmlspecialchars($student['course_id']) : "Not available"; ?>
                                    </h5>
                                </div>
                                <div class="card-body text-uppercase">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p>Enrolment Number:
                                                <?php echo !empty($student['student_id']) ? htmlspecialchars($student['student_id']) : "Not available"; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <a href="e-course.php" class="btn btn-space btn-primary waves-effect waves-light">Click
                                                here</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="card " style="border-radius: 8px; margin-top: 20px;">
                    <div class="card-body">
                        <h4><strong>Personal Details</strong></h4>
                    </div>
                    <hr>
                    <div class="card-body table-responsive">
                        <table class="table ">
                            <tr>
                                <th>Full Name</th>
                                <td colspan="4">
                                    <?php echo !empty($student['student_name']) ? htmlspecialchars($student['student_name']) : "Not available"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>Not available</td>
                                <th>Category</th>
                                <td>UR</td>
                            </tr>
                            <tr>
                                <th>Applicant's Email</th>
                                <td><?php echo !empty($student['email']) ? htmlspecialchars($student['email']) : "Not available"; ?>
                                </td>
                                <th>Mobile Number</th>
                                <td><?php echo !empty($student['phone_no']) ? htmlspecialchars($student['phone_no']) : "Not available"; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card " style="border-radius: 8px; margin-top: 20px;">
                    <div class="card-body">
                        <h4><strong>Correspondence Details</strong></h4>
                    </div>
                    <hr>
                    <div class="card-body table-responsive">
                        <table class="table ">
                            <tr>
                                <th>Address</th>
                                <td>Not available<br></td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>Not available</td>
                            </tr>
                            <tr>
                                <th>State, Pincode</th>
                                <td>Not available</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>Not available</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>