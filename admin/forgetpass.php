<?php
// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header('Content-Type: application/json');
    die(json_encode(array("status" => "error", "message" => "Database connection failed.")));
}

// Check if the request is made via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    
    $email = $conn->real_escape_string($_POST['email']);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP in the database
        $update_sql = "UPDATE users SET otp = '$otp', otp_expiry = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = '$email'";
        if ($conn->query($update_sql) === TRUE) {
            $subject = "Password Reset Request";
            $message = "Your OTP for resetting the password is: " . $otp . "\nThis OTP is valid for 15 minutes.";
            $headers = "From: no-reply@example.com";

            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(array("status" => "success", "message" => "OTP sent to your email!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error sending OTP."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Error updating OTP in the database."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Email not found."));
    }
}

$conn->close();
?>
