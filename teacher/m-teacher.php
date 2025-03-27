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

$sql = "SELECT * FROM teachers WHERE email = ?";
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
                <div class="card shadow-lg rounded-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <img class="rounded-circle img-fluid"
                                    src="<?php echo !empty($teacher['teacher_image']) ? '../uploads/' . htmlspecialchars($teacher['teacher_image']) : '../assets/images/teacher.jpg'; ?>"
                                    alt="user-image" width="150" height="150" />
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><i class="fas fa-id-badge"></i> <strong>ID:</strong></td>
                                        <td><?php echo htmlspecialchars($teacher['teach_id'] ?? "Not available"); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-phone"></i> <strong>Phone:</strong></td>
                                        <td><?php echo htmlspecialchars($teacher['phone_no'] ?? "Not available"); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-envelope"></i> <strong>Email:</strong></td>
                                        <td><?php echo htmlspecialchars($teacher['email'] ?? "Not available"); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-lg rounded-lg mt-4">
                    <div class="card-body">
                        <h4 class="mb-3">Personal Details</h4>
                        <table class="table table-striped">
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo htmlspecialchars($teacher['teacher_name'] ?? "Not available"); ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo htmlspecialchars($teacher['dob'] ?? "Not available"); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card shadow-lg rounded-lg mt-4">
                    <div class="card-body">
                        <h4 class="mb-3">Correspondence Details</h4>
                        <table class="table table-striped">
                            <tr>
                                <th>Address</th>
                                <td><?php echo htmlspecialchars($teacher['address'] ?? "Not available"); ?></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><?php echo htmlspecialchars($teacher['state'] ?? "Not available"); ?></td>
                            </tr>
                            <tr>
                                <th>Pincode</th>
                                <td><?php echo htmlspecialchars($teacher['pincode'] ?? "Not available"); ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo htmlspecialchars($teacher['country'] ?? "Not available"); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>