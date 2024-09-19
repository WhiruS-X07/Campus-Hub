<?php include('includes/header.php') ?>
<?php include('includes/config.php') ?>
<?php
// Query to fetch courses
$sql_courses = "SELECT * FROM courses";
$result_courses = $conn->query($sql_courses);

// Query to fetch teachers
$sql_teachers = "SELECT * FROM teacher_info";
$result_teachers = $conn->query($sql_teachers);

?>
<body>
  <!--Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #248AFD;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#"><B>Home</B>
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><b>About Us</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><b>Courses</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><b>Events</b></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item dropdown">
          <?php if (isset($_SESSION['login'])) { ?>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user mr-2"></i>Account
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item" href="./admin/dashboard.php">Dashboard</a>
              <a class="dropdown-item" href="./logout.php">Logout</a>
            </div>
          <?php } else { ?>
            <a href="./login.php" class="nav-link"><i class="fa fa-user mr-2"></i>User login</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </nav>
  <!--/.Navbar -->

  <!--Query form-->
  <div class="py-5 shadow" style="background:linear-gradient(-45deg, #5E50F9 50%, transparent 50%)">
    <div class="container-fluid my-2">
      <div class="row">
        <div class="col-lg-6 my-auto">
          <h1 class="display-3 font-weight-bold">Addmission Open for 2024-2025</h1>
          <p class="py-lg-4">Admissions open for 2024-2025! Join us for quality education, dedicated teachers, and a
            nurturing environment.<br> Apply now to secure future!</p>
          <a href="" class="btn btn-lg btn-primary">Call to Action</a>
        </div>
        <div class="col-lg-6">
          <div class="col-lg-8 mx-auto card shadow-lg">
            <div class="card-body py-5">
              <h3>Inquiry Form</h3>
              <form action="" method="post" class="">
                <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="form1" class="form-control">
                  <label for="form1">Your Name</label>
                </div>
                <!-- Material input -->
                <div class="md-form">
                  <input type="email" id="email" class="form-control">
                  <label for="email">Your Email</label>
                </div>
                <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="mobile" class="form-control">
                  <label for="mobile">Your Mobile</label>
                </div>
                <!-- Material input -->
                <div class="md-form">
                  <textarea name="" id="message" class="form-control md-textarea" rows="3"></textarea>
                  <label for="message">Your Query</label>
                </div>

                <button class="btn btn-primary btn-block">Submit Form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/Query form-->

  <!-- About us -->
  <section style="text-align: center; padding: 5rem 0;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8" style="padding: 2.5rem 0;">
          <h2 class="font-weight-bold">About Us</h2>
          <div style="padding-right: 3rem; padding-left: 3rem;">
            <p>Welcome to our School, designed to make educational administration effortless and
              efficient. We provide schools with advanced technology to help educators focus on teaching. Our approach
              streamlines administrative tasks, enhances communication, and improves the learning environment for both
              students and teachers</p>
            <p>we believe in the power of education.Our mission is to ensure our school operates smoothly and
              efficiently, providing every student with the best opportunity to succeed. Discover how we can transform
              our educational institution by simplifying operations and fostering a productive environment
            </p>
          </div>
          <a href="about-us.php" class="btn btn-secondary">Know More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Courses -->
  <section class="py-5 bg-light">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">Our Courses</h2>
      <p class="text-muted">Explore a wide range of courses designed to inspire and empower every student.</p>
    </div>

    <div class="container">
      <div class="row">

        <?php if ($result_courses->num_rows > 0) {
          // Output data of each row
          while ($row = $result_courses->fetch_assoc()) { ?>
            <div class="col-lg-3 mb-4">
              <div class="card">
                <div>
                  <img src="./<?php echo $row['course_image']; ?>"
                    alt="<?php echo htmlspecialchars($row['course_name']); ?>"
                    style="width: 100%; height: 200px; object-fit: cover;" class="img-fluid rounded-top">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['course_name']); ?></h5>
                  <p class="card-text">
                    <b>Duration: </b> <?php echo htmlspecialchars($row['duration']); ?> <br>
                    <b>Price: </b> ₹<?php echo number_format($row['price'], 2); ?>
                  </p>
                  <button class="btn btn-block btn-primary btn-sm">Enroll Now</button>
                </div>
              </div>
            </div>
          <?php }
        } else {
          echo "<p class='text-center'>No courses available at the moment.</p>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Teachers -->
  <section class="py-5">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">Our Teachers</h2>
      <p class="text-muted">Meet our dedicated educators who inspire and support every student</p>
    </div>

    <div class="container">
      <div class="row">
        <?php
        if ($result_teachers->num_rows > 0) {
          // Output data of each row
          while ($row = $result_teachers->fetch_assoc()) { ?>
            <div class="col-lg-4 my-5 ">
              <div class="card">
                <div class="position-relative">
                  <img src="./<?php echo $row['teacher_image']; ?>"
                    alt="<?php echo htmlspecialchars($row['teacher_name']); ?>"
                    class="mw-100 border rounded-circle position-absolute"
                    style="top:-50px; width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="card-body pt-5 mt-4">
                  <h5 class="card-title mb-0"><?php echo htmlspecialchars($row['teacher_name']); ?></h5>
                  <p>
                    <i class="fa fa-star text-warning"></i> <?php echo htmlspecialchars($row['ratings']); ?> / 5
                  </p>
                  <p class="card-text">
                    <b>About Teacher: </b> <?php echo htmlspecialchars($row['teacher_description']); ?>
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
    </div>
  </section>


  <!-- Acheivements -->
  <section class="py-5 text-white" style="background:#5E50F9">
    <div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 pr-5">
            <h2>Acheivements</h2>
            <p>Celebrating the success of our students who continuously strive for excellence and make us proud with
              their accomplishments.</p>

            <img src="./assets/images/still-life-851328_1280.jpg" alt="" class="img-fluid rounded">
          </div>
          <div class="col-lg-6 my-auto">
            <div class="row">
              <div class="col-lg-6 mb-4">
                <div class="border rounded">
                  <div class="card-body text-center">
                    <span><i class=" text-warning fas fa-graduation-cap fa-2x"></i></span>
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
    </div>
  </section>


  <!-- Testimonials -->
  <section class="py-5">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold">What People Say</h2>
      <p class="text-muted">Hear from our community about their experiences with our school.</p>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="border rounded position-relative">
            <div class="p-4 text-center">
              "The supportive environment and innovative teaching methods at this school have truly transformed my
              child's learning experience. The dedication of the educators and the seamless administration make it a
              wonderful place for students to thrive."
            </div>
            <i class="fa fa-quote-left fa-3x position-absolute" style="top:.5rem; left: .5rem; opacity:.2"></i>
          </div>
          <div class="text-center mt-4">
            <img src="./assets/images/parent.jpg" alt="" class="rounded-circle border" width="100" height="100"
              style="margin-top: 5px;">
            <h6 class="mb-0 font-weight-bold">Jane Doe</h6>
            <p><i>Parent</i></p>
          </div>
        </div>
        <div class="col-6">
          <div class="border rounded position-relative">
            <div class="p-4 text-center">
              "Our experience at this school has been exceptional. The staff is incredibly dedicated and the technology
              integration has made communication and learning more effective. I highly recommend this school for its
              commitment to excellence."
            </div>
            <i class="fa fa-quote-left fa-3x position-absolute" style="top:.5rem; left: .5rem; opacity:.2"></i>
          </div>
          <div class="text-center mt-4">
            <img src="./assets/images/teacher.jpg" alt="" class="rounded-circle border" width="100" height="100"
              style="margin-top: 5px;">
            <h6 class="mb-0 font-weight-bold">John Smith</h6>
            <p><i>Teacher</i></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('includes/footer.php'); ?>
</body>

</html>

<?php
$conn->close();
?>