<?php

use core\forms\Form;
use core\helpers\CoreHelpers;
use core\helpers\StringFormat;

global $currentLink;
global $quryStr;

$this->title = "Examination";


?>

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
                                <?php if (!empty($question->image) && file_exists($question->image)) : ?>
                                    <img src="<?= ROOT . $question->image ?>" alt="<?= StringFormat::Excerpt($question->question) ?>" class="img-thumbnail" style="height:200px;width:400px;object-fit:cover;">
                                <?php endif; ?>

                                <?php if (!empty($question->comment)) : ?>
                                    <div class="my-2 container border-bottom border-top py-2 border-1 border-danger">
                                        <h6 class="text-start text-danger m-0">Hint: <span class="text-muted"><?= $question->comment ?></span></h6>
                                    </div>
                                <?php endif; ?>

                                <?php if ($question->question_type != 'multiple') : ?>
                                    <?= Form::textareaField('', 'answer', '', ['class' => 'form-control fs-4 text-black', 'rows' => '3'], ['class' => 'answer'], $errors) ?>
                                <?php endif; ?>

                                <?php if ($question->question_type == 'multiple') : ?>
                                    <div class="anwser">
                                        <div class="list-group mx-0">
                                            <label class="list-group-item d-flex gap-2 my-1">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="option" value="<?= $question->option_one ?>" style="transform: scale(1.5);cursor: pointer;">
                                                <h6 class="d-block text-black ps-3"><?= $question->option_one ?></h6>
                                            </label>
                                            <label class="list-group-item d-flex gap-2 my-1">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="option" value="<?= $question->option_two ?>" style="transform: scale(1.5);cursor: pointer;">
                                                <h6 class="d-block text-black ps-3"><?= $question->option_two ?></h6>
                                            </label>
                                            <label class="list-group-item d-flex gap-2 my-1">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="option" value="<?= $question->option_three ?>" style="transform: scale(1.5);cursor: pointer;">
                                                <h6 class="d-block text-black ps-3"><?= $question->option_three ?></h6>
                                            </label>
                                            <label class="list-group-item d-flex gap-2 my-1">
                                                <input class="form-check-input flex-shrink-0" type="radio" name="option" value="<?= $question->option_four ?>" style="transform: scale(1.5);cursor: pointer;">
                                                <h6 class="d-block text-black ps-3"><?= $question->option_four ?></h6>
                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary my-2">Save Answer</button>
                </div>
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