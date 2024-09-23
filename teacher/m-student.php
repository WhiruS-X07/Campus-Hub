<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $student_img = $_FILES['student_img']['name'];
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $semester_year = $_POST['semester_year'];

    // Image upload handling
    $target_dir = "./assets/upload/";
    $target_file = $target_dir . basename($student_img);
    $image_path = $target_file;

    // Ensure the upload directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['student_img']['tmp_name'], $target_file)) {
        // Insert data into the database using mysqli
        $sql = "INSERT INTO student_info (student_img, student_name, student_id, email, phone_no, course, section, semester_year) 
        VALUES ('$image_path', '$student_name', '$student_id', '$email', '$phone_no', '$course', '$section', '$semester_year')";


        if (mysqli_query($conn, $sql)) {
            $msg = "Student added successfully!";
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $error = "Failed to upload the student image.";
    }
}
?>

<!-- Page content for adding student -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Student</h4>
                        <?php if (isset($msg)) {
                            echo '<div class="alert alert-success">' . $msg . '</div>';
                        } ?>
                        <?php if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        } ?>
                        <form class="form-sample" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student Image</label>
                                        <input type="file" name="student_img" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" name="student_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student ID</label>
                                        <input type="text" name="student_id" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_no" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <input type="text" name="course" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <input type="text" name="section" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Semester/Year</label>
                                        <input type="text" name="semester_year" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>