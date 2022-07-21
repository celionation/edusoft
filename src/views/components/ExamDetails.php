<?php

/** @var mixed $currentUser */

use src\classes\Extras;

global $currentUser;

?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-transparent">
    <div class="position-sticky pt-3">
        <h6 class="text-danger border-bottom border-3 border-danger">Profile</h6>
        <?php if (!empty($currentUser->img) && file_exists($currentUser->img)) : ?>
            <div class="d-flex align-items-center justify-content-center my-3">
                <img src="<?= ROOT . $currentUser->img ?>" alt="" class="img-thumbnail rounded-2 shadow-lg" style="height:100px;width:150px;object-fit:cover;">
            </div>
        <?php endif; ?>
        <div class="my-lg-3 text-center">
            <h6 class="text-primary">Name: <span class="text-black d-block"><?= $currentUser->surname . ' ' . $currentUser->firstname . ' ' . $currentUser->lastname ?></span></h6>
            <hr class="my-1">
            <h6 class="text-primary">Email: <span class="text-black d-block"><?= $currentUser->email ?></span></h6>
            <hr class="my-1">
            <h6 class="text-primary">Matric No: <span class="text-uppercase text-danger d-block"><?= $currentUser->code_id ?></span></h6>
            <hr class="my-1">
        </div>
        <h6 class="text-danger border-bottom border-3 border-danger my-2">Time</h6>
        <div class="timer shadow py-2 text-center mb-3">
            <div class="text-primary h3 fw-bold text-uppercase">00:00:00</div>
        </div>
        <!-- SUBMIT BUTTON -->
        <div class="border-top border-bottom border-3 border-danger py-3 mt-5">
            <h6 class="text-center text-danger">Exam not yet Submitted.</h6>
            <button class="btn btn-danger w-100" onclick="submitExam()">Submit</button>
        </div>
    </div>
</nav>