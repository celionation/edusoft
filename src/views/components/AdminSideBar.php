<?php

use core\helpers\Navigation;

?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <?= Navigation::navItem('admin/dashboard', 'Dashboard') ?>
            <?= Navigation::navItem('admin/account', 'Account') ?>
            <li class="nav-item">
                <a class="nav-link" href="#">
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
            <?= Navigation::navItem('admin/roles', 'Roles') ?>
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
        </ul>
    </div>

    <hr class="divider">

    <div class="dropdown fixed-bottom">
        <a href="#" class="d-flex align-items-center nav-link text-decoration-none dropdown-toggle" id="dropupUser" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/assets/img/user_male.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropupUser">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</nav>