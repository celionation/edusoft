<?php

global $currentUser;

use core\helpers\Navigation;

?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="./assets/img/logo.png" alt="" style="width: 65px; width: 45px;">
            <small>Nattisight</small>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <?= Navigation::navItem('', 'Home') ?>
                <?= Navigation::navItem('contact', 'Contact') ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Portals</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <?= Navigation::navItem('students_portal', 'Students', true, true) ?>
                        <hr class="dropdown-divider text-danger">
                        <?= Navigation::navItem('staffs_portal', 'Staff\'s', true, true) ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Ass Portal</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <?= Navigation::navItem('cont_asses', 'Cont.Asses', true) ?>
                        <?= Navigation::navItem('exam', 'Exam', true) ?>
                    </ul>
                </li>
                <?php if($currentUser): ?>
                    <?= Navigation::navItem('logout', 'Logout') ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" id="search-btn"><span class="fas fa-search"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- __________________SEARCH BOX___________________ -->
<form action="" method="post" class="search-form">
    <input type="search" id="search-box" placeholder="Search here...">
    <label for="search-box" class="fas fa-search"></label>
</form>
<!-- __________________END OF SEARCH BOX___________________ -->