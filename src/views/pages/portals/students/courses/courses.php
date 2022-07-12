<?php

$this->title = "Student Courses";

?>

<?= partials("PortalCrumbs") ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
    <div class="text-end">
        <a class="btn btn-sm btn-primary" href="/student/courses/registration">Course Registration</a>
        <a class="btn btn-sm btn-warning" href="#">Outstanding Course</a>
    </div>
</div>

<hr>

<div class="container">
    <?php if (!empty($courses)) : ?>
        <table class="table table-striped table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Course Credit</th>
                    <th>Course Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $key => $course) : ?>
                    <tr>
                        <th><?= $key + 1 ?></th>
                        <td class="text-start"><?= $course->course_title ?></td>
                        <td><?= $course->course_code ?></td>
                        <td><?= $course->course_credit ?></td>
                        <td><?= $course->course_type ?></td>
                        <td><?= $course->status ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="">Total Allowed Credit: <span class="text-danger">Confirm from your course Adviser.</span></th>
                    <th class="text-end">Semester: <span class="text-uppercase text-danger"><?= $course->semester ?></span>
                    </th>
                </tr>
            </tfoot>
        </table>
    <?php else : ?>
        <h5 class="text-center text-muted">No data yet!.</h5>
    <?php endif; ?>
</div>