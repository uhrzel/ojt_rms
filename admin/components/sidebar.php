<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <?php if($curr_page == 'index.php' || $curr_page == 'organization.php') : ?>
                    <a class="nav-link collapsed pt-4 active" href="index.php">
                        <div class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </div>
                        Dashboard
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed pt-4" href="index.php">
                        <div class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </div>
                        Dashboard
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'coordinators.php' || $curr_page == 'coordinator.php') : ?>
                    <a class="nav-link collapsed active" href="coordinators.php">
                        <div class="nav-link-icon">
                            <i data-feather="user-check"></i>
                        </div>
                        Coordinator
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="coordinators.php">
                        <div class="nav-link-icon">
                            <i data-feather="user-check"></i>
                        </div>
                        Coordinator
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'students.php' || $curr_page == 'student.php') : ?>
                    <a class="nav-link collapsed active" href="students.php">
                        <div class="nav-link-icon">
                            <i data-feather="users"></i>
                        </div>
                        Students
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="students.php">
                        <div class="nav-link-icon">
                            <i data-feather="users"></i>
                        </div>
                        Students
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'courses.php' || $curr_page == 'course.php') : ?>
                    <a class="nav-link collapsed active" href="courses.php">
                        <div class="nav-link-icon">
                            <i data-feather="book"></i>
                        </div>
                        Courses
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="courses.php">
                        <div class="nav-link-icon">
                            <i data-feather="book"></i>
                        </div>
                        Courses
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title">
                        Administrator
                    </div>
                </div>
            </div>

        </nav>
    </div>