<?php

use core\forms\Form;
use core\helpers\CoreHelpers;
use core\helpers\TimeFormat;

$this->title = "Examination Question";

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
                            <a href="/lecturer/exam/questions/lists" class="btn btn-sm btn-warning"><i class="fas fa-chevron-left"></i> Back</a>
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
                    <h5 class="text-sm border-bottom border-3 border-primary mt-2">Exam Questions <span class="badge bg-primary mb-1"><?= $totalQues ?></span></h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger">Add Questions</button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/lecturer/exam/question/create/new?type=multiple&exam_id=<?= $assessment->assessment_id ?>">Multiple choice Question</a></li>
                            <li><a class="dropdown-item" href="/lecturer/exam/question/create/new?type=objective&exam_id=<?= $assessment->assessment_id ?>">Objective Question</a></li>
                            <li><a class="dropdown-item" href="/lecturer/exam/question/create/new?type=subjective&exam_id=<?= $assessment->assessment_id ?>">Subjective Question</a></li>
                        </ul>
                    </div>
                </div>

                <hr class="my-3">

                <?php if ($questions) : ?>
                    <?php $num = ($totalQues + 1) ?>
                    <?php foreach ($questions as $question) : $num-- ?>
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-primary p-1 text-white rounded">Question #<?= $num ?></div>
                                        <div class="badge bg-primary p-2"><?= TimeFormat::StringDate($question->created_at) ?></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $question->question ?></h5>
                                    <?php if (!empty($question->image) && file_exists($question->image)) : ?>
                                        <img src="<?= ROOT . $question->image ?>" alt="" class="img-thumbnail" style="height:75px;width:105px;object-fit:cover;">
                                    <?php endif; ?>

                                    <?php if (!empty($question->correct_answer)) : ?>
                                        <h6 class="card-text border-top border-bottom border-2 border-danger py-2 mt-3 text-danger fw-bold text-capitalize">Answer: <span class="text-black"><?= $question->correct_answer ?></span></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer text-end">
                                    <a href="/lecturer/exam/question/create/<?= $question->question_id ?>?type=<?= $question->question_type ?>&exam_id=<?= $question->assessment_id ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete" onclick="deleteQuestion('<?= $question->question_id ?>', '<?= $assessment->assessment_id ?>')"><i class="fas fa-trash-alt"></i></button>
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

<script>
    function deleteQuestion(id, examId) {
        if (window.confirm("Are you sure you want to delete this Question? This cannot be undone!")) {
            window.location.href = `/lecturer/exam/question/delete/${id}?exam_id=${examId}`;
        }
    }
</script>