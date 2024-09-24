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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    $sql_delete = "DELETE FROM course_info WHERE course_id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("s", $course_id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['message'] = "Course deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting course: " . $conn->error;
    }

    header("Location: course.php");
    exit();
}

$sql_courses = "SELECT course_id, course_name, course_type, duration, description, fee_structure, eligibility, specialization FROM course_info";
$result_courses = $conn->query($sql_courses);

if (!$result_courses) {
    echo "Error fetching courses: " . $conn->error;
    exit();
}

ob_end_flush();
?>

<style>
    .card {
        height: 280px;
        display: flex;
        flex-direction: column;
        border: 2px solid #6f42c1;
        border-radius: 8px;
    }

    .card-body {
        flex-grow: 1;
    }

    .divider {
        margin: 10px 0;
        border: 1px solid #6f42c1;
    }

    .description {
        margin-bottom: 20px;
    }

    .flex-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .delete-btn {
        background-color: rgba(111, 66, 193, 0.5);
        border: none;
        color: white;
    }

    .delete-btn:hover {
        background-color: rgba(111, 66, 193, 0.7);
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php while ($course = $result_courses->fetch_assoc()): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card" style="margin-top: 20px;">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-center" style="font-size: 1.5rem;">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                                (<?php echo htmlspecialchars($course['course_id']); ?>)
                            </h5>
                            <hr class="divider">
                            <p class="description" style="margin-bottom: 20px;">
                                <?php echo htmlspecialchars(substr($course['description'], 0, 100)); ?>...
                            </p>
                            <div class="d-flex justify-content-between">
                                <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
                                <p><strong>Fee:</strong> ₹ <?php echo htmlspecialchars($course['fee_structure']); ?></p>
                            </div>
                            <p>
                                <strong>Eligibility:</strong> <?php echo htmlspecialchars($course['eligibility']); ?>
                            </p>
                            <div class="flex-row">
                                <p>
                                    <strong>Specialization:</strong>
                                    <?php echo htmlspecialchars($course['specialization']); ?>
                                </p>
                                <form style="display: inline;" method="post" action="" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="course_id"
                                        value="<?php echo htmlspecialchars($course['course_id']); ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm delete-btn">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this course?");
    }
</script>