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

                    <div class="row g-3 my-1">
                        <small class="text-muted">
                            File Inputs *
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
                    </div>

                    <div class="row g-3 my-1">
                        <div class="col-md-4">
                            <?= Form::inputField('Surname', 'surname', $user->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('First Name', 'firstname', $user->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Last Name', 'lastname', $user->lastname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <div class="col-md-6">
                            <?= Form::inputField('E-Mail', 'email', $user->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Access Level', 'acl', $user->acl ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Gender', 'gender', $user->gender ?? '', [], ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <div class="col-md-4">
                            <?= Form::inputField('State', 'state', $user->state ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Country', 'country', $user->country ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::inputField('Address', 'address', $user->address ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <?= Form::inputField('Password', 'password', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'col mb-3'], $errors); ?>

                    <?= Form::inputField('Confirm Password', 'confirmPassword', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'col mb-3'], $errors); ?>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Create</button>
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