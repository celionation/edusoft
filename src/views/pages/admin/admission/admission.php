<?php

use core\forms\Form;

$this->title = "Admission";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <h6 class="text-danger mx-3">
                    Please note that all messages must be attended to before deleting... Thanks.
                </h6>
                <form action="" method="post">
                    <?= Form::csrfField(); ?>
                    <div class="row g-3 my-1">
                        <div class="col-md-3">
                            <?= Form::inputField('Surname', 'surname', $user->email ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::inputField('Firstname', 'firstname', $user->email ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::inputField('LastName', 'lastname', $user->email ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>
                        </div>
                        <div class="col-md-3">
                            <?= Form::selectField('Faculty', 'faculty', $user->acl ?? '', $faculty, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary">Proceed <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>