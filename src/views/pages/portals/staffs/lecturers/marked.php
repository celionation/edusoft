<?php

use src\classes\Extras;

$this->title = "Assessment Marked";

?>

<?= partials('StaffCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <a href="/staffs_portal" class="btn btn-sm btn-warning my-2"><i class="fas fa-chevron-left"></i> Back</a>
                <?php if ($marked) : ?>
                    <table class="table table-responsive table-hover">
                        <thead class="table-danger">
                            <tr>
                                <th><i class="fas fa-arrow-alt-circle-right"></i></th>
                                <th>Title</th>
                                <th>Course Code</th>
                                <th>Fullname</th>
                                <th>Matriculation No</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($marked as $mark) : ?>
                                <?php $percentage = Extras::getAnswerPercentage($mark->assessment_id, $mark->matriculation_no) ?>
                                <tr>
                                    <td><a href="/assessments/marked/student/<?= $mark->roll_no ?>"><i class="fas fa-check bg-primary p-2 rounded-circle text-white"></i></a></td>
                                    <td><?= $mark->assessment_title ?></td>
                                    <td><?= $mark->course_code ?></td>
                                    <td><?= $mark->surname . ' ' . $mark->firstname . ' ' . $mark->lastname ?></td>
                                    <td><?= $mark->matriculation_no ?></td>
                                    <td><?= $percentage ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">Note: <span class="text-danger">To mark Exam click on the check button on the left side.</span></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php else : ?>
                    <h6 class="text-center text-muted small border-bottom border-3 border-danger py-1">No Data yet!.</h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>