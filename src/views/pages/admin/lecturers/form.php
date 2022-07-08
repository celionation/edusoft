<?php

use core\forms\Form;

$this->title = "Lecturers Form";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h2 class="mx-auto">New Lecturer Process</h2>
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
                            <?= Form::inputField('Education Degree', 'degree', $lecturer->degree ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Position', 'position', $lecturer->position ?? '', $positions, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Faculty', 'faculty', $lecturer->faculty ?? '', $facOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Department', 'department', $lecturer->department ?? '', $deptOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::selectField('Status', 'status', $lecturer->status ?? '', $statusOpt, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <hr>

                    <div class="row g-3 mb-1">
                        <small class="text-muted">
                            Details Input <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-12">
                            <?= Form::inputField('Surname', 'surname', $lecturer->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('First Name', 'firstname', $lecturer->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Last Name', 'lastname', $lecturer->lastname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('E-Mail', 'email', $lecturer->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Phone Number', 'phone', $lecturer->phone ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Date Of Birth', 'dob', $lecturer->dob ?? '', ['class' => 'form-control', 'type' => 'date'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::selectField('Martial Status', 'martial_status', $lecturer->martial_status ?? '', $martialStatus, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <small class="text-muted">
                            Next of Kin <span class="text-danger">*</span>
                        </small>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Name', 'kin_name', $lecturer->kin_name ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin Phone Number', 'kin_phone', $lecturer->kin_phone ?? '', ['class' => 'form-control', 'type' => 'number'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Next of Kin E-Mail', 'kin_email', $lecturer->kin_email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Submit</button>
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