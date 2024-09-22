<?php
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php"); 
    exit();
}

include('config.php');


$user_id = $_SESSION['user_id'];


$sql = "SELECT student_name, student_id, email, phone_no, course FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>User Type:</strong> <?php echo htmlspecialchars($user['user_type']); ?></p>

    <a href="logout.php">Logout</a> <!-- Option to logout -->
</body>
</html>
