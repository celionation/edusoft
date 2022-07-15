<?php

$this->title = "Student Examination Lists.";

?>

<?= partials('PortalCrumbs') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
</div>

<div class="container">
    <?php if ($assessments) : ?>
        <table class="table table-striped table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assessments as $assessment) : ?>
                    <tr>
                        <td><?= $assessment->assessment_title ?></td>
                        <td><?= $assessment->course_code ?></td>
                        <td><?= $assessment->assessment_time ?></td>
                        <?php if($assessment->courseStatus == 'waiting'): ?>
                            <td class="text-warning fw-bold"><?= $assessment->courseStatus ?></td>
                            <?php else: ?>
                                <td class="text-success fw-bold"><?= $assessment->courseStatus ?></td>
                        <?php endif; ?>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-primary">Take Exam</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Note: <span class="text-danger">Once you click on take exam, you can't switch browers tabs, else you automatically submit you exam.</span></th>
                </tr>
            </tfoot>
        </table>
    <?php else : ?>
        <h6 class="text-center text-muted small border-bottom border-3 border-danger py-1">No Data yet!.</h6>
    <?php endif; ?>
</div>