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
                            <?= Form::inputField('Jamb Reg No', 'jamb_reg_no', $admission->jamb_reg_no ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Duration Of Course', 'duration', $admission->duration ?? '', $courseDuration, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Faculty', 'faculty', $admission->faculty ?? '', $facOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Department', 'department', $admission->department ?? '', $deptOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Degree', 'degree', $admission->degree ?? '', $degreeOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Entry Mode', 'entry_mode', $admission->entry_mode ?? '', $entryOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Matriculation No', 'matriculation_no', $admission->matriculation_no ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Status', 'status', $admission->status ?? '', $statusOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <hr>

                    <div class="row g-3 mb-1">
                        <small class="text-muted">
                            Details Input <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-12">
                            <?= Form::inputField('Surname', 'surname', $admission->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('First Name', 'firstname', $admission->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Last Name', 'lastname', $admission->lastname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('E-Mail', 'email', $admission->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Phone Number', 'phone', $admission->phone ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Date Of Birth', 'dob', $admission->dob ?? '', ['class' => 'form-control', 'type' => 'date'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::selectField('Martial Status', 'martial_status', $admission->martial_status ?? '', $martialStatus, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <small class="text-muted">
                            Guardians / Next of Kin <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-6">
                            <?= Form::inputField('Guardian Name', 'guardian_name', $admission->guardian_name ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Guardian Phone Number', 'guardian_phone', $admission->guardian_phone ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Name', 'kin_name', $admission->kin_name ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Phone Number', 'kin_phone', $admission->kin_phone ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin E-Mail', 'kin_email', $admission->kin_email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
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
                            <a href="/admin/admission" class="btn btn-danger w-100">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>