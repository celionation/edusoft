<?php

use core\forms\Form;
use core\helpers\CoreHelpers;

$this->title = "Course Registration";

?>


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
                        <?= Form::selectField('Courses', 'course_id', '', $courseOptions, ['class' => 'form-control select'], ['class' => 'mb-3 col'], $errors); ?>
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

        <hr class="mt-5">
        <div class="container">
            <div class="d-flex align-items-center">
                <h2 class="mx-auto border-bottom border-danger border-3 py-1">Registered Courses</h2>
            </div>
            <?php if (!empty($courseStdLists)) : ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Course Code</th>
                            <th>Course Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courseStdLists as $key => $courseStdList) : ?>
                            <tr>
                                <th><?= $key + 1 ?></th>
                                <td><?= $courseStdList->course_title ?></td>
                                <td><?= $courseStdList->course_code ?></td>
                                <td><?= $courseStdList->course_credit ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h4 class="text-center text-muted small">No Course Registered yet.</h4>
            <?php endif; ?>
        </div>
    </div>
</div>