<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

if (isset($_POST['submit'])) {
    $student_img = $_FILES['student_img']['name'];
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $country = $_POST['country'];
    $course_id = $_POST['course_id'];

    $target_dir = "../assets/uploads/";
    $target_file = $target_dir . basename($student_img);
    $image_path = $target_file;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['student_img']['tmp_name'], $target_file)) {
        if (!empty($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $sql = "UPDATE students SET student_img='$image_path', student_name='$student_name', dob='$dob', email='$email', phone_no='$phone_no', address='$address', state='$state', pincode='$pincode', country='$country', course_id='$course_id' WHERE student_id='$edit_id'";
        } else {
            $check_query = "SELECT * FROM students WHERE student_id = '$student_id'";
            $check_result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($check_result) > 0) {
                $error = "A student with this ID already exists.";
            } else {
                $sql = "INSERT INTO students (student_img, student_name, student_id, dob, email, phone_no, address, state, pincode, country, course_id) 
                        VALUES ('$image_path', '$student_name', '$student_id', '$dob', '$email', '$phone_no', '$address', '$state', '$pincode', '$country', '$course_id')";
            }
        }

        if (isset($sql) && mysqli_query($conn, $sql)) {
            $msg = "Student information saved successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Failed to upload the student image.";
    }
}

if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
    $sql = "SELECT * FROM students WHERE student_name LIKE '%$search_query%' OR student_id LIKE '%$search_query%' OR course_id LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM students WHERE student_id='$delete_id'";
    if (mysqli_query($conn, $sql)) {
        $msg = "Student deleted successfully!";
    } else {
        $error = "Error deleting student: " . mysqli_error($conn);
    }
}

if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $edit_sql = "SELECT * FROM students WHERE student_id='$edit_id'";
    $edit_result = mysqli_query($conn, $edit_sql);
    $edit_data = mysqli_fetch_assoc($edit_result);
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo isset($edit_data) ? 'Edit Student' : 'Add Student'; ?></h4>
                        <?php if (isset($msg)) {
                            echo '<div class="alert alert-success">' . $msg . '</div>';
                        } ?>
                        <?php if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        } ?>

                        <form class="form-sample" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="edit_id"
                                value="<?php echo isset($edit_data['student_id']) ? $edit_data['student_id'] : ''; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student Image</label>
                                        <input type="file" name="student_img" class="form-control" <?php echo isset($edit_data) ? '' : 'required'; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" name="student_name" class="form-control"
                                            value="<?php echo isset($edit_data['student_name']) ? $edit_data['student_name'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student ID</label>
                                        <input type="text" name="student_id" class="form-control"
                                            value="<?php echo isset($edit_data['student_id']) ? $edit_data['student_id'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="<?php echo isset($edit_data['dob']) ? $edit_data['dob'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="<?php echo isset($edit_data['email']) ? $edit_data['email'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_no" class="form-control"
                                            value="<?php echo isset($edit_data['phone_no']) ? $edit_data['phone_no'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="<?php echo isset($edit_data['address']) ? $edit_data['address'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control"
                                            value="<?php echo isset($edit_data['state']) ? $edit_data['state'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" name="pincode" class="form-control"
                                            value="<?php echo isset($edit_data['pincode']) ? $edit_data['pincode'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control"
                                            value="<?php echo isset($edit_data['country']) ? $edit_data['country'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course ID</label>
                                        <input type="text" name="course_id" class="form-control"
                                            value="<?php echo isset($edit_data['course_id']) ? $edit_data['course_id'] : ''; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">
                                <?php echo isset($edit_data) ? 'Update Student' : 'Add Student'; ?>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Students</h4>
                    <form method="POST" class="form-inline mb-3 d-flex">
                        <input type="text" name="search_query" class="form-control me-3"
                            placeholder="Enter Student Name, ID, or Course ID" required>
                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </form>

                    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
                        <div class="table-responsive">
                            <table class="table custom-table mt-4">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Student Image</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Course ID</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><img src="<?php echo $row['student_img']; ?>" width="50" height="50"></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <td><?php echo $row['student_id']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone_no']; ?></td>
                                            <td><?php echo $row['course_id']; ?></td>
                                            <td class="text-right">
                                                <form method="POST" style="display:inline-block;">
                                                    <input type="hidden" name="edit_id"
                                                        value="<?php echo $row['student_id']; ?>">
                                                    <button type="submit" name="edit" class="btn btn-info btn-sm">Edit</button>
                                                </form>
                                                <form method="POST" style="display:inline-block;">
                                                    <input type="hidden" name="delete_id"
                                                        value="<?php echo $row['student_id']; ?>">
                                                    <button type="submit" name="delete"
                                                        class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>