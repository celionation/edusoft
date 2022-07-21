<?php

use src\classes\Extras;
use core\helpers\TimeFormat;
use core\helpers\CoreHelpers;

$this->title = "Lecturer Exams Lists";

?>

<?= partials('PortalCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center border-bottom border-3 border-danger"><?= $assessment->assessment_title ?></h4>
                <table class="table table-hover">
                    <tr>
                        <th>Course Code:</th>
                        <td class="text-end"><?= $assessment->course_code ?></td>
                        <th class="text-end">Level:</th>
                        <td class="text-end"><?= $assessment->course_level ?></td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td class="text-end text-capitalize"><?= $assessment->department ?></td>
                        <th class="text-end">Duration:</th>
                        <td class="text-end"><?= $assessment->assessment_time ?></td>
                    </tr>
                    <tr>
                        <td class="text-ends">
                            <a href="/lecturer/exams" class="btn btn-sm btn-warning"><i class="fas fa-chevron-left"></i> Back</a>
                        </td>
                        <th colspan="2" class="text-end">Status:</th>
                        <?php if ($assessment->status == 'inactive') : ?>
                            <td colspan="6" class="text-end text-capitalize text-danger fw-bold"><?= $assessment->status ?></td>
                        <?php elseif ($assessment->status == 'active') : ?>
                            <td colspan="6" class="text-end text-capitalize text-success fw-bold"><?= $assessment->status ?></td>
                        <?php else : ?>
                            <td colspan="6" class="text-end text-capitalize text-warning fw-bold"><?= $assessment->status ?></td>
                        <?php endif; ?>
                    </tr>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-sm border-bottom border-3 border-primary mt-2 py-1">Student's Attendance
                        <?php if ($studentsTotal > 0) : ?>
                            <span class="badge bg-danger"><?= $studentsTotal ?></span>
                        <?php endif; ?>
                    </h5>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></button>
                    </div>
                </div>
                <hr class="my-3">
                <?php if ($students) : ?>
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="table-info">
                            <tr>
                                <th>Fullname</th>
                                <th>Matruculation No</th>
                                <th>Roll No</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student) : ?>
                                <?php $percentage = Extras::getAnswerPercentage($student->assessment_id, $student->matriculation_no) ?>
                                <tr>
                                    <td><?= $student->surname . ' ' . $student->firstname . ' ' . $student->lastname ?></td>
                                    <td><?= $student->matriculation_no ?></td>
                                    <td><?= $student->roll_no ?></td>
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
        </div>
    </div>
</div>