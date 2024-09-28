<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="dashboard.php"><i class="fas fa-user-graduate  menu-icon">
                S-Panel</i></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><i class="fa-solid fa-user-graduate "></i></a>
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
                <a class="nav-link" href="e-course.php" aria-expanded="false" aria-controls="courses">
                    <i class="fas fa-chalkboard menu-icon"></i>
                    <span class="menu-title">My Courses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="e-timetable.php" aria-expanded="false" aria-controls="timetable">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span class="menu-title">My Timetable</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="examsub.php" aria-expanded="false" aria-controls="exam">
                    <i class="fas fa-pencil-alt menu-icon"></i>
                    <span class="menu-title">Exam Registration</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php" aria-expanded="false" aria-controls="study-materials">
                    <i class="fas fa-user menu-icon"></i>
                    <span class="menu-title">Profile</span>
                </a>
            </li>
        </ul>
    </nav>