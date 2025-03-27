<?php
session_start();
include("header.php");
include("sidebar.php");
include('../includes/config.php');

// Fetch all courses
$course_query = "SELECT * FROM course_details";
$course_result = mysqli_query($conn, $course_query);
$timetable_result = null;

if (isset($_POST['view_timetable'])) {
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);

    $timetable_query = "SELECT t.*, s.subject_name 
                        FROM timetable_info t 
                        JOIN subject_details s ON t.subject_id = s.subject_id 
                        WHERE t.course_id = '$course_id'";
    $timetable_result = mysqli_query($conn, $timetable_query);
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h2>View Timetable</h2>

                <form method="POST" action="" class="mb-4">
                    <div class="form-group">
                        <label for="course_id">Select Course:</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="">Select Course</option>
                            <?php while ($course_row = mysqli_fetch_assoc($course_result)): ?>
                                <option value="<?php echo htmlspecialchars($course_row['course_id']); ?>">
                                    <?php echo htmlspecialchars($course_row['course_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" name="view_timetable" class="btn btn-primary">View Timetable</button>
                </form>

                <?php if ($timetable_result && mysqli_num_rows($timetable_result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($timetable_result)): ?>
                                    <tr>
                                        <td><?php echo getDayName($row['day']); ?></td>
                                        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                                        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <?php if (isset($_POST['view_timetable'])): ?>
                        <div class="alert alert-warning mt-4" role="alert">
                            No timetable found for the selected course.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Function to get the day name from number
function getDayName($dayNumber)
{
    $days_of_week = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday'
    ];
    return isset($days_of_week[$dayNumber]) ? $days_of_week[$dayNumber] : 'Unknown';
}

include("footer.php");
?>