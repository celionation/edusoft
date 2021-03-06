<?php

use core\forms\Form;

$this->title = "Admin Users";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h2 class="mx-auto">Create New User with Permissions</h2>
                </div>
                <p class="text-danger text-center border-danger border-bottom border-3">Please fill in all fields
                <p>
                <form action="" method="post" enctype="multipart/form-data">
                    <?= Form::csrfField(); ?>
                    <div class="text-center fw-bold text-capitalize m-2">Change Avatar</div>
                    <div class="text-center">
                        <i class="fas fa-user fa-3x border rounded-circle p-3"></i>
                    </div>
                    <?= Form::fileInput('', 'img', ['class' => 'form-control form-control-sm w-25 mx-auto'], [], $errors) ?>
                    <?= Form::inputField('Surname', 'surname', $user->surname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>

                    <div class="row g-3 my-1">
                        <div class="col-md-6">
                            <?= Form::inputField('First Name', 'firstname', $user->firstname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Last Name', 'lastname', $user->lastname ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <div class="col-md-6">
                            <?= Form::inputField('E-Mail', 'email', $user->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Access Level', 'acl', $user->acl ?? '', $roles, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Gender', 'gender', $user->gender ?? '', $gender, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
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
                            <?php if (isset($_GET['matriculation_no'])) : ?>
                                <a href="/admin/students" class="btn btn-danger w-100">Cancel</a>
                            <?php elseif (isset($_GET['lecturer_no'])) : ?>
                                <a href="/admin/lecturers" class="btn btn-danger w-100">Cancel</a>
                            <?php else : ?>
                                <a href="/admin/users" class="btn btn-danger w-100">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>