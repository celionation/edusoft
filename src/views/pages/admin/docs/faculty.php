<?php

use core\forms\Form;

$this->title = "Faculty";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h2 class="mx-auto">New Faculty</h2>
                </div>
                <p class="text-danger text-center border-danger border-bottom border-3">Please fill in all fields
                <p>
                <form action="" method="post">
                    <?= Form::csrfField(); ?>

                    <?= Form::inputField('Faculty', 'faculty', $faculty->faculty ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'col mb-3'], $errors); ?>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Create</button>
                        </div>
                        <div class="col">
                            <a href="/admin/faculties" class="btn btn-danger w-100">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>