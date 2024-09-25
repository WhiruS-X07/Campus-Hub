<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="dashboard.php"><i class="fas fa-chalkboard-user"></i>
            T-Panel</i></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><i class="fas fa-chalkboard-user"></i></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile ">
                <a href="../index.php" class="nav-link" title="Home">
                    <i class="fas fa-house"></i>
                </a>
            </li>
            <li class="nav-item nav-profile ">
                <a href="../logout.php" class="nav-link" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#course" aria-expanded="false"
                    aria-controls="course">
                    <i class="fas fa-chalkboard menu-icon"></i>
                    <span class="menu-title">About Course</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="course">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="course_info.php">Courses Info</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="m-course.php">Add Course</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#students" aria-expanded="false"
                    aria-controls="students">
                    <i class="fas fa-user-graduate menu-icon"></i>
                    <span class="menu-title">Students</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="students">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="student_info.php">Students Info</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="m-student.php">Manage Students</a></li>
                        <li class="nav-item"> <a class="nav-link" href="attendance.php">Manage Attendance</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#timetables" aria-expanded="false"
                    aria-controls="timetables">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span class="menu-title">Timetable</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="timetables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="timetable_info.php">View Timetable</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="m-timetable.php">Edit Timetable</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="m-teacher.php" aria-expanded="false" aria-controls="profile-teacher">
                    <i class="fas fa-user menu-icon"></i>
                    <span class="menu-title">Teacher Profile</span>
                </a>
            </li>
        </ul>
    </nav>