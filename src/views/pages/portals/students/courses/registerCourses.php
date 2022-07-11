<?php

use core\forms\Form;

$this->title = "Course Registration";

?>

<style>
    .list-group {
        width: auto;
        max-width: 100%;
        margin: 0 auto;
    }
</style>

<?= partials("PortalCrumbs") ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h2 class="mx-auto">Course Registration</h2>
        </div>
        <p class="text-danger text-center border-danger border-bottom border-3">Select the right course a this particular Semester! Error will be corrected by the Course Adviser
        <p>
        <div class="container">
            <form action="" method="post">
                <?= Form::csrfField(); ?>
                <div class="row g-3 my-1">
                    <div class="col-md-12">
                        <?= Form::selectField('Courses', 'course_id', '', $courseOptions, ['class' => 'form-control multiple'], ['class' => 'mb-3 col'], $errors); ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-sm btn-primary w-100">Save</button>
                    </div>
                    <div class="col">
                        <a href="/student/courses/registration" class="btn btn-sm btn-danger w-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>