<?php

use core\forms\Form;

$this->title = "Admission Form";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h2 class="mx-auto">New Student Admission Process</h2>
                </div>
                <p class="text-danger text-center border-danger border-bottom border-3">Please fill in all fields
                <p>
                <form action="" method="post" enctype="multipart/form-data">
                    <?= Form::csrfField(); ?>

                    <div class="row g-3 mb-1">
                        <small class="text-muted">
                            File Inputs <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-4">
                            <?= Form::inputField('Ref No', 'ref_no', $user->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Jamb Reg No', 'jamb_reg_no', $user->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Course Duration', 'course_duration', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Faculty', 'faculty', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Department', 'department', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Course', 'course', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Degree', 'degree', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Entry Mode', 'entry_mode', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Matriculation No', 'matriculation_no', $user->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <hr>

                    <div class="row g-3 mb-1">
                        <small class="text-muted">
                            Details Input <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-12">
                            <?= Form::inputField('Surname', 'surname', $user->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('First Name', 'firstname', $user->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Last Name', 'lastname', $user->lastname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('E-Mail', 'email', $user->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Phone Number', 'phone', $user->email ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Date Of Birth', 'dob', $user->email ?? '', ['class' => 'form-control', 'type' => 'date'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::selectField('Martial Status', 'martial_status', $user->gender ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <small class="text-muted">
                            Guardians / Next of Kin <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-6">
                            <?= Form::inputField('Guardian Name', 'guardian_name', $user->state ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Guardian Phone Number', 'guardian_phone', $user->state ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Name', 'kin_name', $user->state ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Phone Number', 'kin_phone', $user->state ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin E-Mail', 'kin_email', $user->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <small class="text-muted">
                            Requried Files <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-6">
                            <?= Form::fileInput('Jamb Form', 'result_file', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::fileInput('Date of Birth', 'dob_file', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Admit</button>
                        </div>
                        <div class="col">
                            <a href="/admin/users" class="btn btn-danger w-100">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>