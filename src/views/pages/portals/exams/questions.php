<?php

use core\forms\Form;

$this->title = "Examination Questions Selection";

?>

<?= partials('StaffCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a class="btn btn-primary btn-sm" href="/lecturer/exam/questions/lists">Examination Lists</a>
                </div>
                <small class="text-danger">
                    Select Faculty First To Add New Lecturer.
                </small>
                <form action="" method="post">
                    <?= Form::csrfField(); ?>
                    <div class="col-md-12">
                        <?= Form::inputField('Assessment Session', 'session', $assessment->session ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => '2020/2021 First Semester'], ['class' => 'mb-3 col'], $errors); ?>
                    </div>
                    <div class="row g-3 my-1">
                        <div class="col-md-3">
                            <?= Form::selectField('Level', 'course_level', $assessment->course_level ?? '', $levelOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Assessment Type', 'assessment_type', $assessment->assessment_type ?? '', $types, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::selectField('Assessment Title', 'assessment_title', $assessment->assessment_title ?? '', $titleOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-9">
                            <?= Form::inputField('Assessment Instruction', 'assessment_instruction', $assessment->assessment_instruction ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Course Code', 'course_code', $assessment->course_code ?? '', $codeOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>
                    <div class="row g-3 my-1">
                        <div class="col-md-3">
                            <?= Form::inputField('Assessment Time', 'assessment_time', $assessment->assessment_time ?? '', ['class' => 'form-control', 'type' => 'text', 'placeholder' => '2 hours, 1hour 30minutes'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Assessment Semester', 'assessment_semester', $assessment->assessment_semester ?? '', $semesterOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Assessment Faculty', 'faculty', $assessment->faculty ?? '', $facultyOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Assessment Department', 'department', $assessment->department ?? '', $departmentOptions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary">Proceed <i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="col text-end">
                            <a href="/lecturer/exam/questions/lists" class="btn btn-sm btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>