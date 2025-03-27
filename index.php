<?php
// Including header and configuration files for setting up the environment and connecting to the database
include('includes/header.php');
include('includes/config.php');

// Fetch all courses to display in the "Courses" section
$sql_courses = "SELECT * FROM course_details";
$result_courses = $conn->query($sql_courses);

// Fetch all teacher information to display in the "Teachers" section
$sql_teachers = "SELECT * FROM teachers";
$result_teachers = $conn->query($sql_teachers);

// Handle form submission for inquiries
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_inquiry'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone_no = trim($_POST['phone_no']);
  $message = trim($_POST['message']);

  if (!empty($name) && !empty($email) && !empty($message)) {
    $sql_inquiry = "INSERT INTO inquiries (name, email, phone_no, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_inquiry);
    $stmt->bind_param("ssss", $name, $email, $phone_no, $message);

    if ($stmt->execute()) {
      echo "<p class='text-success'>Inquiry submitted successfully!</p>";
    } else {
      echo "<p class='text-danger'>Error submitting inquiry. Please try again.</p>";
    }
    $stmt->close();
  } else {
    echo "<p class='text-warning'>Please fill in all required fields.</p>";
  }
}

// Check if a user is logged in and retrieve their user type
if (!isset($_SESSION['login']) || $_SESSION['login'] === true) {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query the database to get the user type from users_info
    $sql = "SELECT user_type FROM users_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a valid result is obtained, fetch the user type
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      $user_type = $user["user_type"];
    }
    $stmt->close();
  }
}

$conn->close(); // Close connection after fetching required information
?>


<style>
  html {
    scroll-behavior: smooth;
  }
</style>

<body>
  <!-- Navbar Section -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #248AFD;">

    <!-- Navbar Toggle Button (Bootstrap 5 Syntax) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Items -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#home" style="margin-right: 5px;">
            <i class="fas fa-home"></i> <b>Home</b>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about-us" style="margin-right: 5px;">
            <i class="fas fa-info-circle"></i> <b>About Us</b>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#courses" style="margin-right: 5px;">
            <i class="fas fa-book"></i> <b>Courses</b>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#acheivements" style="margin-right: 5px;">
            <i class="fas fa-trophy"></i> <b>Achievements</b>
          </a>
        </li>
      </ul>

      <!-- User Account Section -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <?php if (isset($_SESSION['login'])) { ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user mr-2"></i><b>Account</b>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink-333">
              <div class="text-center">
                <?php if ($user_type === 'teacher') { ?>
                  <a class="dropdown-item" href="teacher/dashboard.php"><b>Dashboard</b></a>
                <?php } elseif ($user_type === 'student') { ?>
                  <a class="dropdown-item" href="student/dashboard.php"><b>Dashboard</b></a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./logout.php"><b>Logout</b></a>
              </div>
            </div>
          <?php } else { ?>
            <a href="./login.php" class="nav-link"><i class="fa fa-user mr-2"></i><b>User login</b></a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </nav>



  <!-- Home Section -->
  <section id="home">
    <div class="py-5 shadow vh-100 d-flex justify-content-center align-items-center"
      style="background:linear-gradient(-45deg, #5E50F9 50%, transparent 50%)">
      <div class="container-fluid my-2 ">
        <div class="row">
          <div class="col-lg-6 my-auto">
            <h1 class="display-4 fw-bold">Admission Open for 2024-2025</h1>
            <p class="py-lg-4">Admissions open for 2024-2025! Join us for quality education, dedicated teachers, and a
              nurturing environment.<br> Apply now to secure your future!</p>
            <a href="#" class="btn btn-lg btn-primary">Call to Action</a>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-8 mx-auto card shadow-lg">
              <div class="card-body py-5">
                <h3>Inquiry Form</h3>
                <form action="index.php" method="post" class="">
                  <div class="md-form">
                    <input type="text" id="form1" name="name" class="form-control" required>
                    <label for="form1">Your Name</label>
                  </div>
                  <div class="md-form">
                    <input type="email" id="email" name="email" class="form-control" required>
                    <label for="email">Your Email</label>
                  </div>
                  <div class="md-form">
                    <input type="text" id="mobile" name="phone_no" class="form-control" required>
                    <label for="mobile">Your Mobile</label>
                  </div>
                  <div class="md-form">
                    <textarea id="message" name="message" class="form-control md-textarea" rows="3" required></textarea>
                    <label for="message">Your Query</label>
                  </div>
                  <button type="submit" name="submit_inquiry" class="btn btn-primary btn-block">Submit Form</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- About Us Section -->
  <section id="about-us"
    style="text-align: center; padding: 8rem 0; background: url('./assets/images/stil.jpg') no-repeat center center/cover;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10"
          style="padding: 4rem 2rem; background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
          <h2 class="font-weight-bold mb-4" style="font-weight: 900;">About Us</h2>
          <div style="padding-right: 4rem; padding-left: 4rem; font-size: 1.2rem; line-height: 1.8; font-weight: 600;">
            <p>Welcome to our School, where we are committed to making educational administration effortless and
              efficient. Our mission is to empower schools with cutting-edge technology that enhances the teaching and
              learning experience. With a focus on innovation and simplicity, we provide seamless solutions to
              streamline administrative tasks, improve communication, and create an enriching learning environment for
              both students and teachers.</p>

            <p>Our platform is designed to handle everything from attendance management and grade tracking to
              communication between teachers, students, and parents. We believe that reducing administrative burdens
              allows educators to dedicate more time to what truly matters — inspiring and educating the next
              generation.</p>

            <p>At the heart of our mission is the belief that every student deserves the best opportunity to succeed. By
              simplifying operations and providing comprehensive support, we create a collaborative ecosystem where
              growth and learning flourish. Our advanced tools and resources are tailored to meet the unique needs of
              your institution, ensuring smooth management and a focus on academic excellence.</p>
          </div>
          <a href="#" class="btn btn-primary mt-4">Know More</a>
        </div>
      </div>
    </div>
  </section>


  <!-- Courses Section -->
  <section id="courses" class="py-5 bg-light">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">Our Courses</h2>
      <p class="text-muted">Explore a wide range of courses designed to inspire and empower every student.</p>
    </div>

    <div class="container">
      <div class="row" id="courseContainer">
        <?php if ($result_courses->num_rows > 0) {
          $counter = 0;
          while ($row = $result_courses->fetch_assoc()) {
            // Show first 6, hide others using the 'more-courses' class
            $courseClass = ($counter >= 6) ? 'more-courses d-none' : '';
            ?>
            <div class="col-lg-4 mb-4 course-item <?php echo $courseClass; ?>">
              <div class="card h-100 d-flex flex-column">
                <div>
                  <img src="./<?php echo $row['course_image']; ?>"
                    alt="<?php echo htmlspecialchars($row['course_name']); ?>"
                    style="width: 100%; height: 200px; object-fit: cover;" class="img-fluid rounded-top">
                </div>
                <div class="card-body d-flex flex-column flex-grow-1">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['course_name']); ?>
                    (<?php echo strtoupper($row['course_id']); ?>)</h5>
                  <p class="card-text flex-grow-1">
                    <b>Description:</b> <?php echo htmlspecialchars($row['course_description']); ?> <br>
                    <b>Duration:</b> <?php echo htmlspecialchars($row['duration']); ?> <br>
                    <b>Price:</b> ₹<?php echo number_format($row['price'], 2); ?>
                  </p>
                  <button class="btn btn-block btn-primary btn-sm mt-auto">Enroll Now</button>
                </div>
              </div>
            </div>
            <?php
            $counter++;
          }
        } else {
          echo "<p class='text-center'>No courses available at the moment.</p>";
        }
        ?>
      </div>

      <!-- Show More Button -->
      <?php if ($result_courses->num_rows > 6) { ?>
        <div class="text-center mt-4">
          <button class="btn btn-secondary" id="showMoreCoursesBtn">Show More</button>
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- Teachers Section -->
  <section id="teachers" class="py-5">
    <!-- Section Header -->
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">Our Teachers</h2>
      <p class="text-muted">Meet our dedicated educators who inspire and support every student</p>
    </div>

    <!-- Teachers Content Container -->
    <div class="container">
      <div class="row">
        <?php
        // Check if there are any teachers available in the database.
        if ($result_teachers->num_rows > 0) {
          $count = 0;
          while ($row = $result_teachers->fetch_assoc()) {
            $count++;
            $hiddenClass = $count > 6 ? 'd-none more-teachers' : '';
            ?>
            <div class="col-lg-4 my-5 <?php echo $hiddenClass; ?>">
              <div class="card">
                <!-- Teacher Image Container -->
                <div class="position-relative">
                  <img src="./<?php echo htmlspecialchars($row['teacher_image']); ?>"
                    alt="<?php echo htmlspecialchars($row['teacher_name']); ?>"
                    class="mw-100 border rounded-circle position-absolute"
                    style="top: -50px; width: 120px; height: 120px; object-fit: cover;">
                </div>

                <!-- Teacher Details in the Card Body -->
                <div class="card-body pt-5 mt-4">
                  <h5 class="card-title mb-0"><?php echo htmlspecialchars($row['teacher_name']); ?></h5>
                  <p><b>Email:</b> <?php echo htmlspecialchars($row['email']); ?></p>
                  <p class="card-text"><b>About Teacher:</b> <?php echo htmlspecialchars($row['teacher_description']); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php }
        } else {
          echo "<p class='text-center'>No teachers available at the moment.</p>";
        }
        ?>
      </div>

      <!-- Show More Button -->
      <?php if ($count > 6) { ?>
        <div class="text-center mt-4">
          <button id="showMoreBtn" class="btn btn-primary">Show More</button>
        </div>
      <?php } ?>
    </div>
  </section>




  <!-- Achievements Section -->
  <section id="acheivements" class="py-5 text-white" style="background: #5E50F9;">
    <div class="container">
      <!-- Section Header -->
      <div class="text-center">
        <!-- Achievements Icon and Title -->
        <div class="d-flex justify-content-center align-items-center">
          <i class="fas fa-trophy" style="color: gold; font-size: 2rem; margin-right: 0.5rem;"></i>
          <h2 style="margin: 0;">Achievements</h2>
        </div>
        <p>Celebrating the success of our students who continuously strive for excellence and make us proud with their
          accomplishments.</p>
      </div>

      <!-- Achievements Content Row -->
      <div class="row">
        <!-- Achievements Image -->
        <div class="col-lg-6">
          <img src="./assets/images/ache.png" alt="Achievements Image" class="img-fluid rounded">
        </div>

        <!-- Achievements Statistics -->
        <div class="col-lg-6 my-auto">
          <div class="row">
            <!-- Individual Achievement Statistics Cards -->
            <div class="col-lg-6 mb-4">
              <div class="border rounded">
                <div class="card-body text-center">
                  <span><i class="text-warning fas fa-graduation-cap fa-2x"></i></span>
                  <h2 class="my-2 font-weight-bold h1">334</h2>
                  <hr class="border-warning">
                  <h4>Graduates</h4>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="border rounded">
                <div class="card-body text-center">
                  <span><i class="text-primary fas fa-trophy fa-2x"></i></span>
                  <h2 class="my-2 font-weight-bold h1">286</h2>
                  <hr class="border-warning">
                  <h4>Top Performers</h4>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="border rounded">
                <div class="card-body text-center">
                  <span><i class="text-success fas fa-briefcase fa-2x"></i></span>
                  <h2 class="my-2 font-weight-bold h1">238</h2>
                  <hr class="border-warning">
                  <h4>Placements</h4>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <div class="border rounded">
                <div class="card-body text-center">
                  <span><i class="text-info fas fa-medal fa-2x"></i></span>
                  <h2 class="my-2 font-weight-bold h1">106</h2>
                  <hr class="border-warning">
                  <h4>Scholarships</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-5">
    <!-- Section Header -->
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">What People Say</h2>
      <p class="text-muted">Hear from our community about their experiences with our school.</p>
    </div>

    <!-- Testimonials Container -->
    <div class="container">
      <div class="row">
        <!-- Individual Testimonial -->
        <div class="col-6">
          <div class="border rounded position-relative">
            <!-- Testimonial Text -->
            <div class="p-4 text-center">
              "The supportive environment and innovative teaching methods at this school have truly transformed my
              child's learning experience. The dedication of the educators and the seamless administration make it a
              wonderful place for students to thrive."
            </div>
            <i class="fa fa-quote-left fa-3x position-absolute" style="top: .5rem; left: .5rem; opacity: .2;"></i>
          </div>
          <!-- Testimonial Author Information -->
          <div class="text-center mt-4">
            <img src="assets/images/placeholder.jpg" alt="Parent Image" class="rounded-circle border" width="100"
              height="100" style="margin-top: 5px;">
            <h6 class="mb-0 font-weight-bold">Ravi Kumar</h6>
            <p><i>Parent</i></p>
          </div>
        </div>

        <!-- Second Testimonial -->
        <div class="col-6">
          <div class="border rounded position-relative">
            <!-- Testimonial Text -->
            <div class="p-4 text-center">
              "Our experience at this school has been exceptional. The staff is incredibly dedicated and the technology
              integration has made communication and learning more effective. I highly recommend this school for its
              commitment to excellence."
            </div>
            <i class="fa fa-quote-left fa-3x position-absolute" style="top: .5rem; left: .5rem; opacity: .2;"></i>
          </div>
          <!-- Testimonial Author Information -->
          <div class="text-center mt-4">
            <img src="assets/images/placeholder.jpg" alt="Teacher Image" class="rounded-circle border" width="100"
              height="100" style="margin-top: 5px;">
            <h6 class="mb-0 font-weight-bold">John Smith</h6>
            <p><i>Teacher</i></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <?php include('includes/footer.php'); ?>
</body>

<!-- JavaScript to Handle Active Navigation Link based on Scroll Position -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    window.addEventListener('scroll', function () {
      let currentSection = '';

      // Determine which section is currently in view.
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 80; // Adjust for navbar height
        const sectionHeight = section.clientHeight;

        if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
          currentSection = section.getAttribute('id');
        }
      });

      // Highlight the corresponding navigation link.
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').includes(currentSection)) {
          link.classList.add('active');
        }
      });
    });
  });


  document.getElementById('showMoreBtn')?.addEventListener('click', function () {
    const hiddenTeachers = document.querySelectorAll('.more-teachers');
    hiddenTeachers.forEach(teacher => teacher.classList.remove('d-none'));
    this.style.display = 'none'; // Hide the button after displaying
  });

  document.getElementById('showMoreCoursesBtn')?.addEventListener('click', function () {
    const hiddenCourses = document.querySelectorAll('.more-courses');
    hiddenCourses.forEach(course => course.classList.remove('d-none'));
    this.style.display = 'none'; // Hide the button after displaying
  });

</script>

</html>