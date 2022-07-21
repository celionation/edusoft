<?php

use core\Session;
use core\forms\Form;
use src\classes\Extras;
use core\helpers\CoreHelpers;
use core\helpers\StringFormat;

/** @var mixed $currentUser */

global $currentLink;
global $quryStr;
global $currentUser;

$this->title = "Examination Page";

?>


<div class="row">
    <!-- SIDENAVBAR -->
    <?php $submitted = Extras::sumittedAssessment($assessment->assessment_id, $extAttendance->roll_no, $currentUser->code_id) ?>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-transparent">
        <div class="position-sticky pt-3">
            <h6 class="text-danger border-bottom border-3 border-danger">Profile</h6>
            <?php if (!empty($currentUser->img) && file_exists($currentUser->img)) : ?>
                <div class="d-flex align-items-center justify-content-center my-3">
                    <img src="<?= ROOT . $currentUser->img ?>" alt="" class="img-thumbnail rounded-2 shadow-lg" style="height:100px;width:150px;object-fit:cover;">
                </div>
            <?php endif; ?>
            <div class="my-lg-3 text-center">
                <h6 class="text-primary">Name: <span class="text-black d-block"><?= $currentUser->surname . ' ' . $currentUser->firstname . ' ' . $currentUser->lastname ?></span></h6>
                <hr class="my-1">
                <h6 class="text-primary">Email: <span class="text-black d-block"><?= $currentUser->email ?></span></h6>
                <hr class="my-1">
                <h6 class="text-primary">Matric No: <span class="text-uppercase text-danger d-block"><?= $currentUser->code_id ?></span></h6>
                <hr class="my-1">
            </div>
            <h6 class="text-danger border-bottom border-3 border-danger my-2">Time</h6>
            <div class="timer shadow py-2 text-center mb-3">
                <div class="text-primary h3 fw-bold text-uppercase">00:00:00</div>
            </div>
            <!-- SUBMIT BUTTON -->
            <div class="border-top border-bottom border-3 border-danger py-3 mt-5">
                <?php if (empty($submitted)) : ?>
                    <h6 class="text-center text-danger">Exam not yet Submitted.</h6>
                    <button class="btn btn-danger w-100" onclick="submitExam('<?= $assessment->assessment_id ?>', '<?= $extAttendance->roll_no ?>', '<?= $currentUser->code_id ?>')">Submit</button>
                <?php else : ?>
                    <h6 class="text-center text-success">Exam Submitted.</h6>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- SIDENAVBAR -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="card my-2 bg-transparent" id="examPage">
            <div class="card-body">
                <div class="details">
                    <h4 class="text-center border-bottom border-3 border-danger"><?= $assessment->assessment_title ?></h4>
                    <table class="table table-hover">
                        <tr>
                            <th>Course Code:</th>
                            <td class="text-end"><?= $assessment->course_code ?></td>
                            <th class="text-end">Total Questions:</th>
                            <td class="text-end"><?= $total ?></td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td class="text-end text-capitalize"><?= $assessment->department ?></td>
                            <th class="text-end">Duration:</th>
                            <td class="text-end"><?= $assessment->assessment_time ?></td>
                        </tr>
                        <tr>
                            <th>Instruction:</th>
                            <td colspan="4" class="text-end fw-bold text-uppercase"><?= $assessment->assessment_instruction ?></td>
                        </tr>
                    </table>
                    <?= Session::displaySessionAlerts() ?>
                    <div class="container-fluid text-center bg-primary shadow py-2 rounded-3">
                        <?php $percentage = Extras::getAnswerPercentage($assessment->assessment_id, $currentUser->code_id) ?>
                        <div class="text-white"><?= $percentage ?>% Answered</div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: <?= $percentage ?>%;" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <!-- Exam Questions -->
                <div class="card bg-transparent mt-2">
                    <form action="" method="post">
                        <?php foreach ($questions as $key => $question) : ?>
                            <div class="col mb-1 shadow border-top border-3 border-danger examQ">
                                <div class="card bg-transparent">
                                    <div class="card-header bg-secondary">
                                        <?= Form::hiddenField('question_id', $question->question_id) ?>
                                        <h4 class="card-title text-white fw-bold"><?= $question->question ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <?php $myAnswer = Extras::savedAnswer($savedAnswer, $question->question_id) ?>
                                        <?php if (!empty($question->image) && file_exists($question->image)) : ?>
                                            <img src="<?= ROOT . $question->image ?>" alt="<?= StringFormat::Excerpt($question->question) ?>" class="img-thumbnail" style="height:200px;width:400px;object-fit:cover;">
                                        <?php endif; ?>

                                        <?php if (!empty($question->comment)) : ?>
                                            <div class="my-2 container border-bottom border-top py-2 border-1 border-danger">
                                                <h6 class="text-start text-danger m-0">Hint: <span class="text-muted"><?= $question->comment ?></span></h6>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($question->question_type != 'multiple') : ?>
                                            <?php if (!$submitted) : ?>
                                                <?= Form::textareaField('', 'answer', $myAnswer ?? '', ['class' => 'form-control fs-4 text-black', 'rows' => '3'], ['class' => 'answer'], $errors, $submitted ? 'disabled' : '') ?>
                                            <?php else: ?>
                                                <h4 class="text-danger border-bottom border-3 border-primary mt-2 shadow p-1">Answer: <span class="text-black"><?= $myAnswer ?></span></h4>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($question->question_type == 'multiple') : ?>
                                            <div class="anwser">
                                                <div class="list-group mx-0">
                                                    <label class="list-group-item d-flex gap-2 my-1 align-items-center">
                                                        <?php if ($submitted) : ?>
                                                            <?php if ($myAnswer == $question->option_one) : ?>
                                                                <i class="fas fa-check my-1 bg-success p-2 rounded-circle text-white"></i>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <input class="form-check-input flex-shrink-0" type="radio" name="answer" value="<?= $question->option_one ?>" style="transform: scale(1.5);cursor: pointer;" <?= $myAnswer == $question->option_one ? ' checked ' : '' ?>>
                                                        <?php endif; ?>
                                                        <h6 class="d-block text-black ps-3"><?= $question->option_one ?></h6>
                                                    </label>
                                                    <label class="list-group-item d-flex gap-2 my-1 align-items-center">
                                                        <?php if ($submitted) : ?>
                                                            <?php if ($myAnswer == $question->option_two) : ?>
                                                                <i class="fas fa-check my-1 bg-success p-2 rounded-circle text-white"></i>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <input class="form-check-input flex-shrink-0" type="radio" name="answer" value="<?= $question->option_two ?>" style="transform: scale(1.5);cursor: pointer;" <?= $myAnswer == $question->option_two ? ' checked ' : '' ?>>
                                                        <?php endif; ?>
                                                        <h6 class="d-block text-black ps-3"><?= $question->option_two ?></h6>
                                                    </label>
                                                    <label class="list-group-item d-flex gap-2 my-1 align-items-center">
                                                        <?php if ($submitted) : ?>
                                                            <?php if ($myAnswer == $question->option_three) : ?>
                                                                <i class="fas fa-check my-1 bg-success p-2 rounded-circle text-white"></i>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <input class="form-check-input flex-shrink-0" type="radio" name="answer" value="<?= $question->option_three ?>" style="transform: scale(1.5);cursor: pointer;" <?= $myAnswer == $question->option_three ? ' checked ' : '' ?>>
                                                        <?php endif; ?>
                                                        <h6 class="d-block text-black ps-3"><?= $question->option_three ?></h6>
                                                    </label>
                                                    <label class="list-group-item d-flex gap-2 my-1 align-items-center">
                                                        <?php if ($submitted) : ?>
                                                            <?php if ($myAnswer == $question->option_four) : ?>
                                                                <i class="fas fa-check my-1 bg-success p-2 rounded-circle text-white"></i>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <input class="form-check-input flex-shrink-0" type="radio" name="answer" value="<?= $question->option_four ?>" style="transform: scale(1.5);cursor: pointer;" <?= $myAnswer == $question->option_four ? ' checked ' : '' ?>>
                                                        <?php endif; ?>
                                                        <h6 class="d-block text-black ps-3"><?= $question->option_four ?></h6>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (!$submitted) : ?>
                            <h6 class="text-center text-danger m-0 mt-2">Click on save answer before proceeding to next question.</h6>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-sm btn-primary my-2">Save Answer</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="card-footer bg-dark">
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
    </main>
</div>


<script>
    var percent = "<?= $percentage ?>"

    function submitExam(id, roll_no, matricNo) {
        if (confirm("Are you sure you want to submit!.")) {
            if (percent < 100) {
                if (!confirm("You have only answered " + percent + "% of the Exam. Are you sure you want to Submit?.")) {
                    alert('continue Exam');
                    return;
                }
            }
            window.location.href = `/examination/submitted/${id}?roll=${roll_no}&matric_no=${matricNo}`;
        }
    }
</script>