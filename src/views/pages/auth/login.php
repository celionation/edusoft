<?php

use core\forms\Form;

$this->title = "Login";

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto shadow p-2">
            <div class="card bg-light mt-3">
                <div class="card-body">
                    <div class="text-center">
                        <img src="<?= asset('/assets/img/logo.png') ?>" class="border-primary border rounded-circle d-block mx-auto" style="width: 70px;" alt="">
                        <h2 class="mx-auto">Login</h2>
                    </div>

                    <p class="text-danger border-danger border-bottom border-3">Please fill in your crendentials to log in
                    <p>
                    <form action="" method="post">
                        <?= Form::csrfField(); ?>
                        <?= Form::inputField('E-Mail', 'email', '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'col mb-3'], $errors); ?>
                        <?= Form::inputField('Password', 'password', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'col mb-3'], $errors); ?>
                        <div class="row">
                            <div class="col">
                                <?= Form::checkInput('Remember Me', 'remember', '', ['class' => 'form-check-input'], ['class' => 'mb-3 form-check'], $errors); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <div class="col">
                                <a href="/" class="btn btn-secondary w-100">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>