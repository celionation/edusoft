<?php


use core\helpers\Navigation;

/** @var mixed $currentUser */
global $currentUser;


?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <?php if ($currentUser->acl == 'student') : ?>
                <?= Navigation::navItem('students_portal', 'Dashboard') ?>
                <?= Navigation::navItem('student/courses', 'Courses') ?>
                <?= Navigation::navItem('student/lecture_room', 'Lecture Room') ?>
            <?php else : ?>
                <?= Navigation::navItem('staffs_portal', 'Dashboard') ?>
            <?php endif; ?>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Misc. Section</span>
            <a class="link-secondary" href="#" aria-label="Miscellaneous">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <?php if ($currentUser->acl == 'student') : ?>
                <?= Navigation::navItemIcon('student/results', 'Results', 'fas fa-chart-bar') ?>
                <?= Navigation::navItemIcon('student/assessments', 'Assessments', 'fas fa-file-signature') ?>
            <?php endif; ?>
            <?php if ($currentUser->acl == 'staff') : ?>
                <?= Navigation::navItemIcon('lecturer/cont_asses/questions', 'Cont.Asses Questions', 'fas fa-file-signature') ?>
                <?= Navigation::navItemIcon('lecturer/exam/questions', 'Examination Questions', 'fas fa-file-signature') ?>
            <?php endif; ?>
            <!-- at dashboard -->
            <?= Navigation::navItemIcon('admin/helpdesk', 'Help-desk', 'fas fa-question-circle') ?>
        </ul>

        <hr>

        <ul class="nav flex-column mb-2">
            <?= Navigation::navItemIcon('', 'Back Home', 'fas fa-chevron-left pe-2') ?>
        </ul>
    </div>
</nav>