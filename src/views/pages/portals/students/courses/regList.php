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
        <p class="text-danger text-center border-danger border-bottom border-3">Please fill in all fields
        <p>
        <div class="container">
            <div class="row">
                <div class="col-md-4 border-end border-2 border-danger">
                    <form action="" method="post">
                        <div class="row g-3 mb-1">
                            <small class="text-muted">
                                File Inputs <span class="text-danger">*</span>
                            </small>
                            <div class="col">
                                <?= Form::selectField('Semester', 'semester', $course->department ?? '', $semester, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-primary">Proceed <i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="list-group">
                        <label class="list-group-item d-flex gap-3">
                            <input class="form-check-input flex-shrink-0" type="checkbox" value="" checked style="font-size: 1.375em;">
                            <span class="pt-1 form-checked-content">
                                <h5 class="text-black">Introduction to Marketing</h5>
                                <small class="d-block text-muted">
                                    <div>
                                        <strong class="me-5">Course Code: <span class="text-danger">BUS 121</span></strong>
                                        <strong class="ms-4">Credit: <span class="text-danger">3</span></strong>
                                    </div>
                                </small>
                            </span>
                        </label>
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
    </div>
</div>