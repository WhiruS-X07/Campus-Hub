<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

if (isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $course_type = $_POST['course_type'];
    $duration_value = $_POST['duration']; 
    $duration_type = $_POST['duration_type']; 
    $duration = $duration_value . ' ' . $duration_type; 
    $description = $_POST['description'];
    $fee_structure = $_POST['fee_structure'];
    $eligibility = $_POST['eligibility'];
    $specialization = $_POST['specialization'];

    $sql = "INSERT INTO course_info (course_id, course_name, course_type, duration, description, fee_structure, eligibility, specialization) 
            VALUES ('$course_id', '$course_name', '$course_type', '$duration', '$description', '$fee_structure', '$eligibility', '$specialization')";

    if (mysqli_query($conn, $sql)) {
        $msg = "Course added successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<style>
    .form-control {
        height: calc(2.25rem + 2px);
    }

    textarea.form-control {
        height: auto;
        min-height: calc(2.25rem + 2px);
        overflow: hidden;
        resize: none;
    }

    textarea.form-control::-webkit-scrollbar {
        display: none;
    }

    textarea.form-control {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Course</h4>
                        <?php if (isset($msg)) {
                            echo '<div class="alert alert-success">' . $msg . '</div>';
                        } ?>
                        <?php if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        } ?>
                        <form class="form-sample" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course ID</label>
                                        <input type="text" name="course_id" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Eligibility</label>
                                        <input type="text" name="eligibility" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specialization</label>
                                        <input type="text" name="specialization" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Course Type</label>
                                        <select name="course_type" class="form-control" required>
                                            <option value="" disabled selected>Select Course Type</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Certificate">Certificate</option>
                                            <option value="Degree">Degree</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Duration</label>
                                        <div class="d-flex">
                                            <input type="text" name="duration" class="form-control me-3" required>
                                            <select name="duration_type" class="form-control" required>
                                                <option value="" disabled selected>Select Duration Type</option>
                                                <option value="Months">Months</option>
                                                <option value="Years">Years</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fee</label>
                                        <input type="text" name="fee_structure" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>