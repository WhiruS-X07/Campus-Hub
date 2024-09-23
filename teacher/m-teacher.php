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

$sql = "SELECT teacher_name, teacher_id, email, phone_no FROM teacher WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $teacher = $result->fetch_assoc();
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
                                        <td class="badge badge-pill badge-info"><i class="fas fa-address-card"></i></td>
                                        <td><strong><?php echo !empty($teacher['teacher_id']) ? htmlspecialchars($teacher['teacher_id']) : "Not available"; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="badge badge-pill badge-info"><i class="fas fa-phone"></i></td>
                                        <td><strong><?php echo !empty($teacher['phone_no']) ? htmlspecialchars($teacher['phone_no']) : "Not available"; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="badge badge-pill badge-info"><i class="fas fa-envelope"></i></td>
                                        <td><strong><?php echo !empty($teacher['email']) ? htmlspecialchars($teacher['email']) : "Not available"; ?></strong>
                                        </td>
                                    </tr>
                                </table>
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
                                    <?php echo !empty($teacher['teacher_name']) ? htmlspecialchars($teacher['teacher_name']) : "Not available"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>Not available</td>
                                <th>Teacher Id</th>
                                <td><?php echo !empty($teacher['teacher_id']) ? htmlspecialchars($teacher['teacher_id']) : "Not available"; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Applicant's Email</th>
                                <td><?php echo !empty($teacher['email']) ? htmlspecialchars($teacher['email']) : "Not available"; ?>
                                </td>
                                <th>Mobile Number</th>
                                <td><?php echo !empty($teacher['phone_no']) ? htmlspecialchars($teacher['phone_no']) : "Not available"; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card " style="border-radius: 8px; margin-top: 20px;">
                    <div class="card-body">
                        <h4><strong>Teaching Details</strong></h4>
                    </div>
                    <hr>
                    <div class="card-body table-responsive">
                        <table class="table ">
                            <tr>
                                <th>B.C.A</th>
                                <td>Not available<br></td>
                            </tr>
                            <tr>
                                <th>M.C.A</th>
                                <td>Not available</td>
                            </tr>
                            <tr>
                                <th>B.tech</th>
                                <td>Not available</td>
                            </tr>
                            <tr>
                                <th>B.Sc (Hons) Mathematics</th>
                                <td>Not available</td>
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