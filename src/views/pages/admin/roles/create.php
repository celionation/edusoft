<?php

use core\forms\Form;

$this->title = "Levels & Permissions";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h2 class="mx-auto">Create New Role Permissions</h2>
                </div>
                <p class="text-danger text-center border-danger border-bottom border-3">Please fill in all fields
                <p>
                <form action="" method="post">
                    <?= Form::csrfField(); ?>

                    <div class="row g-3 my-1">
                        <div class="col-md-6">
                            <?= Form::inputField('Role', 'role', $level->role ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Form::inputField('Doc Type', 'doctype', $level->doctype ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                    </div>

                    <div class="row g-3 my-1">
                        <div class="col-md-4">
                            <?= Form::checkInput('Read', 'read', '', ['class' => 'form-check-input'], ['class' => 'form-check'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::checkInput('Write', 'write', '', ['class' => 'form-check-input'], ['class' => 'form-check'], $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <?= Form::checkInput('Delete', 'delete', '', ['class' => 'form-check-input'], ['class' => 'form-check'], $errors); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Create</button>
                        </div>
                        <div class="col">
                            <a href="/admin/roles" class="btn btn-danger w-100">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>