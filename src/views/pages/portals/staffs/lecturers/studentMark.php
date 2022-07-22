<?php

use core\forms\Form;
use src\classes\Extras;
use core\helpers\TimeFormat;
use core\helpers\CoreHelpers;

global $currentLink;
global $quryStr;
global $currentUser;

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
                <div class="container-fluid text-center bg-primary shadow py-2 rounded-3 mb-3">
                    <?php $percentage = Extras::getAnswerPercentage($assessment->assessment_id, $assessment->matriculation_no) ?>
                    <div class="text-white"><?= $percentage ?>% Answered</div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: <?= $percentage ?>%;" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="container-fluid text-center bg-success shadow py-2 rounded-3 mb-3">
                    <?php $markedPercentage = Extras::getMarkedPercentage($assessment->assessment_id, $assessment->matriculation_no) ?>
                    <div class="text-white"><?= $markedPercentage ?>% Marked</div>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: <?= $markedPercentage ?>%;" role="progressbar" aria-valuenow="<?= $markedPercentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="text-center">
                    <?php $score = Extras::getScorePercentage($assessment->assessment_id, $assessment->matriculation_no) ?>
                    <small>Your Score: </small>
                    <h3><?= $score ?>%</h3>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-sm text-capitalize border-bottom border-3 border-primary mt-2 py-1"><span class="text-danger">Name: </span> <?= $assessment->surname . ' ' . $assessment->firstname . ' ' . $assessment->lastname ?></h5>
                    <div class="d-flex justify-content-around align-items-center">
                        <?php if ($submitted) : ?>
                            <button class="btn btn-sm btn-danger mx-1" onclick="declineStudent('<?= $assessment->roll_no ?>')"><i class="fas fa-exclamation-circle"></i> Decline</button>
                            <button class="btn btn-sm btn-success mx-1" onclick="setMarked('<?= $assessment->roll_no ?>')"><i class="fas fa-check-circle"></i> Save as Marked</button>
                            <button class="btn btn-sm btn-warning mx-1" onclick="autoMark('<?= $assessment->roll_no ?>')"><i class="fas fa-check-double"></i> Auto Mark</button>
                        <?php endif; ?>
                    </div>
                </div>
                <hr class="my-3">
                <form action="" method="post">
                    <?php if ($questions) : ?>
                        <?php $num = 0; ?>
                        <?php foreach ($questions as $question) : $num++ ?>
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
                                    <div class="card-footer m-0 p-0">
                                        <?php if ($submitted) : ?>
                                            <small class="text-danger mx-2">Markings.</small>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <div class="form-check">
                                                    <input <?= $question->mark == 'correct' ? 'checked' : '' ?> type="radio" name="<?= $question->question_id ?>" value="correct" class="form-check-input" id="correct<?= $num ?>">
                                                    <label class="form-check-label" for="correct<?= $num ?>">Correct</label>
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input <?= $question->mark == 'wrong' ? 'checked' : '' ?> type="radio" name="<?= $question->question_id ?>" value="wrong" class="form-check-input" id="wrong<?= $num ?>">
                                                    <label class="form-check-label" for="wrong<?= $num ?>">Wrong</label>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="text-end fs-4">
                                                <?= $question->mark == 'correct' ? '<i class="fas fa-check-circle text-success mx-2 py-1"></i>' : '<i class="fas fa-times-circle text-danger mx-2 py-1"></i>' ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <h6 class="text-center text-danger ">No Question set yet.</h6>
                    <?php endif; ?>

                    <?php if ($submitted) : ?>
                        <h6 class="text-center text-danger m-0 mt-2">Click on save Markings before proceeding to next Page.</h6>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary my-2">Save Markings</button>
                        </div>
                    <?php endif; ?>
                </form>

                <!-- Pagination -->
                <nav aria-label="Pagination" class="my-2">
                    <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
                        <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
                            <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $prevPage ?>">Prev</a>
                        </li>
                        <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
                            <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $nextPage ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                <!-- //Pagination -->
            </div>
        </div>
    </div>
</div>

<script>
    function declineStudent(id) {
        if (window.confirm("Are you sure you want to Decline this Exam? This will delete all about this Student Examination info.!")) {
            window.location.href = `/assessments/student/decline/${id}`;
        }
    }

    function autoMark(id) {
        if (window.confirm("Are you sure you want to Auto Mark this Exam? This May Override Previous Markings Saved.!")) {
            window.location.href = `/assessments/student/auto_mark/${id}`;
        }
    }

    function setMarked(id) {
        var percent = '<?= $markedPercentage ?>';

        if (percent < 100) {
            alert("" + percent + "% Marked: You can only set Exam as Marked after all Question has been Marked.");
            return;
        }

        if (window.confirm("You wont be able to mark anymore, after Set as Marked. So finish marking before you click on this button.")) {
            window.location.href = `/assessments/to_mark/student/${id}?marked=yes&percent=${percent}`;
        }
    }
</script>