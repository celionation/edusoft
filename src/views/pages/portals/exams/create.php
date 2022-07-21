<?php

use core\forms\Form;
use core\helpers\CoreHelpers;
use core\helpers\TimeFormat;

$this->title = "Create Examination Question";

?>

<?= partials('StaffCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center border-bottom border-3 border-danger"><?= $assessment->assessment_title ?></h4>
                <table class="table table-hover">
                    <tr>
                        <th>Course Code:</th>
                        <td class="text-end"><?= $assessment->course_code ?></td>
                        <th class="text-end">Created on:</th>
                        <td class="text-end"><?= TimeFormat::StringDate($assessment->created_at) ?></td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td class="text-end"><?= $assessment->department ?></td>
                        <th class="text-end">Duration:</th>
                        <td class="text-end"><?= $assessment->assessment_time ?></td>
                    </tr>
                    <tr>
                        <th>Instruction:</th>
                        <td colspan="4" class="text-end fw-bold text-uppercase"><?= $assessment->assessment_instruction ?></td>
                    </tr>
                    <tr>
                        <td class="text-ends">
                            <a href="/lecturer/exam/question/view/<?= $assessment->assessment_id ?>" class="btn btn-sm btn-warning"><i class="fas fa-chevron-left"></i> Back</a>
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
                <!-- Content Goes Here -->
                <div class="content my-3">
                    <?php if (isset($_GET['type']) && $_GET['type'] == 'multiple') : ?>
                        <h4 class="text-center text-muted">Add Multiple Choice Question</h4>
                    <?php elseif (isset($_GET['type']) && $_GET['type'] == 'objective') : ?>
                        <h4 class="text-center text-muted">Add Objective Question</h4>
                    <?php else : ?>
                        <h4 class="text-center text-muted">Add Subjective Question</h4>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data" id="add_question_form">
                        <?= Form::csrfField() ?>
                        <?= Form::textareaField('Questions', 'question', $questions->question ?? '', ['class' => 'form-control', 'rows' => '2'], ['class' => 'mb-2 col-md-12'], $errors) ?>

                        <?= Form::inputField('Comment', 'comment', $questions->comment ?? '', ['class' => 'form-control', 'placeholder' => 'Comment(Optional)'], ['class' => 'mb-3 col-md-12'], $errors) ?>

                        <small class="text-muted m-0">
                            Image Optional <span class="text-danger">*</span>
                        </small>
                        <?php if (!empty($questions->image)) : ?>
                            <div class="d-flex align-items-center">
                                <h5 class="me-2 mx-3">Current Image</h5>
                                <img src="<?= ROOT . $questions->image ?>" class="img-thumbnail" style="height:75px;width:105px;object-fit:cover;" />
                            </div>
                        <?php endif; ?>
                        <?= Form::fileInput('', 'image', ['class' => 'form-control'], ['class' => 'mb-3 col-12'], $errors) ?>

                        <?php if (isset($_GET['type']) && $_GET['type'] == 'objective') : ?>
                            <small class="text-muted mt-3">
                                Required <span class="text-danger">*</span>
                            </small>
                            <?= Form::inputField('Answer', 'correct_answer', $questions->correct_answer ?? '', ['class' => 'form-control', 'placeholder' => 'Answer...'], ['class' => 'mb-2 col-md-12'], $errors) ?>
                        <?php endif; ?>

                        <?php if (isset($_GET['type']) && $_GET['type'] == 'multiple') : ?>
                            <div class="card">
                                <div class="card-header bg-black text-white">
                                    Multiple Choice Answers
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 my-1">
                                        <div class="col-md-12">
                                            <?= Form::inputField('Option One', 'option_one', $questions->option_one ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Option One'], ['class' => 'mb-3 col'], $errors); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?= Form::inputField('Option Two', 'option_two', $questions->option_two ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Option Two'], ['class' => 'mb-3 col'], $errors); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?= Form::inputField('Option Three', 'option_three', $questions->option_three ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Option Three'], ['class' => 'mb-3 col'], $errors); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?= Form::inputField('Option Four', 'option_four', $questions->option_four ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Option Four'], ['class' => 'mb-3 col'], $errors); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-black text-white">
                                    <div class="col-md-12">
                                        <?= Form::inputField('Answer', 'correct_answer', $questions->correct_answer ?? '', ['class' => 'form-control', 'placeholder' => 'Answer...'], ['class' => 'mb-2 col-md-12'], $errors) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row my-3">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-success w-50" id="add_btn">Save Question</button>
                            </div>
                            <div class="col text-end">
                                <button type="reset" class="btn btn-sm btn-danger w-50">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

    function add_choice() {
        var choices = document.querySelector(".choice-list");

        if (choices.children.length < letters.length) {

            choices.innerHTML += `
			<li class="list-group-item">
		    	${letters[choices.children.length]} : <input type="text" class="form-control" name="choice${choices.children.length}" placeholder="Type your answer here">
		    	<label style="cursor: pointer;"><input type="radio" value="${letters[choices.children.length]}" name="correct_answer"> Correct answer</label>
		    </li>
		   `;
        }

    }
</script>