<?php
ob_start();
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

$course_query = "SELECT * FROM course_details";
$course_result = mysqli_query($conn, $course_query);

$subject_result = [];
$selected_course_id = "";

if (isset($_POST['course_id'])) {
    $selected_course_id = $_POST['course_id'];
    $subject_query = "SELECT * FROM subject_details WHERE course_id='$selected_course_id'";
    $subject_result = mysqli_query($conn, $subject_query);
}

$timetable_entry = null;
if (isset($_GET['id'])) {
    $timetable_id = $_GET['id'];
    $timetable_query = "SELECT * FROM timetable_info WHERE id='$timetable_id'";
    $timetable_entry = mysqli_fetch_assoc(mysqli_query($conn, $timetable_query));
}

if (isset($_POST['save_timetable'])) {
    $course_id = $_POST['course_id'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $subject_id = $_POST['subject_id'];

    if ($timetable_entry) {
        $update_query = "UPDATE timetable_info SET 
                            course_id='$course_id', 
                            day='$day', 
                            start_time='$start_time', 
                            end_time='$end_time', 
                            subject_id='$subject_id' 
                        WHERE id='$timetable_id'";
       if (mysqli_query($conn, $update_query)) {
        $_SESSION['success_msg'] = "Timetable Updated Successfully";
    } else {
        $_SESSION['error_msg'] = "Error updating timetable: " . mysqli_error($conn);
    }
} else {
    $insert_query = "INSERT INTO timetable_info (course_id, day, start_time, end_time, subject_id) 
                     VALUES ('$course_id', '$day', '$start_time', '$end_time', '$subject_id')";
    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['success_msg'] = "Timetable Added Successfully";
    } else {
        $_SESSION['error_msg'] = "Error adding timetable: " . mysqli_error($conn);
    }
}
header('Location: m-timetable.php');
exit;
}
ob_end_flush();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h2><?php echo $timetable_entry ? 'Edit Timetable' : 'Add Timetable'; ?></h2>
                <?php if (isset($_SESSION['success_msg'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success_msg']; ?>
                        <?php unset($_SESSION['success_msg']); ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="course_id">Select Course:</label>
                        <select name="course_id" id="course_id" class="form-control" required onchange="this.form.submit()">
                            <option value="">Select Course</option>
                            <?php while ($course_row = mysqli_fetch_assoc($course_result)): ?>
                                <option value="<?php echo $course_row['course_id']; ?>" 
                                    <?php if ($selected_course_id == $course_row['course_id']) echo 'selected'; ?>>
                                    <?php echo $course_row['course_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">Select Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">Select Subject</option>
                            <?php if (!empty($subject_result)): ?>
                                <?php while ($subject_row = mysqli_fetch_assoc($subject_result)): ?>
                                    <option value="<?php echo $subject_row['subject_id']; ?>" 
                                        <?php if ($timetable_entry && $timetable_entry['subject_id'] == $subject_row['subject_id']) echo 'selected'; ?>>
                                        <?php echo $subject_row['subject_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="day">Day:</label>
                        <select name="day" id="day" class="form-control" required>
                            <option value="">Select Day</option>
                            <?php
                            $days_of_week = [
                                1 => 'Monday',
                                2 => 'Tuesday',
                                3 => 'Wednesday',
                                4 => 'Thursday',
                                5 => 'Friday',
                                6 => 'Saturday',
                                7 => 'Sunday'
                            ];
                            foreach ($days_of_week as $value => $day): ?>
                                <option value="<?php echo $value; ?>" 
                                    <?php if ($timetable_entry && $timetable_entry['day'] == $value) echo 'selected'; ?>>
                                    <?php echo $day; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" name="start_time" class="form-control" value="<?php echo $timetable_entry ? $timetable_entry['start_time'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" name="end_time" class="form-control" value="<?php echo $timetable_entry ? $timetable_entry['end_time'] : ''; ?>" required>
                    </div>
                    
                    <button type="submit" name="save_timetable" class="btn btn-primary mt-4">
                        <?php echo $timetable_entry ? 'Update Timetable' : 'Add Timetable'; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
