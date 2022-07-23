<?php

use core\helpers\Navigation;

?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <?= Navigation::navItem('admin/dashboard', 'Dashboard') ?>
            <?= Navigation::navItem('admin/account', 'Account') ?>
            <li class="nav-item">
                <a class="nav-link" href="/admin/reports">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Admin Section</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <?= Navigation::navItem('admin/users', 'Users') ?>
            <?= Navigation::navItem('admin/students', 'Students') ?>
            <?= Navigation::navItem('admin/roles', 'Roles') ?>
            <?= Navigation::navItem('admin/grades', 'Grades') ?>
            <?= Navigation::navItem('admin/levels/new', 'Institute Levels') ?>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Admission Section</span>
            <a class="link-secondary" href="#" aria-label="Admission">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <?= Navigation::navItem('admin/admission', 'Admission') ?>
            <?= Navigation::navItem('admin/lecturers', 'Lecturers') ?>
            <?= Navigation::navItem('admin/courses', 'Courses') ?>
            <?= Navigation::navItem('admin/institute_fees', 'Institute Fees') ?>
        </ul>
    </div>

    <hr class="divider">

    <ul class="nav flex-column mb-2">
        <?= Navigation::navItemIcon('', 'Back Home', 'fas fa-chevron-left') ?>
    </ul>
</nav>