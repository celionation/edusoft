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
        <p class="text-danger text-center border-danger border-bottom border-3">Select the right course a this particular Semester! Error will be corrected by the Course Adviser<p>
        <div class="container">
            <div class="list-group">
                <label class="list-group-item d-flex gap-3">
                    <?= Form::checkInput('', 'course_id', '', ['class' => 'form-check-input flex-shrink-0', 'style' => 'font-size: 1.375em;'], [], $errors) ?>
                    <span class="pt-1 form-checked-content">
                        <h5 class="text-black">Insurance I</h5>
                        <small class="d-block text-muted">
                            <div>
                                <strong class="me-5">Course Code: <span class="text-danger">BUS 123</span></strong>
                                <strong class="ms-4">Credit: <span class="text-danger">3</span></strong>
                            </div>
                        </small>
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>