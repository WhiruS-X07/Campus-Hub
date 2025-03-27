<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $course_id = trim($_POST['course_id']);
    $course_name = trim($_POST['course_name']);
    $course_type = trim($_POST['course_type']);
    $duration_value = trim($_POST['duration']);
    $duration_type = trim($_POST['duration_type']);
    $duration = $duration_value . ' ' . $duration_type;
    $description = trim($_POST['description']);
    $fee_structure = trim($_POST['fee_structure']);
    $total_price = trim($_POST['total_price']);
    $eligibility = trim($_POST['eligibility']);
    $specialization = trim($_POST['specialization']);

    // Prepare SQL query to prevent SQL injection
    $sql = "INSERT INTO course_details (course_id, course_name, course_type, duration, course_description, fee_structure, total_price, eligibility, specialization) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $course_id, $course_name, $course_type, $duration, $description, $fee_structure, $total_price, $eligibility, $specialization);

    if ($stmt->execute()) {
        $msg = "✅ Course added successfully!";
    } else {
        $error = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .form-control {
        height: 45px;
        border-radius: 10px;
        box-shadow: none;
        border: 1px solid #ced4da;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    textarea.form-control {
        min-height: 120px;
        resize: none;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        background: #fff;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-label {
        font-weight: 500;
    }

    .alert {
        padding: 10px;
        border-radius: 8px;
    }

    .input-group-text {
        background-color: #007bff;
        color: white;
        border-radius: 8px 0 0 8px;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card mt-4 p-4">
                    <div class="card-body">
                        <h4 class="card-title text-center text-primary fw-bold">➕ Add New Course</h4>

                        <?php if (isset($msg)) {
                            echo '<div class="alert alert-success text-center">' . $msg . '</div>';
                        } ?>
                        <?php if (isset($error)) {
                            echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                        } ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Course ID <span class="text-danger">*</span></label>
                                        <input type="text" name="course_id" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Course Name <span class="text-danger">*</span></label>
                                        <input type="text" name="course_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Eligibility</label>
                                    <input type="text" name="eligibility" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Specialization</label>
                                    <input type="text" name="specialization" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Course Type <span class="text-danger">*</span></label>
                                    <select name="course_type" class="form-control" required>
                                        <option value="" disabled selected>Select Course Type</option>
                                        <option value="Undergraduate">Undergraduate</option>
                                        <option value="Postgraduate">Postgraduate</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Duration <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="duration" class="form-control" required
                                            placeholder="Enter duration">
                                        <select name="duration_type" class="form-control">
                                            <option value="Months">Months</option>
                                            <option value="Years">Years</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Fee Structure <span class="text-danger">*</span></label>
                                    <input type="number" name="fee_structure" class="form-control" required>
                                </div>



                                <div class="col-md-6">
                                    <label class="form-label">Total Price (₹) <span class="text-danger">*</span></label>
                                    <input type="number" name="total_price" class="form-control" min="0" required>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">Course Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary mt-4">📌 Add Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>