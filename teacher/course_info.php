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

    $sql_delete = "DELETE FROM course_details WHERE course_id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("s", $course_id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['message'] = "Course deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting course: " . $conn->error;
    }

    header("Location: course_info.php");
    exit();
}

$sql_courses = "SELECT * FROM course_details";
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
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-sm" style="margin-top: 20px; border-radius: 12px; overflow: hidden;">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-center text-primary" style="font-size: 1.35rem;">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </h5>
                            <p class="text-center text-muted mb-2">(<?php echo htmlspecialchars($course['course_id']); ?>)
                            </p>
                            <hr class="divider">

                            <!-- Full description stored in a data attribute -->
                            <p class="description text-justify"
                                data-full-description="<?php echo htmlspecialchars($course['course_description']); ?>">
                                <?php echo htmlspecialchars(substr($course['course_description'], 0, 120)); ?>...
                            </p>

                            <div class="d-flex justify-content-between flex-wrap">
                                <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
                                <p><strong>Fee:</strong> ₹<?php echo htmlspecialchars($course['fee_structure']); ?></p>
                            </div>
                            <div class="d-flex justify-content-between flex-wrap">
                                <p><strong>Eligibility:</strong> <?php echo htmlspecialchars($course['eligibility']); ?></p>
                                <p><strong>Course Type:</strong> <?php echo htmlspecialchars($course['course_type']); ?></p>
                            </div>
                            <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($course['price']); ?></p>

                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <p class="mb-1 text-wrap"
                                    style="word-wrap: break-word; overflow-wrap: break-word; max-width: 75%;">
                                    <strong>Specialization:</strong>
                                    <?php echo htmlspecialchars($course['specialization']); ?>
                                </p>

                                <form method="post" action="" onsubmit="return confirmDelete();" style="display: inline;">
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
    // JavaScript to adjust the description length based on screen size
    document.addEventListener("DOMContentLoaded", function () {
        const descriptions = document.querySelectorAll(".description");

        descriptions.forEach(function (description) {
            const fullText = description.getAttribute("data-full-description");
            const screenWidth = window.innerWidth;

            // Set description length based on screen size
            let shortenedText = screenWidth < 768 ? fullText.substring(0, 70) : fullText.substring(0, 100);
            description.textContent = shortenedText + '...';
        });

        // Adjust description when the window is resized
        window.addEventListener("resize", function () {
            descriptions.forEach(function (description) {
                const fullText = description.getAttribute("data-full-description");
                const screenWidth = window.innerWidth;
                let shortenedText = screenWidth < 768 ? fullText.substring(0, 70) : fullText.substring(0, 100);
                description.textContent = shortenedText + '...';
            });
        });
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this course?");
    }
</script>