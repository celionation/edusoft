<?php

use src\classes\Extras;

$this->title = "Lecturer Exams Lists";

?>

<?= partials('PortalCrumbs') ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <a href="/lecturer/exams" class="btn btn-sm btn-warning"><i class="fas fa-chevron-left"></i>Back</a>
    </div>
    <div class="text-end">

    </div>
</div>

<div class="container mt-2">
    <?php if ($students) : ?>
        <table class="table table-striped table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>Exam Title</th>
                    <th>Fullname</th>
                    <th>Matruculation No</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= $student->assessment_title ?></td>
                        <td><?= $student->surname . ' ' . $student->firstname . ' ' . $student->lastname ?></td>
                        <td><?= $student->matriculation_no ?></td>
                        <?php $percentage = Extras::getAnswerPercentage($student->assessment_id, $student->matriculation_no) ?>
                        <td><?= $percentage ?>%</td>
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