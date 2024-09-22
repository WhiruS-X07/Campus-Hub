<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="dashboard.php"><i class="fas fa-user-gear menu-icon"> Admin
                Panel</i></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><i class="fa-solid fa-user-gear"></i></a>
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
<!-- partial -->
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
                <a class="nav-link" data-bs-toggle="collapse" href="#courses" aria-expanded="false"
                    aria-controls="courses">
                    <i class="fas fa-chalkboard menu-icon"></i>
                    <span class="menu-title">Courses</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="courses">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/courses/manage.html">Manage Courses</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/courses/add.html">Add Course</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#teachers" aria-expanded="false"
                    aria-controls="teachers">
                    <i class="fas fa-chalkboard-teacher menu-icon"></i>
                    <span class="menu-title">Teachers</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="teachers">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="pages/teachers/manage.html">Manage Teachers</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="pages/teachers/add.html">Add Teacher</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#students" aria-expanded="false"
                    aria-controls="students">
                    <i class="fas fa-user menu-icon"></i>
                    <span class="menu-title">Students</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="students">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/students/manage.html">Manage Students</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/students/add.html">Add Student</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#timetable" aria-expanded="false"
                    aria-controls="timetable">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span class="menu-title">Timetable</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="timetable">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/timetable/view.html">View Timetable</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/timetable/edit.html">Edit Timetable</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#exams" aria-expanded="false" aria-controls="exams">
                    <i class="fas fa-clipboard-list menu-icon"></i>
                    <span class="menu-title">Exam Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="exams">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/exams/results.html">Exam Results</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/exams/admit-cards.html">Admit Cards</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/exams/form.html">Examination Form</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/exams/schedule.html">Exam Schedule</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#attendance" aria-expanded="false"
                    aria-controls="attendance">
                    <i class="fas fa-user-check menu-icon"></i>
                    <span class="menu-title">Manage Attendance</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="attendance">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/attendance/manage.html">Attendance</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/attendance/manage.html">Leave</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#events" aria-expanded="false"
                    aria-controls="events">
                    <i class="fas fa-calendar-day menu-icon"></i>
                    <span class="menu-title">Manage Events</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="events">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/events/manage.html">Webinar/Seminar</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/events/manage.html">Campus Functions</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/study-materials/manage.html" aria-expanded="false"
                    aria-controls="study-materials">
                    <i class="fas fa-book menu-icon"></i>
                    <span class="menu-title">Manage Study Materials</span>
                </a>
            </li>
        </ul>
    </nav>