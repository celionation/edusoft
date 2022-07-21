<?php

use src\classes\Extras;
use core\helpers\TimeFormat;
use core\helpers\CoreHelpers;

$this->title = "Mark Student";

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
                        <th>Roll No:</th>
                        <td class="text-end text-capitalize"><?= $assessment->roll_no ?></td>
                        <th class="text-end">Session:</th>
                        <td class="text-end"><?= $assessment->session ?></td>
                    </tr>
                    <tr>
                        <td class="text-ends">
                            <a href="/assessments/to_mark" class="btn btn-sm btn-warning"><i class="fas fa-chevron-left"></i> Back</a>
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
                    <h5 class="text-sm text-capitalize border-bottom border-3 border-primary mt-2 py-1"><span class="text-danger">Name: </span> <?= $assessment->surname . ' ' . $assessment->firstname . ' ' . $assessment->lastname ?></h5>
                    <div class="d-flex justify-content-around align-items-center">
                        <a href="#" class="btn btn-sm btn-danger mx-1"><i class="fas fa-exclamation-circle"></i> Decline</a>
                        <a href="#" class="btn btn-sm btn-success mx-1"><i class="fas fa-check-circle"></i> Marked</a>
                    </div>
                </div>
                <hr class="my-3">

                <?php if ($questions) : ?>
                    <?php foreach ($questions as $question) : ?>
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title"><?= $question->question ?></h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($question->answer)) : ?>
                                        <h6 class="card-text text-danger fw-bold text-capitalize">Answer: <span class="text-black"><?= $question->answer ?></span></h6>
                                    <?php endif; ?>

                                    <?php if (!empty($question->correct_answer)) : ?>
                                        <h6 class="card-text border-top border-bottom border-2 border-danger py-2 mt-3 text-danger fw-bold text-capitalize">Correct Answer: <span class="text-black"><?= $question->correct_answer ?></span></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer text-end">
                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h6 class="text-center text-danger ">No Question set yet.</h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>